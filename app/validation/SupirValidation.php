<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
// use Phalcon\Validation\Validator\Uniqueness;
use App\Models\SupirTruk;
class SupirValidation extends Validation{
    public function initialize()
    {
        $this->add(
            'id_pemilik',
            new PresenceOf(
                [
                    'message' => 'Pemilik Truk harus dipilih',
                ]
            )
        );
        $this->add(
            'nama_supir',
            new PresenceOf(
                [
                    'message' => 'Nama Supir harus ada',
                    // 'cancelOnFail' => true,
                ]
            )
        );
        // $this->add(
        //     'nama_supir',
        //     new Uniqueness(
        //         [
        //             "model"   => new SupirTruk(),
        //             'message' => 'Nama Supir Sudah Dipakai',
        //         ]
        //     )
        // );
        $this->add(
            'nopol',
            new PresenceOf(
                [
                    'message' => 'Nomor Polisi Harus ada',
                ]
            )
        );
    }
}