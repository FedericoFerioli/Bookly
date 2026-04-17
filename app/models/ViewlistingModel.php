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

    public function getOne($id) {
        $dql = "SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name
            FROM insertions 
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.selling_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            WHERE insertions.insertion_id = ?
            LIMIT 1";

    $param=[$id];
    $stm = $this->pdo->prepare($dql);
    $stm->execute($param);
    
    return $stm->fetch(PDO::FETCH_ASSOC);
    }
}

