<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\PemilikTruk;
use App\Models\SupirTruk;
use App\Validation\PemilikValidation;
date_default_timezone_set("Asia/Bangkok");
class PemilikTrukController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->pemilik = PemilikTruk::find();
    }

    public function tambahAction()
    {

    }

    public function prosesAction()
    {
        $validation = new PemilikValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pemiliktruk/tambah');
        }
        else
        {
            $pem = new PemilikTruk();
            $nama_pemilik = $this->request->getPost('nama_pemilik', 'string');
            $checkNamaPemilik = PemilikTruk::findFirst("nama_pemilik = '$nama_pemilik'");
            if($checkNamaPemilik){
                $this->flashSession->error('Nama sudah dipakai');
                $this->response->redirect('/pemiliktruk/tambah');
            }
            else
            {
                $pem->assign(
                    $this->request->getPost(),
                    [
                        'nama_pemilik',
                    ]
                );
                $pem->updated_at = date('Y-m-d h:i:sa');
                $pem->created_at = date('Y-m-d h:i:sa');
        
                $success = $pem->save();
    
                if($success)
                {
                    $this->flashSession->success('Input data berhasil');
                }
                $this->response->redirect('/pemiliktruk');
            }
        }

    }

    public function editAction($id)
    {
        $pem = PemilikTruk::findFirstById_pemilik($id);
        $this->view->pemilik = $pem;       
    }

    public function updateAction($id)
    {
        $validation = new PemilikValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pemiliktruk/edit');
        }
        else
        {
            $pem = PemilikTruk::findFirstById_pemilik($id);
            $nama_pemilik = $this->request->getPost('nama_pemilik', 'string');
            $flag=1;
            if($pem->nama_pemilik != $nama_pemilik)
            {
                $checkNamaPemilik = PemilikTruk::findFirst("nama_pemilik = '$nama_pemilik'");
                if($checkNamaPemilik){
                    $flag=0;
                    $this->flashSession->error('Nama sudah dipakai');
                    $this->response->redirect('/pemiliktruk/edit/'.$id);
                }
            }
            if($flag)
            {
                $pem->assign(
                    $this->request->getPost(),
                    [
                        'nama_pemilik',
                    ]
                );
                $pem->updated_at = date('Y-m-d h:i:sa');
                
                $success = $pem->save();
                
                if($success)
                {
                    $this->flashSession->success('Edit data berhasil');
                }
        
                $this->response->redirect('/pemiliktruk');
            }
        }
    }

    public function hapusAction($id)
    {
        $pem = PemilikTruk::findFirstById_pemilik($id);
        $sup = SupirTruk::findFirstById_pemilik($id);
        if($sup)
        {
            $this->flashSession->error('Delete data gagal,Pemilik truk masih memiliki supir');
        }
        else
        {
            $success = $pem->delete();
            
            if($success)
            {
                $this->flashSession->success('Delete data berhasil');
            }
        }
        $this->response->redirect('/pemiliktruk');
    }
}

