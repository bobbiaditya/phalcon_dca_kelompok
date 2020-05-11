<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class SupirTruk extends Model
{
    public $id_supir;
    public $id_pemilik;
    public $nama_supir;
    public $nopol;
    public $updated_at;
    public $created_at;

    /**
     *  Dipanggil sekali untuk digunakan seluruh instance
     */
    public function initialize(){
        // Untuk mengeset database service yang digunakan untuk read data, default: 'db'
        // database service harus diregister di container dependecy injector
        $this->setReadConnectionService('db');

        // Untuk mengeset database service yang digunakan untuk write data, default : 'db'
        $this->setWriteConnectionService('db');

        // Untuk mengeset schema, default : empty string
        $this->setSchema('dbo');

        // Untuk mengeset nama tabel, default : nama class
        $this->setSource('supir_truk');

        $this->belongsTo(
            'id_pemilik',
            PemilikTruk::class,
            'id_pemilik',
            [
                'reusable' => true,
                'alias'    => 'pemilik'
            ]
        );
        
        $this->hasMany(
            'id_supir',
            Transaksi::class,
            'id_supir',
            [
                'reusable' => true,
                'alias'    => 'transaksi'
            ]
        );
    }

    /**
     *  Dipanggil setiap pembuatan instace class baru
     */
    public function onConstruct(){

    }

}