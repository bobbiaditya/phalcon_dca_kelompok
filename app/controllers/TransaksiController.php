<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Cucian;
use App\Models\Pabrik;
use App\Models\SupirTruk;
use App\Models\Transaksi;
use App\Models\Pengiriman;
use App\Models\Konstan;
use App\Validation\TransaksiValidation;
date_default_timezone_set("Asia/Bangkok");
class TransaksiController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->trans = Transaksi::find();
    }

    public function tambahAction()
    {
        $this->view->supir = SupirTruk::find();
        $this->view->cucian = Cucian::find();
        $this->view->pabrik = Pabrik::find();
    }

    public function prosesAction()
    {
        $validation = new TransaksiValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/transaksi/tambah');
        }
        else
        {
            $trans = new Transaksi();
            $pab = Pabrik::findFirstByNama_pabrik($this->request->getPost('nama_pabrik', 'string'));
            $cuc = Cucian::findFirstByNama_cucian($this->request->getPost('nama_cucian', 'string'));
            $sup = SupirTruk::findFirstByNama_supir($this->request->getPost('nama_supir', 'string'));
            $trans->assign(
                $this->request->getPost(),
                [
                    'tanggal_transaksi',
                    'volume_pasir',
                    'keterangan'
                ]
            );
            $trans->id_pabrik = $pab->id_pabrik;
            $trans->id_cucian = $cuc->id_cucian;
            $trans->id_supir = $sup->id_supir;
            $harga_pasir = $trans->pabrik->harga_pasir;
            $find_pengiriman = Pengiriman::findFirst([
                'conditions' => 'id_pabrik != :pab: AND '.'id_pemilik = :pem:',
                'bind' => [
                    'pab' => $trans->pabrik->id_pabrik,
                    'pem' => $trans->supir->pemilik->id_pemilik
                ],
            ]);
            $harga_kirim = $find_pengiriman->harga_kirim;
            $bon = $find_pengiriman->harga_supir;
            $konstan = Konstan::findFirstById_konstan(1);
            $rate_mahsun = $konstan->rate_mahsun;
            $trans->harga_pabrik = $trans->volume_pasir * $harga_pasir;
            $trans->volume_mahsun = $trans->volume_pasir;
            $trans->harga_mahsun = $trans->volume_mahsun * $rate_mahsun;
            $trans->volume_pemilikTruk = $trans->volume_pasir;
            $trans->harga_pemilikTruk = $trans->volume_pemilikTruk * $harga_kirim;
            $trans->bon_supir = $bon;
            $trans->total_modal = $trans->harga_mahsun + $trans->harga_pemilikTruk;
            $trans->updated_at = date('Y-m-d h:i:sa');
            $trans->created_at = date('Y-m-d h:i:sa');

            $success = $trans->save();
            if($success)
            {
                $this->flashSession->success('simpan data berhasil');
            }
    
            $this->response->redirect('/transaksi');
        }
    }

    public function editAction($id)
    {
        $trans = Transaksi::findFirstById_transaksi($id);
        $this->view->trans = $trans;
        $this->view->supir = SupirTruk::find();
        $this->view->cucian = Cucian::find();
        $this->view->pabrik = Pabrik::find();
    }

    public function updateAction($id)
    {
        $validation = new TransaksiValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/transaksi/edit');
        }
        else
        {
            $trans = Transaksi::findFirstById_transaksi($id);
            $pab = Pabrik::findFirstByNama_pabrik($this->request->getPost('nama_pabrik', 'string'));
            $cuc = Cucian::findFirstByNama_cucian($this->request->getPost('nama_cucian', 'string'));
            $sup = SupirTruk::findFirstByNama_supir($this->request->getPost('nama_supir', 'string'));
            $trans->assign(
                $this->request->getPost(),
                [
                    'tanggal_transaksi',
                    'volume_pasir',
                    'keterangan'
                ]
            );
            $trans->id_pabrik = $pab->id_pabrik;
            $trans->id_cucian = $cuc->id_cucian;
            $trans->id_supir = $sup->id_supir;
            $harga_pasir = $trans->pabrik->harga_pasir;
            $find_pengiriman = Pengiriman::findFirst([
                'conditions' => 'id_pabrik != :pab: AND '.'id_pemilik = :pem:',
                'bind' => [
                    'pab' => $trans->pabrik->id_pabrik,
                    'pem' => $trans->supir->pemilik->id_pemilik
                ],
            ]);
            $harga_kirim = $find_pengiriman->harga_kirim;
            $bon = $find_pengiriman->harga_supir;
            $konstan = Konstan::findFirstById_konstan(1);
            $rate_mahsun = $konstan->rate_mahsun;
            $trans->harga_pabrik = $trans->volume_pasir * $harga_pasir;
            $trans->volume_mahsun = $trans->volume_pasir;
            $trans->harga_mahsun = $trans->volume_mahsun * $rate_mahsun;
            $trans->volume_pemilikTruk = $trans->volume_pasir;
            $trans->harga_pemilikTruk = $trans->volume_pemilikTruk * $harga_kirim;
            $trans->bon_supir = $bon;
            $trans->total_modal = $trans->harga_mahsun + $trans->harga_pemilikTruk;
            $trans->updated_at = date('Y-m-d h:i:sa');

            $success = $trans->save();
            if($success)
            {
                $this->flashSession->success('simpan data berhasil');
            }
    
            $this->response->redirect('/transaksi');
        }
    }

    public function hapusAction($id)
    {
        $trans = Transaksi::findFirstById_transaksi($id);

        $success = $trans->delete();
        if($success)
        {
            $this->flashSession->success('Delete data berhasil');
        }

        $this->response->redirect('/transaksi');
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
                $trans = Transaksi::find([
                    'conditions' => 'tanggal_transaksi < :tgl_akhir: AND '. 'tanggal_transaksi > :tgl_awal:',
                    'bind' => [
                        'tgl_awal' => $tgl_awal,
                        'tgl_akhir'  => $tgl_akhir,
                    ],
                ]);
            }
            else
            {
                $trans = Transaksi::find([
                    'conditions' => 'tanggal_transaksi > :tgl_awal:',
                    'bind' => [
                        'tgl_awal' => $tgl_awal,
                    ],
                ]);
            }
            
        }
        else
        {
            $trans = Transaksi::find([
                'conditions' => 'tanggal_transaksi < :tgl_akhir:',
                'bind' => [
                    'tgl_akhir'  => $tgl_akhir,
                ],
            ]);
        }
        $this->view->trans = $trans;   


    }
}
