<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Cucian;
use App\Models\Pabrik;
use App\Models\SupirTruk;
use App\Models\Transaksi;

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
        
    }
}
