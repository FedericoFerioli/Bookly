<?php
if(!defined('APP')) die('Accesso negato');

require_once __DIR__ . '/../../config/dbconnect.php';
class loginModel
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = DB::connect();
  }

  /**
   * find
   * Metodo per il form del login
   */
  public function find(array $param){ //$param = [$email, $password];
    $dql = "SELECT user_id
            FROM users
            WHERE email = ? and password = ?
            LIMIT 1";
    $stm = $this->pdo->prepare($dql);
    $stm->execute($param);

    return $stm->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * insertRecord
   * Per registrazione
   */
  public function insertRecord(array $param): bool { //$param = [$name, $surname, $gender, $email, $dob ,$password];
    $dml = "INSERT INTO users (`name`, `surname` ,`gender`, `email`, `dob`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stm = $this->pdo->prepare($dml);
    $stm->execute($param);

    return $stm->rowCount() !== 0;
  }

  public function getPassword(string $email){
      $dql = "SELECT user_id, password
              FROM users
              WHERE email = ?
              LIMIT 1";
      $stm = $this->pdo->prepare($dql); 
      $stm->execute([$email]);

      return $stm->fetch(PDO::FETCH_ASSOC);
  }
}