<?php
defined('APP') or die ("Accesso negato");
require_once "config/dbconnect.php";

class MainModel{
    private $pdo;
    public function __construct(){
        $this->pdo=DB::connect();
    }

    public function selectAll(array $param=[]) :array{
        $dql="SELECT * FROM insertions";
    //----------------------------------------------
        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);
    //----------------------------------------------
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select3Last(array $param=[]) :array{
        $dql="SELECT * FROM insertions ORDER BY copy_id LIMIT 3";

        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}