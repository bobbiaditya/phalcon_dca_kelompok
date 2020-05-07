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
            $cuci = Cucian::findFirstById_cucian($id);
            $nama = $this->request->getPost('nama_cucian');
            $kode = $this->request->getPost('kode_cucian');
            $f_nama=0;
            $f_kode=0;
            if($cuci->nama_cucian != $nama)
            {
                $temp_nama = Cucian::findFirstByNama_cucian($nama);
                if($temp_nama){
                    $this->flashSession->error('Nama Cucian sudah dipakai');
                    $this->response->redirect('/cucian/edit/'.$id);
                }
                else
                {
                    $f_nama=1;
                }
            }
            if($cuci->kode_cucian != $kode)
            {
                $temp_kode = Cucian::findFirstByKode_cucian($kode);
                if($temp_kode){
                    $this->flashSession->error('Kode Cucian sudah dipakai');
                    $this->response->redirect('/cucian/edit/'.$id);
                }
                else
                {
                    $f_kode=1;
                }
            }
            // cek yg sudah ada
            if($cuci->kode_cucian == $kode || $cuci->nama_cucian == $nama ||($f_nama && $f_kode)){
                
            // $cuci = Cucian::findFirstById_cucian($id);

            $cuci->assign(
                $this->request->getPost(),
                [
                    'nama_cucian',
                    'kode_cucian'
                ]
            );
            $cuci->updated_at = date('Y-m-d h:i:sa');
            
            $success = $cuci->save();
            if($success)
            {
                $this->flashSession->success('Data berhasil diedit');
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
