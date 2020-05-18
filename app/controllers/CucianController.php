<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\Cucian;
use App\Validation\CucianValidation;
date_default_timezone_set("Asia/Bangkok");
class CucianController extends ControllerBase
{
    // passing view
    public function indexAction()
    {
        // $role = $this->session->get('auth')['tipe'];
        // if($role == 'master')
        // {
            $this->view->cucian = Cucian::find();
        // }
        // else{
        //     $this->flashSession->error('User tidak bisa mengakses halaman ini');
        //     $this->response->redirect('/pemakaianalatberat');
        // }
    }
    // passing view
    public function tambahAction()
    {
        // $role = $this->session->get('auth')['tipe'];
        // if($role == 'master')
        // {
        //     $this->view->cucian = Cucian::find();
        // }
        // else{
        //     $this->flashSession->error('User tidak bisa mengakses halaman ini');
        //     $this->response->redirect('/pemakaianalatberat');
        // }
    }

    public function prosesAction()
    {
        $validation= new CucianValidation();
        $messages = $validation->validate($_POST);
        if (count($messages)) 
        {
            foreach ($messages as $message) 
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/cucian/tambah');
        }
        else 
        {
            // cek yg sudah ada
            $nama = $this->request->getPost('nama_cucian');
            $temp_nama = Cucian::findFirstByNama_cucian($nama);

            $kode = $this->request->getPost('kode_cucian');
            $temp_kode = Cucian::findFirstByKode_cucian($kode);

            if($temp_nama)
            {
                $this->flashSession->error('Nama Cucian telah dipakai');
                $this->response->redirect('/cucian/tambah');
            }
            elseif ($temp_kode) {
                $this->flashSession->error('Kode Cucian telah dipakai');
                $this->response->redirect('/cucian/tambah');
            }
            else{
            $cuci = new Cucian();

            $cuci->assign(
                $this->request->getPost(),
                [
                    'nama_cucian',
                    'kode_cucian'
                ]
            );
            $cuci->updated_at = date('Y-m-d h:i:sa');
            $cuci->created_at = date('Y-m-d h:i:sa');

            $success = $cuci->save();
            if($success)
            {
                $this->flashSession->success('Data berhasil diinputkan');
            }
    
            $this->response->redirect('/cucian'); 
        }      
        } 
    }
    // passing view
    public function editAction($id)
    {
        $cuci = Cucian::findFirstById_cucian($id);
        $this->view->cucian = $cuci;       
    }

    public function updateAction($id)
    {
        $validation= new CucianValidation();
        $messages = $validation->validate($_POST);
        if (count($messages)) 
        {
            foreach ($messages as $message) 
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/cucian/edit/'.$id);
        }
        else
        {
            $cuc = Cucian::findFirstById_cucian($id);
            $nama_cucian = $this->request->getPost('nama_cucian', 'string');
            $kode_cucian = $this->request->getPost('kode_cucian', 'string');
            $flag0=1;
            $flag1=1;
            if($cuc->nama_cucian != $nama_cucian)
            {
                $checkNamaCucian = Cucian::findFirst("nama_cucian = '$nama_cucian'");
                if($checkNamaCucian){
                    $flag0=0;
                    $this->flashSession->error('Nama Cucian sudah dipakai');
                    $this->response->redirect('/cucian/edit/'.$id);
                }
            }
            
            if($cuc->kode_cucian != $kode_cucian)
            {
                $checkKodeCucian = Cucian::findFirst("kode_cucian = '$kode_cucian'");
                if($checkKodeCucian){
                    $flag1=0;
                    $this->flashSession->error('Kode Cucian sudah dipakai');
                    $this->response->redirect('/cucian/edit/'.$id);
                }
            }
            if($flag0 && $flag1)
            {
                $cuc->assign(
                    $this->request->getPost(),
                    [
                        'nama_cucian',
                        'kode_cucian',
                    ]
                );
                $cuc->updated_at = date('Y-m-d h:i:sa');
                
        
                $success = $cuc->save();
                if($success)
                {
                    $this->flashSession->success('Update data berhasil');
                }
                $this->response->redirect('/cucian');
            }
            
        }
    }

    public function hapusAction($id)
    {
        $cuci = Cucian::findFirstById_cucian($id);

        $success = $cuci->delete();
        if($success)
        {
            $this->flashSession->success('Data berhasil dihapus');
        }

        $this->response->redirect('/cucian');
    }

}
