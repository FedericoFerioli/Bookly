<?php  
defined('APP') or die('Acceso negato');


require_once __DIR__ . '/../../config/dbconnect.php';
class mainModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    //Qua è necessaria una funzione che estragga le ultime 3 inserzioni inserite dagli utenti

}