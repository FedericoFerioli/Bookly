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
}

