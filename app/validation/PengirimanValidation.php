<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class PengirimanValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'id_pabrik',
            new PresenceOf(
                [
                    'message' => 'Pabrik harus ada yang dipilih',
                ]
            )
        );

        $this->add(
            'id_pemilik',
            new PresenceOf(
                [
                    'message' => 'Pabrik harus ada yang dipilih',
                ]
            )
        );

        $this->add(
            'harga_kirim',
            new PresenceOf(
                [
                    'message' => 'Harga kirim harus diisikan',
                    'cancelOnFail' => true
                ]
            )
        );

        $this->add(
            'harga_kirim',
            new Numericality(
                [
                    'message' => 'Harga kirim dalam bentuk angka',
                ]
            )
        );

        $this->add(
            'harga_supir',
            new PresenceOf(
                [
                    'message' => 'Harga supir harus diisikan',
                    'cancelOnFail' => true
                ]
            )
        );

        $this->add(
            'harga_supir',
            new Numericality(
                [
                    'message' => 'Harga supir dalam bentuk angka',
                ]
            )
        );
    }
}