<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\Pabrik;
use App\Models\Transaksi;
use App\Models\PemakaianAlatBerat;
date_default_timezone_set("Asia/Bangkok");
class MahsunController extends ControllerBase
{

    public function indexAction()
    {

    }
    public function laporanAction()
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
                    'order'      => 'tanggal_transaksi desc',
                ]);

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
                $trans = Transaksi::find([
                    'conditions' => 'tanggal_transaksi > :tgl_awal:',
                    'bind' => [
                        'tgl_awal' => $tgl_awal,
                    ],
                    'order'      => 'tanggal_transaksi desc'
                ]);

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
            $trans = Transaksi::find([
                'conditions' => 'tanggal_transaksi < :tgl_akhir:',
                'bind' => [
                    'tgl_akhir'  => $tgl_akhir,
                ],
                'order'      => 'tanggal_transaksi desc',
            ]);

            $pemakaian = PemakaianAlatBerat::find([
                'conditions' => 'tanggal_selesai < :tgl_akhir:',
                'bind' => [
                    'tgl_akhir'  => $tgl_akhir,
                ],
                'order'      => 'tanggal_mulai desc'
            ]);
        }
        $this->view->trans = $trans;   
        $this->view->pemakaian = $pemakaian;

    }

}
?>