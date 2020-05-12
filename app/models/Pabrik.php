<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
class Pabrik extends Model
{
    public $id_pabrik;
    public $nama_pabrik;
    public $kode_pabrik;
    public $harga_pasir;
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
        $this->setSource('pabrik');

        $this->hasMany(
            'id_pabrik',
            Transaksi::class,
            'id_pabrik',
            [
                'reusable' => true,
                'alias'    => 'transaksi'
            ]
        );

        $this->hasMany(
            'id_pabrik',
            Pengiriman::class,
            'id_pabrik',
            [
                'reusable' => true,
                'alias'    => 'pengiriman'
            ]
        );

        $this->hasManyToMany(
            'id_pabrik',
            Pengiriman::class,
            'id_pabrik',
            'id_pemilik',
            PemilikTruk::class,
            'id_pemilik',
            [
                'reusable' => true,
                'alias'    => 'pabrikPengiriman',
            ]
        );
    }

    /**
     *  Dipanggil setiap pembuatan instace class baru
     */
    public function onConstruct(){

    }

}