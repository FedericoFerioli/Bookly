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

    public function SelectInsertionOfUser($id): array{
        $dql ="SELECT insertion_id FROM insertions
        WHERE insertions.selling_user = ?"; 
        $stm=$this->pdo->prepare($dql); 
        $stm->execute([$id]);
        return $stm->fetchAll(PDO::FETCH_COLUMN);
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

    public function getImagesById($id): array{
        $sql = "SELECT image_path FROM insertion_images
            WHERE insertion_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getPlaces(){
        $dql = "SELECT * FROM places";

        $stm = $this->pdo->prepare($dql);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertionsByUser(array $param){
        $dql="SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name
            FROM insertions 
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.selling_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            WHERE selling_user= ? and insertions.insertion_state = 'selling'";
        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setExchange(array $param): bool{ //$param = [$exchange_day, $buyingUser, $place_id, $id]; 
        $sql = "UPDATE insertions SET exchange_day = ?, buying_user = ?, place_id = ?, insertion_state = 'reserved'
        WHERE insertion_id = ?";
        $stm=$this->pdo->prepare($sql);
        $stm->execute($param);
        return $stm->rowCount() !== 0;
    } 

}

