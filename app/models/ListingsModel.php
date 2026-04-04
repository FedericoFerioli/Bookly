<?php  
defined('APP') or die('Acceso negato');
?>
<?php 
require_once __DIR__ . '/../../config/dbconnect.php';
class listingsModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }


    //funzione che stragga tutti gli annunci
    
    //funzioni che filtrano bisogna pensare bene come fare, io per adesso non ho idee


}

