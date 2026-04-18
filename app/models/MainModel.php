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
        $dql="SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name
            FROM insertions 
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.selling_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            ORDER BY insertion_id DESC
            LIMIT 3"; //query che prende le ultime 3 inserzioni aggiunte

        $stm=$this->pdo->prepare($dql); //prepara la query ricevuta da $dql
        $stm->execute($param); //esegue la query e usa $param come contenitore per il risultato

        return $stm->fetchAll(PDO::FETCH_ASSOC); //il risultato viene trasformato in array associativo
    }

}