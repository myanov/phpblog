<?php


namespace Controllers;


use core\DB;
use core\DBDriver;
use core\User;
use core\Validator;
use Models\UserModel;

class UserController extends BaseController
{
    public function signUpAction()
    {
        $this->title = 'Регистрация';
        $errors = [];

        if($this->request->isPost()) {
            $mUser = new UserModel(new DBDriver(DB::connect()), new Validator());
            $user = new User($mUser);

            try {
                $user->signUp($this->request->getValue('post'));
                $this->redirect('');
            } catch (\Exception $e) {
                $errors = $e->getMessage();
            }
        }

        $this->content = $this->build('v_register', [
            'errors' => $errors,
            'login' => $this->request->getValue('post', 'login') ?? ''
        ]);
    }

    public function signInAction()
    {
        $this->title = 'Авторизация';
        $errors = [];

        if($this->request->isPost()) {
            $mUser = new UserModel(new DBDriver(DB::connect()), new Validator());
            $user = new User($mUser);
            $user->signIn($this->request->getValue('post'));
            $this->redirect('');
        }

        $this->content = $this->build('v_login',[
            'errors' => $errors ?? '',
        ]);
    }
}