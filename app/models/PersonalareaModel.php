<?php  
defined('APP') or die('Acceso negato');

require_once __DIR__ . '/../../config/dbconnect.php';
class PersonalareaModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    public function isbnResearch(array $param){
        $dql = "SELECT books.book_id, books.title, books.authors, subjects.name, books.publisher, books.volume, books.cover_price, books.isbn
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
                        book_id
                    ) VALUES (?, ?, ?, ?, NOW(), ?, ?)";

            $stm = $this->pdo->prepare($dql);
            return $stm->execute($param);
    }

    /*
    public function selectCourses(array $param = []){
        $dql = "SELECT course_id, name FROM courses";

        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    */
    
    /*
    public function insertionsByUser(array $param){
        $dql="SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name
            FROM insertions 
            JOIN books USING(book_id) 
            JOIN users ON insertions.selling_user = users.user_id
            JOIN subjects USING(subject_id)
            WHERE selling_user= ? AND insertions.insertion_state = 'selling'
            ORDER BY post_date ASC";
        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }*/

    public function SelectInsertionOfUser(array $param=[]): array{
        $dql ="SELECT *, subjects.name as `subject` FROM insertions
        join books USING(book_id)
        join subjects USING(subject_id)
        WHERE insertions.selling_user = ? AND insertions.insertion_state= 'selling'"; //riporta il contenuto della tabella insertions
        $stm=$this->pdo->prepare($dql); //prepara la query ricevuta da $dql
        $stm->execute($param); //esegue la query usando $param come contenitore per il risultato
        return $stm->fetchAll(PDO::FETCH_ASSOC); //il risultato viene trasformato in array associativo
    }    

    public function getImagesById($id): array{
        $sql = "SELECT image_path FROM insertion_images
            WHERE insertion_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetchAll(PDO::FETCH_COLUMN);
    }

    //metodo per modificare un'inserzione
    public function modifyInsertion(array $param){ //$param = [$book_id, $my_price, $condition, $description, $insertion]
        $dql="UPDATE insertions
            SET 
            book_id=?,
            price=?,
            exchange_day=exchange_day,
            book_condition=?,
            `description`=?,
            insertion_state=insertion_state,
            post_date=post_date,
            selling_user=selling_user,
            buying_user=buying_user,
            place_id=place_id
            WHERE insertion_id=?"; //Query che modifica i valori tenendo i valori settati dove non si può modificare
        $stm=$this->pdo->prepare($dql);
        return $stm->execute($param); //esecuzione della Query

        
    }

    //metodo per eliminare un'inserzione
    public function deleteInsertion(array $param){ //$param=[insertion_id]
        $dql="DELETE FROM insertions
              WHERE insertion_id=?";
        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->rowCount()!==0;
    }

    //info dell'utente
    public function getUserInfo(array $param){ //$param=[user_id]
        $dql="SELECT * FROM users
        WHERE user_id = ?";
        $stm=$this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }


    //GetOne prende i dati di una inserzione, serve per la modifca
    public function getOne($id) {
        $dql = "SELECT insertions.*, books.title, books.authors, books.publisher, books.isbn, books.cover_price, users.name, users.surname, subjects.name as subject_name
            FROM insertions 
            JOIN books USING(book_id) 
            JOIN users ON insertions.selling_user = users.user_id
            JOIN subjects USING(subject_id)
            WHERE insertions.insertion_id = ?
            LIMIT 1";
        $param=[$id];
        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);
        
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Inserzioni che l'utente sta comprando
     */
    public function getInsertionToBuy($user_id){
        $dql="SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name, users.email as `email`, places.name as `place`
            FROM insertions 
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.buying_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            LEFT JOIN places USING(place_id)
            WHERE selling_user = ? AND insertions.insertion_state LIKE 'reserved'";
        $stm=$this->pdo->prepare($dql);
        $stm->execute([$user_id]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);        
    }

    /**
     * Inserzioni che l'utente sta vendendo 
     */
    public function getInsertionToSell($user_id){
        $dql="SELECT insertions.*, books.title, books.authors, books.publisher, users.name AS `name`, users.surname AS `surname`, subjects.name AS subject_name, users.email as `email`, places.name as `place`
            FROM insertions 
            LEFT JOIN books USING(book_id) 
            LEFT JOIN users ON insertions.selling_user = users.user_id
            LEFT JOIN subjects USING(subject_id)
            LEFT JOIN places USING(place_id)
            WHERE buying_user= ? AND insertions.insertion_state LIKE 'reserved'";
        $stm=$this->pdo->prepare($dql);
        $stm->execute([$user_id]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);        
    }

    public function set_insertionState($insertion_id){
        $sql = "UPDATE insertions SET insertion_state = 'sold'
            WHERE insertion_id = ? and confirmation = 1";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$insertion_id]);

        return $stm->rowCount() !== 0;
    }

    public function set_confirmation($insertion_id){
        $sql = "UPDATE insertions SET confirmation = 1
            WHERE insertion_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$insertion_id]);
        return $stm->rowCount() !== 0;
    }

    public function getLastInsertionId($user_id){
        return (int)$this->pdo->lastInsertId(); // restituisce l'id dell'insert appena fatto (funzione pdo built-in)
    }

    public function saveInsertionImage(string $path, int $insertion_id): bool {
        $dql = "INSERT INTO insertion_images(image_path, insertion_id) VALUES (?, ?)";
        $stm = $this->pdo->prepare($dql);
        return $stm->execute([$path, $insertion_id]);
    }

    public function updateUserInfo(int $id, string $name, string $surname, string $email, string $dob, string $gender, string $hashedPassword = '') {
        if ($hashedPassword != '') {
            $sql = "UPDATE users
                SET name = ?, surname = ?, email = ?, dob = ?, gender = ?, password = ?
                WHERE user_id = ?";
            $params = [$name, $surname, $email, $dob, $gender, $hashedPassword, $id];
        }else
        {
            $sql = "UPDATE users
                SET name = ?, surname = ?, email = ?, dob = ?, gender = ?
                WHERE user_id = ?";
            $params = [$name, $surname, $email, $dob, $gender, $id];
        }

        $stm = $this->pdo->prepare($sql);
        $stm->execute($params);
        return $stm->rowCount() !== 0;
    }

    public function getCompletedOrders($user_id): array{
        $dql ="SELECT *, subjects.name as `subject` FROM insertions
        join books USING(book_id)
        join subjects USING(subject_id)
        WHERE insertions.selling_user = ? AND insertions.insertion_state = 'sold' AND insertions.confirmation = 1"; //riporta il contenuto della tabella insertions
        $stm=$this->pdo->prepare($dql); //prepara la query ricevuta da $dql
        $stm->execute([$user_id]); //esegue la query usando $param come contenitore per il risultato
        return $stm->fetchAll(PDO::FETCH_ASSOC); //il risultato viene trasformato in array associativo
    }   

}
