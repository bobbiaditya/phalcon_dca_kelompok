<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class PabrikValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'nama_pabrik',
            new PresenceOf(
                [
                    'message' => 'Nama Pabrik Harus ada',
                ]
            )
        );

        $this->add(
            'kode_pabrik',
            new PresenceOf(
                [
                    'message' => 'Kode Pabrik Harus ada',
                    // 'cancelOnFail' => true,
                ]
            )
        );

        $this->add(
            'harga_pasir',
            new PresenceOf(
                [
                    'message' => 'Harga pasir harus ada',
                    'cancelOnFail' => true,
                ]
            )
        );
        $this->add(
            'harga_pasir',
            new Numericality(
                [
                    'message' => 'Harga pasir dalam bentuk angka',
                ]
            )
        );
    }
}