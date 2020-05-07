<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class PemakaianAlatBerat extends Model
{
    public $id_pemakaian;
    public $id_alatBerat;
    public $tanggal_mulai;
    public $tanggal_selesai;
    public $jam_pakai;
    public $harga_pakai;
    public $updated_at;
    public $created_at;

    public function initialize(){
        $this->setReadConnectionService('db');
        $this->setWriteConnectionService('db');
        $this->setSchema('dbo');
        $this->setSource('pemakaian_alatberat');
        $this->belongsTo(
            'id_alatBerat',
            AlatBerat::class,
            'id_alatBerat',
            [
                'reusable' => true,
                'alias'    => 'alat'
            ]
        );
    }

    public function onConstruct(){

    }
}