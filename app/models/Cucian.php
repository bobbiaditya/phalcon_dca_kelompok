<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class Cucian extends Model
{
    public $id_cucian;
    public $nama_cucian;
    public $kode_cucian;
    public $updated_at;
    public $created_at;

    public function initialize(){
        $this->setReadConnectionService('db');
        $this->setWriteConnectionService('db');
        $this->setSchema('dbo');
        $this->setSource('cucian');
    }

    public function onConstruct(){

    }
}