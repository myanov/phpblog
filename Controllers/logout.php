<?php
if(isset($_SESSION['is_auth'])) {
    unset($_SESSION['is_auth']);
}
if(isset($_COOKIE['login'])) {
    setcookie('login', '', 0);
}
if(isset($_COOKIE['password'])) {
    setcookie('password', '', 0);
}
header("location: " . ROOT);
die;