<?php
declare(strict_types=1);

namespace App\Controllers;
// namespace App\Models;

use App\Models\Users;
use App\Validation\UserValidation;
date_default_timezone_set("Asia/Bangkok");
class UserController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->users = Users::find();
    }
    public function masterAction()
    {

    }
    public function adminAction()
    {
        
    }
    public function tambahAction()
    {
        
    }
    public function registerAction()
    {
        $validation = new UserValidation();
        $messages = $validation->validate($_POST);
        if(count($messages))
        {
            foreach ($messages as $message)
            {
                $this->flashSession->error($message->getMessage());
            }
            $this->response->redirect('/user/tambah');
        }
        else
        {
            $username = $this->request->getPost('username', 'string');
            $pwd = $this->request->getPost('pwd', 'string');
            $tipe = $this->request->getPost('tipe','string');
    
            $checkUser = Users::findFirst("username = '$username'");
            if($checkUser){
                $this->flashSession->error('Username sudah dipakai');
                $this->response->redirect('/user/tambah');
            }
            else
            {
                $user = new Users();
                $user->username=$username;
                $user->pwd=$this->security->hash($pwd);
                $user->tipe=$tipe;
                $user->updated_at = date('Y-m-d h:i:sa');
                $user->created_at = date('Y-m-d h:i:sa');
                // Store and check for errors
                $success = $user->save();
        
        
                if($success)
                {
                    $this->flashSession->success('Input data berhasil');
                }
                // passing a message to the view
                $this->response->redirect('/user');
            }
        }
    }
    public function hapusAction($id)
    {
        $user = Users::findFirstById_user($id);

        $success = $user->delete();
        if($success)
        {
            $this->flashSession->success('Delete data berhasil');
        }
        $this->response->redirect('/user');
    }
}

