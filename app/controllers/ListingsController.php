<?php  
defined('APP') or die('Acceso negato');

require_once('models/ListingsModel.php');

class listingsController{
    private $model;
    private $page;

    public function __construct(){
        $this->model = new listingsModel();
        $this->page = 'listings';

    }

        
    /**
     * all
     * Funzione che ci permette di visualizzare le inserzioni
     * Include il template e la view
     * @return void
     */
    public function all(){
        /**
         * $insertion prende le inserzioni dalla sessione, se sono stati applicati dei filtri attraverso il form
         * oppure dal model con la funzione select all che prende tutti le inserzioni
         */
        $insertions = $_SESSION['filtered_insertions'] ?? $this->model->SelectAll();
        $courses = $this->model->selectCourses();
        $publishers = $this->model->getPublishers();
        $subjects = $this->model->getSubjects();
        $maxPrice = $this->model->getMaxPrice();
        $minPrice = $this->model->getMinPrice();

        $view = 'views/listings/listings_all.php';
        include 'views/listings/listings_template.php';
    }
        
    /**
     * filter_insertion
     * Questa funzione permette di filtrare gli annunci a seguito delle informazioni inserite nel form
     * le inserzioni vengono salvate in una sessione, e il redirect avviene alla stessa pagina
     * 
     * @return void
     */
    public function filter_insertion(){
        /**
         * Utilizziamo un array associativo così da poter accedere ai valori attraverso le chiavi e non la posizione dell'array
         */
        $filters = [
            'classes'      => $_POST['classes'] ?? [], 
            'course_id'    => $_POST['courses'] ?? null,
            'price_min'    => trim($_POST['price_min'] ?? ($this->model->getMinPrice() ?? 0)),
            'price_max'    => trim($_POST['price_max'] ?? ($this->model->getMaxPrice() ?? 100)),
            'subject_id'   => $_POST['subject_id'] ?? null,
            'conditions'   => $_POST['condition'] ?? [],
            'publisher_' => $_POST['publisher'] ?? null,
        ];

        $_SESSION['filtered_insertions'] = $this->model->filterAll($filters);

        header('Location: http://lab.isit100.fe.it:8092/ferioli/app/index.php?page=listings&action=all');
        exit;
    }
    
}

