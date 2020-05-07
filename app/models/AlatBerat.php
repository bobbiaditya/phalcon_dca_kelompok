<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class AlatBerat extends Model
{
    public $id_alatBerat;
    public $nama_alatBerat;
    public $harga_alatBerat;
    public $updated_at;
    public $created_at;

    public function initialize(){
        $this->setReadConnectionService('db');
        $this->setWriteConnectionService('db');
        $this->setSchema('dbo');
        $this->setSource('alat_berat');
        $this->hasMany(
            'id_alatBerat',
            PemakaianAlatBerat::class,
            'id_alatBerat',
            [
                'reusable' => true,
                'alias'    => 'pemakaian'
            ]
        );
    }

    public function onConstruct(){

    }
}