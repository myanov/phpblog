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
}