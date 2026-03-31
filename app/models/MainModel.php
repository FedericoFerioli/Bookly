<?php  
defined('APP') or die('Acceso negato');
?>
<?php 
require_once __DIR__ . '/../../config/dbconnect.php';
class mainModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    public function insertRecord(array $param) : bool{
        //istruzione
        $dml = "INSERT INTO st_main(`name`, `description`)
        VALUES (?,?)";
        //--------------------------------------------------------
        //$param = [ $name, $description]; #variabili per form
        $stm = $this->pdo->prepare($dml);
        $stm->execute($param);
        //--------------------------------------------------------
        return $stm->rowCount() !== 0;

    }

    public function deleteRecord(array $param) : bool{
        //istruzione
        $dml = "DELETE FROM st_main WHERE `name` = ?";
        //$param = [$name];
        //---------------------------------------------------------
        $stm = $this->pdo->prepare($dml);
        $stm->execute($param);
        //---------------------------------
        return $stm->rowCount() !== 0;
    }

    public function SelectAll(array $param = []) : array{
        //istruzione
        $dql = "SELECT * FROM st_main";
        //$param = []; 
        //-----------------------------------------
        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);
        //-----------------------------------------
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function SelectNames(array $param = []) : array{
        $dql = "SELECT name FROM st_main";
        
        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


}

