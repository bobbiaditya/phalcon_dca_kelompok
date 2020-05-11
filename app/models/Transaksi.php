<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class Transaksi extends Model
{
    public $id_transaksi;
    public $id_cucian;
    public $id_supir;
    public $id_pabrik;
    public $tanggal_transaksi;
    public $volume_pasir;
    public $harga_pabrik;
    public $volume_mahsun;
    public $harga_mahsun;
    public $volume_pemilikTruk;
    public $harga_pemilikTruk;
    public $bon_supir;
    public $total_modal;
    public $keterangan;
    public $updated_at;
    public $created_at;

    public function initialize(){
        $this->setReadConnectionService('db');
        $this->setWriteConnectionService('db');
        $this->setSchema('dbo');
        $this->setSource('transaksi');
        $this->belongsTo(
            'id_cucian',
            Cucian::class,
            'id_cucian',
            [
                'reusable' => true,
                'alias'    => 'cucian'
            ]
        );
        $this->belongsTo(
            'id_supir',
            SupirTruk::class,
            'id_supir',
            [
                'reusable' => true,
                'alias'    => 'supir'
            ]
        );
        $this->belongsTo(
            'id_pabrik',
            Cucian::class,
            'id_pabrik',
            [
                'reusable' => true,
                'alias'    => 'pabrik'
            ]
        );
    }

    public function onConstruct(){

    }
}