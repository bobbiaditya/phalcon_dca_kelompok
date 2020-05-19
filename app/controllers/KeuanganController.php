<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\Pabrik;
use App\Models\Transaksi;
use App\Models\PemakaianAlatBerat;
date_default_timezone_set("Asia/Bangkok");
class KeuanganController extends ControllerBase
{

    public function indexAction()
    {
        $harga_mahsun = Transaksi::sum(
            [
                'column' => 'harga_mahsun',
            ]
        );
        $bon_supir = Transaksi::sum(
            [
                'column' => 'bon_supir',
            ]
        );
        $pemakaian = PemakaianAlatBerat::sum(
            [
                'column' => 'harga_pakai',
            ]
            );

        $piutang = Transaksi::sum(
            [
                'column' => 'harga_pabrik',
            ]
        );
        $pemilik = Transaksi::sum(
            [
                'column' => 'harga_pemilikTruk',
            ]
        );

        $pabrik = Pabrik::find();
        $this->view->utangpemilik = $pemilik -$bon_supir;
        $this->view->piutang = $piutang;
        $this->view->utangmashun = $pemakaian - ($harga_mahsun + $bon_supir);
        $this->view->pabrik = $pabrik; 
    }

}
?>