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
        $user = $this->mUser->getByLogin($fields['login']);
        if(!$user) {
            // throw
        }

        $matched = $this->mUser->getHash($fields['password']) === $user['password'];
        if(!$matched) {
            // throw
        }

        if(isset($fields['remember']) && !empty($fields['remember'])) {
            // Set cookie
        }

        return true;
    }
}