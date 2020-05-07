<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\Pabrik;
use App\Validation\PabrikValidation;
date_default_timezone_set("Asia/Bangkok");
class PabrikController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->pabriks = Pabrik::find();
    }

    public function tambahAction()
    {

    }

    public function prosesAction()
    {
        $validation= new PabrikValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pabrik/tambah');
        }
        else
        {
            $nama_pabrik = $this->request->getPost('nama_pabrik', 'string');
            $kode_pabrik = $this->request->getPost('kode_pabrik', 'string');
            $checkNamaPabrik = Pabrik::findFirst("nama_pabrik = '$nama_pabrik'");
            $checkKodePabrik = Pabrik::findFirst("kode_pabrik = '$kode_pabrik'");

            if($checkNamaPabrik){
                $this->flashSession->error('Nama Pabrik sudah dipakai');
                $this->response->redirect('/pabrik/tambah');
            }
            elseif($checkKodePabrik){
                $this->flashSession->error('Kode Pabrik sudah dipakai');
                $this->response->redirect('/pabrik/tambah');
            }
            else
            {
                $pab = new Pabrik();
                $pab->assign(
                    $this->request->getPost(),
                    [
                        'nama_pabrik',
                        'kode_pabrik',
                        'harga_pasir'
                    ]
                );
                $pab->updated_at = date('Y-m-d h:i:sa');
                $pab->created_at = date('Y-m-d h:i:sa');
        
                $success = $pab->save();
    
                if($success)
                {
                    $this->flashSession->success('Input data berhasil');
                }
        
                $this->response->redirect('/pabrik');
            }
        }


    }

    public function editAction($id)
    {
        $pab = Pabrik::findFirstById_pabrik($id);
        $this->view->pabrik = $pab;       
    }

    public function updateAction($id)
    {
        $validation= new PabrikValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/pabrik/edit');
        }
        else
        {
            $pab = Pabrik::findFirstById_pabrik($id);
            $nama_pabrik = $this->request->getPost('nama_pabrik', 'string');
            $kode_pabrik = $this->request->getPost('kode_pabrik', 'string');
            $flag0=0;
            $flag1=0;
            if($pab->nama_pabrik != $nama_pabrik)
            {
                $checkNamaPabrik = Pabrik::findFirst("nama_pabrik = '$nama_pabrik'");
                if($checkNamaPabrik){
                    $this->flashSession->error('Nama Pabrik sudah dipakai');
                    $this->response->redirect('/pabrik/edit/'.$id);
                }
                else
                {
                    $flag0=1;
                }
            }
            if($pab->kode_pabrik != $kode_pabrik)
            {
                $checkKodePabrik = Pabrik::findFirst("kode_pabrik = '$kode_pabrik'");
                if($checkKodePabrik){
                    $this->flashSession->error('Kode Pabrik sudah dipakai');
                    $this->response->redirect('/pabrik/edit/'.$id);
                }
                else
                {
                    $flag1=1;
                }
            }
            if($flag0 && $flag1)
            {
                $pab->assign(
                    $this->request->getPost(),
                    [
                        'nama_pabrik',
                        'kode_pabrik',
                        'harga_pasir'
                    ]
                );
                $pab->updated_at = date('Y-m-d h:i:sa');
                
        
                $success = $pab->save();
                if($success)
                {
                    $this->flashSession->success('Update data berhasil');
                }
                $this->response->redirect('/pabrik');
            }
            
        }
    }

    public function hapusAction($id)
    {
        $pab = Pabrik::findFirstById_pabrik($id);

        $success = $pab->delete();
        if($success)
        {
            $this->flashSession->success('Delete data berhasil');
        }
        $this->response->redirect('/pabrik');
    }

}

