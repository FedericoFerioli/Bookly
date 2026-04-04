<?php  
defined('APP') or die('Acceso negato');
?>
<?php 
require_once __DIR__ . '/../../config/dbconnect.php';
class createModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    //Qua è necessaria una funzione che estragga le prime 3 inserzioni


}

