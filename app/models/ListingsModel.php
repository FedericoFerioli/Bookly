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


    /**
     * SelectAll estrae tutti gli annunci
     *
     * @param array $param 
     * @return array array associativo con i dati delle inserzioni
     */
    public function SelectAll(array $param=[]): array{
        $dql = "SELECT insertions.*, books.*, subjects.*
        FROM insertions
        JOIN books USING(book_id)
        JOIN subjects USING(subject_id)
        WHERE insertion_state = 'selling'
        GROUP BY insertions.insertion_id
        ORDER BY post_date DESC"; //riporta il contenuto della tabella insertions
        $stm=$this->pdo->prepare($dql); //prepara la query ricevuta da $dql
        $stm->execute($param); //esegue la query usando $param come contenitore per il risultato
        return $stm->fetchAll(PDO::FETCH_ASSOC); //il risultato viene restituito come in array associativo
    }
    
    /**
     * getImagesById prende le immagini di una inserzione, utilizzando l'id
     *
     * @param int $id id dell'inserzione
     * @return array
     */
    public function getImagesById($id): array{
        $sql = "SELECT image_path FROM insertion_images
            WHERE insertion_id = ?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetchAll(PDO::FETCH_COLUMN); //array
    }


    /**
     * filterAll per il filtraggio 
     *
     * @param array $filters array che contine i dati del form
     * @return array array associativo con le inserzioni pertinenti al filtraggio
     */
    public function filterAll(array $filters): array {
        $sql = "SELECT insertions.*, books.*, subjects.*
            FROM insertions
            JOIN books USING(book_id)
            JOIN subjects USING(subject_id)
            WHERE insertion_state = 'selling'"; //solo quelle selling

        $params = [];

        //anno es. prima seconda ecc.
        if (!empty($filters['classes'])) {
            //subquery
            $sql .= " AND insertions.insertion_id IN (
                        SELECT insertion_id FROM insertions
                        JOIN books USING(book_id)
                        JOIN books_classes_courses USING(book_id)
                        JOIN classes_courses USING(class_course_id)
                        JOIN classes USING(class_id)
                        WHERE classes.year IN (" . implode(',', array_fill(0, count($filters['classes']), '?')) . ") 
                    )";
                    //la parte dopo IN conta i campi dentro l'array $filters['classes'] e crea la stringa "?,?,?"
            foreach ($filters['classes'] as $class) {
                $params[] = $class;
            }
        }
        
        //indirizzo
        if (!empty($filters['course_id'])) {
            $sql .= " AND insertions.insertion_id IN (
                        SELECT insertion_id FROM insertions
                        JOIN books USING(book_id)
                        JOIN books_classes_courses USING(book_id)
                        JOIN classes_courses USING(class_course_id)
                        JOIN courses USING(course_id)
                        WHERE courses.course_id = ?
                    )";
            $params[] = $filters['course_id'];
        }

        //prezzo
        $sql .= " AND insertions.price BETWEEN ? AND ?";
        $params[] = $filters['price_min'] ?? 0;
        $params[] = $filters['price_max'] ?? 999;

        //materia
        if (!empty($filters['subject_id'])) {
            $sql .= " AND subjects.subject_id = ?";
            $params[] = $filters['subject_id'];
        }

        //condizione del libro
        if (!empty($filters['conditions'])) {
            $placeholders = implode(',', array_fill(0, count($filters['conditions']), '?'));
            $sql .= " AND insertions.book_condition IN ($placeholders)";
            foreach ($filters['conditions'] as $cond) {
                $params[] = $cond;
            }
        }

        //casa editrice
        if (!empty($filters['publisher'])) {
            $sql .= " AND books.publisher = ?";
            $params[] = $filters['publisher'];
        }

        $sql .= " GROUP BY insertions.insertion_id";

        $stm = $this->pdo->prepare($sql);
        $stm->execute($params);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * getMaxPrice restituisce prezzo massimo
     *
     * @return int $res['max_p'] prezzo massimo 
     */
    public function getMaxPrice() {
        $sql = "SELECT MAX(price) as max_p FROM insertions
            WHERE insertions.insertion_state = 'selling'";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchColumn() ?? 100;
    } 

    /**
     * getMinPrice restituisce prezzo minimo
     *
     * @return int $res['min_p'] prezzo massimo
     */
    public function getMinPrice() {
        $sql = "SELECT MIN(price) as min_p FROM insertions
            WHERE insertions.insertion_state = 'selling'";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        $res = $stm->fetch(PDO::FETCH_ASSOC);
        return $stm->fetchColumn() ?? 0;
    }

    /**
     * getOne restituisce i dati di una inserzione
     *
     * @param int $id id inserzione
     * @return void
     */
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


    /**
     * selectCourses
     *
     * @param array $param
     * @return array associativo che contiene id del corso e nome del corso
     */
    public function selectCourses(array $param = []){
        $dql = "SELECT course_id, name FROM courses";

        $stm = $this->pdo->prepare($dql);
        $stm->execute($param);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * getPublishers restituisce le case editrici
     *
     * @return array che contine id e nomi della case editrici
     */
    public function getPublishers(){
        $dql = "SELECT DISTINCT publisher FROM books ORDER BY publisher ASC";

        $stm = $this->pdo->prepare($dql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Materie
     *
     * @return array che contiene id e nomi della materie
     */
    public function getSubjects(){
        $dql = "SELECT subject_id, name FROM subjects";

        $stm = $this->pdo->prepare($dql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


}

