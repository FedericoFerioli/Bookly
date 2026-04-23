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

        $class = trim($_POST['classes'] ?? '');
        $course = trim($_POST['courses'] ?? '');
        $minPricePost = trim($_POST['price_min'] ?? '');
        $maxPricePost = trim($_POST['price_max'] ?? '');
        $condition = trim($_POST['condition'] ?? []);
        $publisher = trim($_POST['publisher'] ?? '');

        $param=[
            $class,
            $course,
            $minPricePost,
            $maxPricePost,
            $condition,
            $publisher
        ];

        $insertions = $this->model->filterAll($param);

        if($insertions){
            header('Location : ');
        }



        //da fare finisci quesrta funzione nel model e prezzo min e prezzo max
    }
}
?>