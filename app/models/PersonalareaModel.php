<?php  
defined('APP') or die('Acceso negato');

require_once __DIR__ . '/../../config/dbconnect.php';
class PersonalareaModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    public function isbnResearch(array $param){
        $dql = "SELECT books.book_id, books.title, books.authors, subjects.name, books.publisher, books.volume, books.cover_price
                FROM books
                JOIN subjects USING(subject_id)
                WHERE books.isbn LIKE ?
                LIMIT 1";
        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function newInsertion(array $param){
        $dql = "INSERT INTO insertions (
                        price, 
                        book_condition,
                        `description`,
                        insertion_state, 
                        post_date, 
                        selling_user, 
                        book_id, 
                        course_id
                    ) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";

            $stm = $this->pdo->prepare($dql);
            return $stm->execute($param);
    }

    public function selectCourses(array $param = []){
        $dql = "SELECT course_id, name FROM courses";

        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    



    //qua serve una funzione che estragga tutte le inserzioni di un utente
    public function insertionsByUser(array $param){
        $dql="SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name
            FROM insertions 
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.selling_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            WHERE selling_user= ?";
        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    //funzione per modificare un'inserzione
        public function modifyInsertion(array $param){ //$param=[price, book_condition, description, insertion_id]
        $dql="UPDATE insertions
                SET price=?,
                    exchange_day=exchange_day,
                    book_condition=?,
                    `description`=?,
                    sell_time=sell_time,
                    insertion_state=insertion_state,
                    post_date=post_date,
                    selling_user=selling_user,
                    buying_user=buying_user,
                    place_id=place_id,
                    book_id=book_id,
                    course_id=course_id
                WHERE insertion_id=?"; //Query che modifica i valori tenendo i valori settati dove non si può modificare
        $stm=$this->pdo->prepare($dql);
        return $stm->execute($param); //esecuzione della Query
    }

    //funzione per eliminare un'inserzione
        public function deleteInsertion(array $param){ //$param=[insertion_id]
        $dql="DELETE FROM insertions
              WHERE insertion_id=?";
        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->rowCount()!==0;
    }
}
