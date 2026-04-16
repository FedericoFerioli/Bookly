<?php  
defined('APP') or die('Acceso negato');

require_once __DIR__ . '/../../config/dbconnect.php';
class PersonalareaModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    public function isbnResearch(array $param){
        $dql = "SELECT books.book_id, books.title, books.authors, subjects.name, books.publisher, books.volume
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
    }

    //qua serve una funzione che estragga tutte le inserzioni di un utente

    //funzione per modificare un'inserzione

    //funzione per eliminare un'inserzione
