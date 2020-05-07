<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\SupirTruk;
use App\Models\PemilikTruk;
use App\Validation\SupirValidation;
date_default_timezone_set("Asia/Bangkok");
class SupirTrukController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->supir = SupirTruk::find();
    }

    public function tambahAction()
    {
        $this->view->pemilik = PemilikTruk::find();
    }

    public function prosesAction()
    {
        $validation = new SupirValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/supirtruk/tambah');
        }
        else
        {
            $sup = new SupirTruk();
            $nama_supir = $this->request->getPost('nama_supir', 'string');
            $checkNamaSupir = SupirTruk::findFirst("nama_supir = '$nama_supir'");
            if($checkNamaSupir){
                $this->flashSession->error('Nama Supir sudah dipakai');
                $this->response->redirect('/supirtruk/tambah');
            }
            else
            {
                $sup->assign(
                    $this->request->getPost(),
                    [
                        'id_pemilik',
                        'nama_supir',
                        'nopol'
                    ]
                );
                $sup->updated_at = date('Y-m-d h:i:sa');
                $sup->created_at = date('Y-m-d h:i:sa');
                $success = $sup->save();
                if($success)
                {
                    $this->flashSession->success('Input data berhasil');
                }
                $this->response->redirect('/supirtruk');
            }
        }
    }

    public function editAction($id)
    {
        $sup = SupirTruk::findFirstById_supir($id);
        $this->view->supir = $sup;   

        $find_pemilik = PemilikTruk::find([
            'conditions' => 'nama_pemilik != :name:',
            'bind' => [
                'name' => $sup->pemilik->nama_pemilik
            ],
        ]);
        $this->view->pemilik =$find_pemilik;
    }

    public function updateAction($id)
    {
        $validation = new SupirValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/supirtruk/edit/'.$id);
        }
        else
        {
            $sup = SupirTruk::findFirstById_supir($id);
            $nama_supir = $this->request->getPost('nama_supir', 'string');
            $checkNamaSupir = SupirTruk::findFirst("nama_supir = '$nama_supir'");
            $flag=0;
            if($sup->nama_supir != $nama_supir)
            {
                if($checkNamaSupir){
                    $this->flashSession->error('Nama Supir sudah dipakai');
                    $this->response->redirect('/supirtruk/edit/'.$id);
                }
                else{
                    $flag=1;
                }
            }
            if($flag)
            {
                $sup->assign(
                    $this->request->getPost(),
                    [
                        'id_pemilik',
                        'nama_supir',
                        'nopol'
                    ]
                );
                $sup->updated_at = date('Y-m-d h:i:sa');
                
        
                $success = $sup->save();
                if($success)
                {
                    $this->flashSession->success('Edit data berhasil');
                }
        
                $this->response->redirect('/supirtruk');
            }
        }
    }

    public function hapusAction($id)
    {
        $sup = SupirTruk::findFirstById_supir($id);

        $success = $sup->delete();
        if($success)
        {
            $this->flashSession->success('Delete data berhasil');
        }

        $this->response->redirect('/supirtruk');
    }
}

