<?php

use core\Request;

function my_autoloader($classname) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
}

spl_autoload_register('my_autoloader');

session_start();
define('ROOT', '/lavric/modul2/less3/');

$params = explode('/', $_GET['chpu']);
$end = count($params) - 1;
if($params[$end] === '') {
    unset($params[$end]);
    $end--;
}
$controller = isset($params[0]) && $params[0] && is_string($params[0]) ? $params[0] : 'Article';
$id = false;

if(isset($params[1]) && $params[1] && is_numeric($params[1])) {
    $id = $params[1];
    $params[1] = 'show';
}

$action = isset($params[1]) && $params[1] !== '' && is_string($params[1]) ? $params[1] : 'index';
$action = sprintf('%sAction', $action);

if(!$id) {
    $id = isset($params[2]) && $params[2] && is_numeric($params[2]) ? $params[2] : false;
}

if($id) {
    $_GET['id'] = $id;
}

$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES, $_SESSION);

$controller = 'Controllers\\' . (ucfirst($controller)) . 'Controller';
$controller = new $controller($request);
$controller->$action();
echo $controller->render();