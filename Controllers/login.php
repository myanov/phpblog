<?php
$login = 'admin';
$password = password_hash('admin', PASSWORD_DEFAULT);

if(isset($_SESSION['is_auth'])) {
    unset($_SESSION['is_auth']);
}

if(isset($_COOKIE['login'])) {
    setcookie('login', '', 0);
} elseif(isset($_COOKIE['password'])) {
    setcookie('password', '', 0);
}

$name = $_POST['name'] ?? '';

if(count($_POST) > 0) {
    if(!empty(trim($_POST['name'])) && !empty(trim($_POST['password']))) {
        if($_POST['name'] == $login) {
            if(password_verify($_POST['password'], $password)) {
                session_start();
                $_SESSION['is_auth'] = true;
                if(isset($_POST['check'])) {
                    setcookie('login', $_POST['name'], time() + 3600 * 24 * 7);
                    setcookie('password', password_hash($_POST['password'], PASSWORD_DEFAULT), time() + 3600 * 24 * 7);
                }
                header("Location: " . ROOT);
                exit;
            } else {
                $msg = 'Неверный пароль';
            }
        } else {
            $msg = 'Неверное имя пользователя';
        }
    } else {
        $msg = 'Все поля обязательны для заполнения';
    }
} else {
    $msg = '';
}

$inner = template_include('v_login', ['msg' => $msg, 'name' => $name]);
$title = 'Login';
