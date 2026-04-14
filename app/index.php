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

/**
 * Controlliamo il login, se è stato eseguito o meno
 */
if(isset($_SESSION['user_id']) == false){
    /**
     * @var string pagine di cui utilizzare controller e model, se non c'è ne nessuna indicata si utilizza login
     */
    $page =  $_GET['page'] ?? 'login';
    /**
     * @var string se l'azione non è specificata si utilizza action
     */
    $action = $_GET['action'] ?? 'login';
    /**
     * utilizzaimo il controller, e chiamiamo l'azione
     */
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
    /**
     * Se l'azione non esiste mandiamo l'utente alla pagine princiapale
     */
    if (!method_exists($controller, $action)) {
        $action = 'index';
    }
    $controller->$action();
}