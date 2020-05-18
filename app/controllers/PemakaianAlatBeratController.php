<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\AlatBerat;
use App\Models\PemakaianAlatBerat;
use App\Validation\PemakaianAlatBeratValidation;
date_default_timezone_set("Asia/Bangkok");
class PemakaianAlatBeratController extends ControllerBase
{
    // passing view
    public function indexAction()
    {
        $this->view->pemakaian = PemakaianAlatBerat::find([
            'order'      => 'tanggal_mulai desc'
        ]);    
    }
    // passing view
    public function tambahAction()
    {
        $this->view->alat = AlatBerat::find();
    }

    public function prosesAction()
    {
        $validation= new PemakaianAlatBeratValidation();
        $messages = $validation->validate($_POST);
        if (count($messages)) 
        {
            foreach ($messages as $message) 
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pemakaianalatberat/tambah');
        }
        else 
        {
            $pemakaian = new PemakaianAlatBerat();
            $pemakaian->assign(
                $this->request->getPost(),
                [
                    'tanggal_mulai',
                    'tanggal_selesai',
                    'jam_pakai'
                    ]
                );
            $nama_alat = $this->request->getPost('nama_alatBerat');
            $jam = $this->request->getPost('jam_pakai');
            $alat_berat = AlatBerat::findFirstByNama_alatBerat($nama_alat);
            $pemakaian->id_alatBerat = $alat_berat->id_alatBerat;
            $pemakaian->harga_pakai = $jam*$alat_berat->harga_alatBerat;
            $pemakaian->updated_at = date('Y-m-d h:i:sa');
            $pemakaian->created_at = date('Y-m-d h:i:sa');
            
            $success = $pemakaian->save();
            if($success)
            {
                $this->flashSession->success('Data berhasil diinputkan');
            }
            
            $this->response->redirect('/pemakaianalatberat');        
        }
    }
    // passing view
    public function editAction($id)
    {
        $pemakaian = PemakaianAlatBerat::findFirstById_pemakaian($id);
        $this->view->pemakaian = $pemakaian;    
        $cari_alat = AlatBerat::find([
            'conditions' => 'nama_alatBerat != :name:',
            'bind' => [
                'name' => $pemakaian->alat->nama_alatBerat
            ],
        ]);
        $this->view->alat =$cari_alat;   
    }

    public function updateAction($id)
    {
        $validation= new PemakaianAlatBeratValidation();
        $messages = $validation->validate($_POST);
        if (count($messages)) 
        {
            foreach ($messages as $message) 
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pemakaianalatberat/edit/'.$id);
        }
        
        else
        {
            $pemakaian = PemakaianAlatBerat::findFirstById_pemakaian($id);

            $pemakaian->assign(
                $this->request->getPost(),
                [
                    'tanggal_mulai',
                    'tanggal_selesai',
                    'jam_pakai'
                ]
            );
            $nama_alat = $this->request->getPost('nama_alatBerat');
            $jam = $this->request->getPost('jam_pakai');
            $alat_berat = AlatBerat::findFirstByNama_alatBerat($nama_alat);
            $pemakaian->id_alatBerat = $alat_berat->id_alatBerat;
            $pemakaian->harga_pakai = $jam*$alat_berat->harga_alatBerat;
            $pemakaian->updated_at = date('Y-m-d h:i:sa');

            $success = $pemakaian->save();
            if($success)
            {
                $this->flashSession->success('Data berhasil diedit');
            }
            $this->response->redirect('/pemakaianalatberat');
        }
    }

    public function hapusAction($id)
    {
        $pemakaian = PemakaianAlatBerat::findFirstById_pemakaian($id);

        $success = $pemakaian->delete();
        if($success)
        {
            $this->flashSession->success('Data berhasil dihapus');
        }
        $this->response->redirect('/pemakaianalatberat');
    }

    public function searchAction()
    {
        $flag0=0;
        $flag1=0;
        if($this->request->getPost('tanggal_awal'))
        {
            $tgl_awal = $this->request->getPost('tanggal_awal');
            $flag0=1;

        }
        if($this->request->getPost('tanggal_akhir'))
        {
            $tgl_akhir = $this->request->getPost('tanggal_akhir');
            $flag1=1;
        }

        if($flag0)
        {
            if($flag1)
            {
                $pemakaian = PemakaianAlatBerat::find([
                    'conditions' => 'tanggal_selesai < :tgl_akhir: AND '. 'tanggal_selesai > :tgl_awal:',
                    'bind' => [
                        'tgl_awal' => $tgl_awal,
                        'tgl_akhir'  => $tgl_akhir,
                    ],
                    'order'      => 'tanggal_mulai desc'
                ]);
            }
            else
            {
                $pemakaian = PemakaianAlatBerat::find([
                    'conditions' => 'tanggal_selesai > :tgl_awal:',
                    'bind' => [
                        'tgl_awal' => $tgl_awal,
                    ],
                    'order'      => 'tanggal_mulai desc'
                ]);
            }
            
        }
        else
        {
            $pemakaian = PemakaianAlatBerat::find([
                'conditions' => 'tanggal_selesai < :tgl_akhir:',
                'bind' => [
                    'tgl_akhir'  => $tgl_akhir,
                ],
                'order'      => 'tanggal_mulai desc'
            ]);
        }
        $this->view->pemakaian = $pemakaian;   


    }
}
