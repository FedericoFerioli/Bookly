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


    //funzione che estragga tutti gli annunci
    public function SelectAll(array $param=[]): array{
        $dql ="SELECT * FROM insertions
        join books USING(book_id)
        join courses USING(course_id)"; //riporta il contenuto della tabella insertions
        $stm=$this->pdo->prepare($dql); //prepara la query ricevuta da $dql
        $stm->execute($param); //esegue la query usando $param come contenitore per il risultato
        return $stm->fetchAll(PDO::FETCH_ASSOC); //il risultato viene trasformato in array associativo
    }
    
}
