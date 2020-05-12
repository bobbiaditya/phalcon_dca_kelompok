<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Cucian;
use App\Models\Pabrik;
use App\Models\SupirTruk;
use App\Models\Transaksi;
use app\models\Pengiriman;
use App\models\Konstan;
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
            $trans->assign(
                $this->request->getPost(),
                [
                    'tanggal_transaksi',
                    'id_pabrik',
                    'id_cucian',
                    'id_supir',
                    'volume_pasir'
                ]
            );
            $harga_pasir = $trans->pabrik->harga_pasir;
            $find_pengiriman = Pengiriman::find([
                'conditions' => 'id_pabrik != :pab: AND '.'id_pemilik = :pem:',
                'bind' => [
                    'pab' => $trans->pabrik->id_pabrik,
                    'pem' => $trans->supir->pemilik->id_pemilik
                ],
            ]);
            $harga_kirim = $find_pengiriman->harga_kirim;
            $bon = 
            $konstan = Konstan::findFirstById_konstan(1);
            $rate_mahsun = $konstan->rate_mahsun;
            $trans->harga_pabrik = $trans->volume_pasir * $harga_pasir;
            $trans->volume_mahsun = $trans->volume_pasir;
            $trans->harga_mahsun = $trans->volume_mahsun * $rate_mahsun;
            $trans->volume_pemilikTruk = $trans->volume_pasir;
            $trans->harga_pemilikTruk = $trans->volume_pemilikTruk * $harga_kirim;
            $trans->bon_supir = $trans->supir->
            $trans->updated_at = date('Y-m-d h:i:sa');
            $trans->created_at = date('Y-m-d h:i:sa');
            
        }
    }
}
