<?php  
defined('APP') or die('Acceso negato');
?>
<?php 
require_once __DIR__ . '/../../config/dbconnect.php';
class ViewlistingModel{
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

    public function getOne($id) {
        $dql = "SELECT insertions.*, books.title, books.authors, books.publisher, users.name, users.surname, subjects.name as subject_name
            FROM insertions 
            JOIN books USING(book_id) 
            JOIN users ON insertions.selling_user = users.user_id
            JOIN subjects USING(subject_id)
            WHERE insertions.insertion_id = ?
            LIMIT 1"; // Filtro per ID
    $param=[$id];
    $stm = $this->pdo->prepare($dql);
    $stm->execute($param);
    
    return $stm->fetch(PDO::FETCH_ASSOC);
    }
}

