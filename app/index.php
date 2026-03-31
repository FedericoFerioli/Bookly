<?php
define('APP',true);

if(isset($_SESSION['customer_id']) == false){

    $page =  $_GET['page'] ?? 'Login';
    $action = $_GET['action'] ?? 'login';
    $filename = ucfirst($page).'Controller';
    require_once "controllers/{$filename}.php";
    $controller = new $filename();
    $controller->$action();

}else{
    
    $page = $_GET['page'] ?? 'main';
    $action = $_GET['action'] ?? 'index';
    $filename = ucfirst($page).'Controller';
    echo $filename;

    require_once "/controllers/{$filename}.php";
    $controller = new $filename();

    if (!method_exists($controller, $action)) {
        $action = 'index';
    }
    $controller->$action();
}
