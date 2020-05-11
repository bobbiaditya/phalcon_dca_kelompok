<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Date;
use Phalcon\Validation\Validator\Numericality;

class PemakaianAlatBeratValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'nama_alatBerat',
            new PresenceOf(
                [
                    'message' => 'Nama Alat Berat harus dipilih',
                ]
            )
        );

        $this->add(
            'tanggal_mulai',
            new PresenceOf(
                [
                    'message' => 'Tanggal Mulai harus diisikan',
                ]
            )
        );

        $this->add(
            'tanggal_mulai',
            new Date(
                [
                    'message' => 'Tanggal Mulai harus dengan format yang benar',
                ]
            )
        );
        $this->add(
            'tanggal_selesai',
            new PresenceOf(
                [
                    'message' => 'Tanggal Selesai harus diisikan',
                ]
            )
        );

        $this->add(
            'tanggal_selesai',
            new Date(
                [
                    'message' => 'Tanggal Selesai harus dengan format yang benar',
                ]
            )
        );
        $this->add(
            'jam_pakai',
            new PresenceOf(
                [
                    'message' => 'Jam Pakai harus diisikan',
                ]
            )
        );
        $this->add(
            'jam_pakai',
            new Numericality(
                [
                    'message' => 'Jam Pakai harus dalam bentuk angka',
                ]
            )
        );
        
    }
}