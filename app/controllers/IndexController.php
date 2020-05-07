<?php

declare(strict_types=1);

namespace App\Controllers;
// use Phalcon\Mvc\Controller;
class IndexController extends ControllerBase
{
    public function beforeExecuteRoute()
    {
    }
    public function indexAction()
    {
        if ($this->session->get('auth')['tipe']) {
            $auth = $this->session->get('auth')['tipe'];
            if ($auth == 'master') {
                $this->response->redirect('/user/master');
            } else if ($auth == 'admin') {
                $this->response->redirect('/user/admin');
            }
        }
    }
}
