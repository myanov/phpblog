<?php

namespace Models;

class CheckAuthModel
{
    private static $is_auth = false;

    public static function check()
    {
        if(isset($_SESSION['is_auth']) && $_SESSION['is_auth']) {
            self::$is_auth = true;
        } elseif(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
            if($_COOKIE['login'] == 'admin' && password_verify('admin', $_COOKIE['password'])) {
                $_SESSION['is_auth'] = true;
                self::$is_auth = true;
            }
        }
        return self::$is_auth;
    }
}