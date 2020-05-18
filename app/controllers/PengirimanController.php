<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pabrik;
use App\Models\PemilikTruk;
use App\Models\Pengiriman;
use App\Validation\PengirimanValidation;
date_default_timezone_set("Asia/Bangkok");
class PengirimanController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->peng = Pengiriman::find();
        $this->view->pemilik = PemilikTruk::find();
        $this->view->pabrik = Pabrik::find();
    }

    public function tambahAction()
    {
        $this->view->pemilik = PemilikTruk::find();
        $this->view->pabrik = Pabrik::find();
    }

    public function prosesAction()
    {
        $validation = new PengirimanValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pengiriman/tambah');
        }
        else
        {
            $peng= new Pengiriman();
            $peng->assign(
                $this->request->getPost(),
                [
                    'id_pabrik',
                    'id_pemilik',
                    'harga_kirim',
                    'harga_supir'
                ]
            );
            $peng->updated_at = date('Y-m-d h:i:sa');
            $peng->created_at = date('Y-m-d h:i:sa');
            $success = $peng->save();
            if($success)
            {
                $this->flashSession->success('Input data berhasil');
            }
            $this->response->redirect('/pengiriman');
        }
    }

    public function editAction($id)
    {
        $peng = Pengiriman::findFirstById_pengiriman($id);
        $this->view->peng = $peng;   

        $find_pemilik = PemilikTruk::find([
            'conditions' => 'nama_pemilik != :name:',
            'bind' => [
                'name' => $peng->pemilik->nama_pemilik
            ],
        ]);

        $find_pabrik = Pabrik::find([
            'conditions' => 'nama_pabrik != :name:',
            'bind' => [
                'name' => $peng->pabrik->nama_pabrik
            ],
        ]);
        
        $this->view->pemilik =$find_pemilik;
        $this->view->pabrik =$find_pabrik;
    }

    public function updateAction($id)
    {
        $validation = new PengirimanValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pengiriman/tambah');
        }
        else
        {
            $peng = Pengiriman::findFirstById_pengiriman($id);
            $peng->assign(
                $this->request->getPost(),
                [
                    'id_pabrik',
                    'id_pemilik',
                    'harga_kirim',
                    'harga_supir'
                ]
            );
            $peng->updated_at = date('Y-m-d h:i:sa');
            $success = $peng->save();
            if($success)
            {
                $this->flashSession->success('Edit data berhasil');
            }
            $this->response->redirect('/pengiriman');
        }
    }

    public function hapusAction($id)
    {
        $peng = Pengiriman::findFirstById_pengiriman($id);

        $success = $peng->delete();
        if($success)
        {
            $this->flashSession->success('Delete data berhasil');
        }

        $this->response->redirect('/pengiriman');
    }
    public function searchAction()
    {
        $flag0=0;
        $flag1=0;
        $this->view->pemilik = PemilikTruk::find();
        $this->view->pabrik = Pabrik::find();
        if($this->request->getPost('id_pabrik'))
        {
            $id_pab = $this->request->getPost('id_pabrik');
            // $id_pab = Pabrik::findFirstByNama_pabrik($nama_pab);
            $flag0=1;

        }
        if($this->request->getPost('id_pemilik'))
        {
            $id_pem = $this->request->getPost('id_pemilik');
            // $id_pem = PemilikTruk::findFirstByNama_pemilik($nama_pem);
            $flag1=1;
        }

        if($flag0)
        {
            if($flag1)
            {
                $peng = Pengiriman::query()
                ->where('id_pemilik = :id_pem:')
                ->andWhere('id_pabrik = :id_pab:')
                ->bind(
                    [
                        'id_pab' => $id_pab,
                        'id_pem'  => $id_pem,
                    ]
                )
                ->execute();
            }
            else
            {
                $peng = Pengiriman::query()
                ->Where('id_pabrik = :id_pab:')
                ->bind(
                    [
                        'id_pab' => $id_pab,
                    ]
                )
                ->execute();
            }
            
        }
        else
        {
            $peng = Pengiriman::query()
            ->where('id_pemilik = :id_pem:')
            ->bind(
                [
                    'id_pem'  => $id_pem,
                ]
            )
            ->execute();
        }
        $this->view->peng = $peng;   


    }
    public function ajaxAction(){

        $id_pem = $this->request->get('id_pem');
        $id_pab = Pengiriman::find(
            [
                'columns'    => [
                    'id_pabrik',
                    // 'nama_pabrik'
                ],
                'conditions' => 'id_pemilik = :id_pem:',
                'bind'       => [
                    'id_pem' => $id_pem,
                ],
            ]
        );
        // $data = Pabrik::find(array(
        //     [
        //         'columns'    => [
        //             'id_pabrik'
        //             // 'nama_pabrik'
        //         ],
        //         'conditions' => 'id_pabrik IN :id_pab:',
        //         'bind'       => [
        //             'id_pab' => array($id_pab),
        //         ],
        //     ]
        // ));
        $data = Pabrik::query()
            ->where('id_pabrik NOT IN :id_pab:')
            ->bind(
                [
                    'id_pab'  => $id_pab,
                ]
            )
            ->execute();
        // $id_pab = Pengiriman::select('id_pabrik')->whereId_pemilik($id_pem)->get();
        // $data = Pabrik::select('id_pabrik', 'nama_pabrik')->whereNotIn('id_pabrik', $id_pab)->get();
        // return \Response::json($data);
        return $this->response->setJsonContent($data);
    }
}
