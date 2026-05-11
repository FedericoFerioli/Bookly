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
                $dql = "SELECT insertions.*, books.title, books.authors, books.publisher, users.name, users.surname, subjects.name as subject_name
            FROM insertions 
            JOIN books USING(book_id) 
            JOIN users ON insertions.selling_user = users.user_id
            JOIN subjects USING(subject_id)
            WHERE insertion_state = 'selling'
            ORDER BY insertion_id DESC LIMIT 3"; //query che prende le ultime 3 inserzioni aggiunte

        $stm=$this->pdo->prepare($dql); //prepara la query ricevuta da $dql
        $stm->execute($param); //esegue la query e usa $param come contenitore per il risultato

        return $stm->fetchAll(PDO::FETCH_ASSOC); //il risultato viene trasformato in array associativo
    }

    public function getImagesById($id): array{
        $sql = "SELECT image_path FROM insertion_images
            WHERE insertion_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetchAll(PDO::FETCH_COLUMN);
    }

}