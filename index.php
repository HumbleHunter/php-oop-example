<?php
error_reporting(E_ALL);

$url = isset($_GET['url']) ? $_GET['url'] : null;

if (!is_null($url)) {
    $url = explode('/', $url);
    $class = $url[0];
    $method = $url[1];
} else {
    $class = 'Home';
    $method = 'index';
}

$par1 = isset($url[2]) ? $url[2] : false;
$par1 ? $par2 = isset($url[3]) ? $url[3] : false : false;


require_once 'header.php';
require_once "controller/$class/$class.php";
$controller = new $class;

if ($par1 && !$par2) {
    $controller->{$method}($par1);
} elseif ($par1 && $par2) {
    $controller->{$method}($par1, $par2);
} else {
    $controller->{$method}();
}

require_once 'footer.php';
