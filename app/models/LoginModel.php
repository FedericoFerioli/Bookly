<?php
if(!defined('APP')) die('Accesso negato');

require_once __DIR__ . '/../../config/dbconnect.php';
class LoginModel
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
  
 // Metodo DQL per estrarre una tabella
//   public function selectAll(): array
//   {
//     $dql = "SELECT c.category_id AS id,
//                    c.name AS nome,
//                    c.description AS descrizione
//             FROM st_main c";
//     $param = [];
//     //-----------------------------------
//     $stm = $this->pdo->prepare($dql);
//     $stm->execute($param);
//     //-----------------------------------
//     return $stm->fetchAll(PDO::FETCH_ASSOC);
//   }

//   // Metodo DQL per estrarre una colonna
//   public function selectIds(): array
//   {
//     $dql = "SELECT category_id FROM st_main ORDER BY category_id ASC";
//     $param = [];
//     //-----------------------------------
//     $stm = $this->pdo->prepare($dql);
//     $stm->execute($param);
//     //-----------------------------------
//     return $stm->fetchAll(PDO::FETCH_COLUMN);
//   }
//   // Metodo DML per cancellare un record
//   public function deleteRecord(array $param): bool
//   {
//     $dml = "DELETE FROM st_main WHERE category_id = ?";
//     //-----------------------------------
//     $stm = $this->pdo->prepare($dml);
//     $stm->execute($param);
//     //-----------------------------------
//     return $stm->rowCount() !== 0;
//   }

//   // Metodo DML per modificare un record
//   public function updateRecord(array $param): bool
//   {
//     $dml = "UPDATE st_main 
//               SET `name` = ?, `description` = ?
//               WHERE category_id = ?";
//     //-----------------------------------
//     $stm = $this->pdo->prepare($dml);
//     $stm->execute($param);
//     //-----------------------------------
//     return $stm->rowCount() !== 0;
//   }
}
