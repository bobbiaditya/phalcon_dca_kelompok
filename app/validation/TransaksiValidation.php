<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class TransaksiValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'tanggal_transaksi',
            new PresenceOf(
                [
                    'message' => 'Tanggal harus diisi',
                ]
            )
        );

        $this->add(
            'id_pabrik',
            new PresenceOf(
                [
                    'message' => 'Pabrik harus ada yang dipilih',
                ]
            )
        );

        $this->add(
            'id_cucian',
            new PresenceOf(
                [
                    'message' => 'Tempat cucian harus ada yang dipilih',
                ]
            )
        );

        $this->add(
            'id_supir',
            new PresenceOf(
                [
                    'message' => 'Supir harus ada yang dipilih',
                ]
            )
        );

        $this->add(
            'volume_pasir',
            new PresenceOf(
                [
                    'message' => 'Volume pasir harus diisikan',
                    'cancelOnFail' => true
                ]
            )
        );
        $this->add(
            'volume_pasir',
            new Numericality(
                [
                    'message' => 'Volume pasir dalam bentuk angka',
                ]
            )
        );
    }
}