<?php
/**
 * comando per bufferare l'output
 */
ob_start();
/**
 * inizio sessione
 */
session_start();
/**
 * Rendiamo d'ora in poi accessibili le altre pagine
 */
define('APP',true);

$page = $_GET['page'] ?? 'main';
$action = $_GET['action'] ?? 'index';


if ($page === 'personalArea' || $page === 'personalarea') {
    $filename = 'PersonalAreaController';
} else {
    $filename = ucfirst($page) . 'Controller';
}

/** */
if (!file_exists("controllers/{$filename}.php")) {
    require_once "controllers/ErrorController.php";
    $controller = new ErrorController();
    $controller->notFound();
    exit;
}


require_once "controllers/{$filename}.php";
$controller = new $filename();

/**
 * Se l'azione non esiste mandiamo l'utente alla pagina 404
 */
if (!method_exists($controller, $action)) {
    require_once "controllers/ErrorController.php";
    $error = new ErrorController();
    $error->notFound();
    exit;
}

/**
 * Esegue il metodo dell'action nel controller istanziato
 */
$controller->$action();

//echo '<pre>' . print_r($_SESSION, true) . '</pre>';

