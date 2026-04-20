<?php
defined('APP') or die('Acceso negato');

require_once 'models/PersonalareaModel.php';

class PersonalareaController{
    public $model;
    public $page;

    public function __construct(){
        $this->model = new PersonalareaModel();
        $this->page = 'Personalarea';
    }

    public function isLogged(){
        if($_SESSION['logged'] != true){
            header('location:index.php?page=login&action=login');
            exit;
        }
    }

    public function index(){
        include 'views/main/main_template.php';
    }

    public function listings(){
        $views = 'views/listings/listings_all.php';
        include 'views/listings/listings_template.php';
    }

    public function dashboard(){
        $this->isLogged();
        $user_id = $_SESSION['user_id'];
        $param = [$user_id];
        $userData = $this->model->getUserInfo($param);
        $view = 'views/Personalarea/Perosonalarea_dashboard.php';
        include 'views/Personalarea/personalArea_template.php';
    }

    public function new_insertion(){   
        $this->isLogged();
        $courses = $this->model->selectCourses();
        $view = 'views/Personalarea/Personalarea_new_insertion_form_2.php';
        include 'views/Personalarea/personalArea_template.php';

    }

    public function modify_insertion(){
        $this->isLogged();
        $courses = $this->model->selectCourses();
        $view = 'views/Personalarea/Personalarea_new_insertion_form_2.php';
        include 'views/Personalarea/personalArea_template.php';

    }

    public function save_insertion(){

        $book_id = $_SESSION['libro_precaricato']['book_id'] ?? null;

        if (!$book_id) {
            die("Errore: Sessione scaduta o libro non trovato. Riprova la ricerca ISBN.");
        }

        $price = trim($_POST['my_price'] ?? '');
        $book_condition = trim($_POST['condition'] ?? '');
        $insertion_state = "selling";
        $description = trim($_POST['description'] ?? '');
        $insertion_state = "selling";
        $selling_user = trim($_SESSION['user_id'] ?? '');
        $course = trim($_POST['course_id'] ?? '');

        $param = [$price, $book_condition, $description, $insertion_state, $selling_user, $book_id, $course];
        $insertion = $this->model->newInsertion($param);

        if($insertion){
            unset($_SESSION['libro_precaricato']);            
            $_SESSION['msg_errore_inserzione'] = "Inserimento completato";        
            header('Location: index.php?page=Personalarea&action=new_insertion');
            exit;
        }else{
            $_SESSION['msg_errore_inserzione'] = "Non siamo riusciti a craere l'inserzione";        
            header('Location: index.php?page=Personalarea&action=new_insertion');
        }

    }

    public function search_isbn(){
        // dati dal form 

        $isbn = trim($_POST['isbn'] ?? '');
 
        //richiesta al model 
        $param = [$isbn];
        $libro_trovato = $this->model->isbnResearch($param);

        // 2. Verifichi se il libro è stato trovato
        if ($libro_trovato) {
            // Il libro viene salvato in una sessione se viene trovato
            $_SESSION['libro_precaricato'] = $libro_trovato;
        } else {
            $_SESSION['msg_errore'] = "Nessun libro trovato per questo ISBN.";        
        }

    header('Location: index.php?page=Personalarea&action=new_insertion');
    }


    //view con annunci propri e info personali

    //view per accedere alla pagina per la modifica delle info personali

    //funzione per accedere all view della modifica annuncio
}

?>