<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class PemilikValidation extends Validation{
    public function initialize()
    {
        $this->add(
            'nama_pemilik',
            new PresenceOf(
                [
                    'message' => 'Nama Pemilik Harus ada',
                ]
            )
        );
    }
}