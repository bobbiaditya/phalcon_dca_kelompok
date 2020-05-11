<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class CucianValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'nama_cucian',
            new PresenceOf(
                [
                    'message' => 'Nama Cucian harus diisikan',
                ]
            )
        );

        $this->add(
            'kode_cucian',
            new PresenceOf(
                [
                    'message' => 'Kode Cucian harus diisikan',
                ]
            )
        );
    }
}