<?php  
defined('APP') or die('Acceso negato');

require_once 'models/MainModel.php';

class MainController{
    public $model;
    public $page;

    public function __construct(){
        $this->model = new mainModel();
        $this->page = 'main';

    }

    //funzione pulsanti pagina
    public function index(){
        include 'views/main/main_template.php';
    }

    public function listings(){
        include 'views/listings/listings_template.php';
    }

    public function login(){
        $view = 'views/login/login_form.php';
        include 'views/login/login_template.php';
    }

    public function registration(){
        $view = 'views/login/login_registration_form.php';
        include 'views/login/login_template.php';
    }

}

?>