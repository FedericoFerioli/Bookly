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

    //funzione pulsanti pagina
    public function all(){
        $insertions = $this->model->SelectAll();
        $courses = $this->model->selectCourses();
        $publishers = $this->model->getPublishers();
        $subjects = $this->model->getSubjects();
        $maxPrice = $this->model->getMaxPrice();
        $minPrice = $this->model->getMinPrice();

        $view = 'views/listings/listings_all.php';
        include 'views/listings/listings_template.php';
    }


    public function index(){
        include 'views/main/main_template.php';
    }

    public function login(){
        $view = 'views/login/login_form.php';
        include 'views/login/login_template.php';
    }

    public function registration(){
        $view = 'views/login/login_registration_form.php';
        include 'views/login/login_template.php';
    }

    public function filter_insertion(){

        $class = $_POST['classes'] ?? [];
        $course_id = $_POST['courses'] ?? null;
        $minPricePost = trim($_POST['price_min'] ?? ($this->model->getMinPrice() ?? 0));
        $maxPricePost = trim($_POST['price_max'] ?? ($this->model->getMaxPrice() ?? 100));
        $subject_id = $_POST['subject_id'] ?? null;
        $condition = $_POST['condition'] ?? [];
        $publisher = $_POST['publisher'] ?? null;

        $param=[
            $class,
            $course_id,
            $minPricePost,
            $maxPricePost,
            $subject_id,
            $condition,
            $publisher
        ];

        $insertions = $this->model->filterAll($param);

        if($insertions){
            header('Location : http://lab.isit100.fe.it:8092/ferioli/app/index.php?page=listings&action=filter_insertion');
            exit;
        }
        else{
            header('Location : http://lab.isit100.fe.it:8092/ferioli/app/index.php?page=listings&action=filter_insertion');
            exit;

        }
    }
}
?>