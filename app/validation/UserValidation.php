<?php

namespace App\Validation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
class UserValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'username',
            new PresenceOf(
                [
                    'message' => 'Username Harus ada',
                    'cancelOnFail' => true,
                ]
            )
        );
        $this->add(
            'pwd',
            new PresenceOf(
                [
                    'message' => 'Password harus ada',
                ]
            )
        );

        $this->add(
            'tipe',
            new PresenceOf(
                [
                    'message' => 'Tipe user harus dipilih',
                ]
            )
        );
    }
}