<?php  
defined('APP') or die('Acceso negato');
?>
<?php 
require_once __DIR__ . '/../../config/dbconnect.php';
class personalAreaModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    //qua serve una funzione che estragga tutte le inserzioni di un utente

    //funzione per aggiungere un'inserzione

    //funzione per modificare un'inserzione

    //funzione per eliminare un'inserzione
}

