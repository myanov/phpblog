<?php


namespace core;


use Models\UserModel;

class User
{
    private $mUser;

    public function __construct(UserModel $mUser)
    {
        $this->mUser = $mUser;
    }

    public function signUp(array $fields)
    {
        $this->mUser->signUp($fields);
    }

    public function signIn(array $fields)
    {
        $res = $this->mUser->signIn($fields);
        if(!empty($res)) {
            $_SESSION['is_auth'] = true;
        }
    }
}