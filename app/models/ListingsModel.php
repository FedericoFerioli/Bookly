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

    public function filterAll(array $filters): array {
        // 1. Base della query (usiamo WHERE 1=1 per poter aggiungere AND a catena)
        $sql = "SELECT * FROM insertions
                JOIN books USING(book_id)
                JOIN subjects USING(subject_id)
                JOIN books_classes_courses USING(book_id)
                JOIN classes_courses USING(class_course_id)
                JOIN classes USING(class_id)
                JOIN courses USING(course_id)
                WHERE 1=1";
        
        $params = [];

        // 2. Filtro CLASSI (se sono checkbox, $filters['classes'] sarà un array)
        if (!empty($filters['classes'])) {
            $placeholders = implode(',', array_fill(0, count($filters['classes']), '?'));
            $sql .= " AND classes.year IN ($placeholders)";
            foreach ($filters['classes'] as $class) {
                $params[] = $class;
            }
        }

        // 3. Filtro CORSO (Select singola)
        if (!empty($filters['course_id'])) {
            $sql .= " AND courses.course_id = ?";
            $params[] = $filters['course_id'];
        }

        // 4. Filtro PREZZO (Range sempre presente grazie allo slider)
        $sql .= " AND insertions.price BETWEEN ? AND ?";
        $params[] = $filters['price_min'] ?? 0;
        $params[] = $filters['price_max'] ?? 999;

        if (!empty($filters['subject_id'])) {
            $sql .= " AND subjects.subject_id = ?";
            $params[] = $filters['subject_id'];
        }

        // 5. Filtro CONDIZIONI (Checkbox)
        if (!empty($filters['conditions'])) {
            $placeholders = implode(',', array_fill(0, count($filters['conditions']), '?'));
            $sql .= " AND insertions.condition IN ($placeholders)";
            foreach ($filters['conditions'] as $cond) {
                $params[] = $cond;
            }
        }

        // 6. Filtro EDITORE (Select singola)
        if (!empty($filters['publisher_id'])) {
            $sql .= " AND books.publisher_id = ?";
            $params[] = $filters['publisher_id'];
        }

        // 7. Esecuzione
        $stm = $this->pdo->prepare($sql);
        $stm->execute($params);
        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
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

    public function getSubjects(){
        $dql = "SELECT subject_id, name FROM subjects";

        $stm = $this->pdo->prepare($dql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}

