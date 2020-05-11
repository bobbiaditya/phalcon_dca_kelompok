<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class AlatBeratValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'nama_alatBerat',
            new PresenceOf(
                [
                    'message' => 'Nama Alat Berat harus diisikan',
                ]
            )
        );

        $this->add(
            'harga_alatBerat',
            new PresenceOf(
                [
                    'message' => 'Harga Alat Berat harus diisikan',
                    'cancelOnFail' => true
                ]
            )
        );

        $this->add(
            'harga_alatBerat',
            new Numericality(
                [
                    'message' => 'Harga Alat Berat harus dalam bentuk angka',
                ]
            )
        );
    }
}