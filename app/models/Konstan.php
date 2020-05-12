<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class Konstan extends Model
{
    public $id_konstan;
    public $rate_mahsun;
    public $updated_at;
    public $created_at;

    public function initialize(){
        $this->setReadConnectionService('db');
        $this->setWriteConnectionService('db');
        $this->setSchema('dbo');
        $this->setSource('konstan');
    }

    public function onConstruct(){

    }
}