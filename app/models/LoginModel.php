<?php
if(!defined('APP')) die('Accesso negato');

require_once __DIR__ . '/../../config/dbconnect.php';
class loginModel
{
  private $pdo;

  // Metodo costruttore
  public function __construct()
  {
    $this->pdo = DB::connect();
  }

    public function find(array $param): bool {
    $dql = "SELECT 1 
            FROM users
            WHERE email = ? and password = ?
            LIMIT 1";
    //-----------------------------------
    $stm = $this->pdo->prepare($dql);
    $stm->execute($param);
    //-----------------------------------
    return $stm->fetchColumn() !== false;
  }

  // Metodo DML per inserire un record
  public function insertRecord(array $param): bool {
    $dml = "INSERT INTO users (`name`, `surname` ,`gender`, `email`, `dob`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
    //-----------------------------------
    $stm = $this->pdo->prepare($dml);
    $stm->execute($param);
    //-----------------------------------
    return $stm->rowCount() !== 0;
  }
}
