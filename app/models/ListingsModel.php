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

    public function filterAll(array $param ): array{
        $sql = "SELECT * FROM insertions
            JOIN books USING(book_id)
            JOIN courses USING(course_id)
            WHERE books.class = ? 
              AND insertions.course_id = ? 
              AND insertions.mprice >= ? 
              AND insertions.price <= ? 
              AND insertions.condition = ? 
              AND books.publisher = ?"; //riporta il contenuto della tabella insertions
        $stm=$this->pdo->prepare($dql); //prepara la query ricevuta da $dql
        $stm->execute($param); //esegue la query usando $param come contenitore per il risultato
        return $stm->fetchAll(PDO::FETCH_ASSOC); //il risultato viene trasformato in array associativo
    }

    public function getMaxPrice() {
        $sql = "SELECT MAX(price) as max_p FROM insertions";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        $res = $stm->fetch(PDO::FETCH_ASSOC);
        return $res['max_p'] ?? 0;
    }

    public function getMinPrice() {
        $sql = "SELECT MIN(price) as min_p FROM insertions";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        $res = $stm->fetch(PDO::FETCH_ASSOC);
        return $res['min_p'] ?? 0;
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

    public function selectCourses(array $param = []){
        $dql = "SELECT course_id, name FROM courses";

        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublishers(){
        $dql = "SELECT DISTINCT publisher FROM books ORDER BY publisher ASC";

        $stm = $this->pdo->prepare($dql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}

