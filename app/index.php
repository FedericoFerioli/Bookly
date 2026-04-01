<?php
define ('APP', true);
$page = $_GET['page'] ?? 'main';
$action = $_GET['action'] ?? 'index';
$filename = ucfirst($page). 'Controller';
require_once "controller/{$filename}.php";
$controller = new $filename();

if(method_exists($controller, $action))
    $controller->$action();
?>

