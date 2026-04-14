<?php  
defined('APP') or die('Acceso negato');


require_once __DIR__ . '/../../config/dbconnect.php';
class mainModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    //Funzione che estragga le ultime 3 inserzioni inserite dagli utenti
    public function select3Last(array $param=[]) : array{
        $dql="SELECT * FROM insertions ORDER BY copy_id DESC LIMIT 3";

        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}