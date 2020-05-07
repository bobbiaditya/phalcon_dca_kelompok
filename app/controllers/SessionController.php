<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;

class SessionController extends ControllerBase
{

    public function beforeExecuteRoute()
    {
    }

    public function indexAction()
    {
    }

    public function loginAction()
    {
        $username = $this->request->getPost('username', 'string');
        $pwd = $this->request->getPost('pwd', 'string');
        $user = Users::findFirst(
            [
                'conditions' => 'username = :username:',
                'bind'       => [
                    'username' => $username,
                ],
            ]
        );
        if ($user) {
            // Check user's password
            $check = $this
                ->security
                ->checkHash($pwd, $user->pwd);
            if ($check === true) {

                if ($user->tipe == 'master') {
                    // Set a session
                    $this->session->set(
                        'auth',
                        [
                            'id_user' => $user->id_user,
                            'username' => $user->username,
                            'pwd' => $user->pwd,
                            'tipe' => $user->tipe,
                            'status' => '1',
                        ]
                    );
                    $this->response->redirect('/user/master');
                } else if ($user->tipe == 'admin') {
                    // Set a session
                    $this->session->set(
                        'auth',
                        [
                            'id_user' => $user->id_user,
                            'username' => $user->username,
                            'pwd' => $user->pwd,
                            'tipe' => $user->tipe,
                            'status' => '1',
                        ]
                    );
                    $this->response->redirect('/user/admin');
                }
            } else {
                $this->flashSession->error('Password Salah');
                $this->response->redirect('/');
            }
        } else {
            $this->flashSession->error('Username Salah');
            $this->response->redirect('/');
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('/');
    }
}
