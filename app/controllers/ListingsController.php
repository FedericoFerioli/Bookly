<?php  
defined('APP') or die('Acceso negato');

require_once('models/listingsModel.php');

class listingsController{
    private $model;
    private $page;

    public function __construct(){
        $this->model = new listingsModel();
        $this->page = 'listings';

    }

    //funzione pulsanti pagina
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


    // public function filter(){
        
    // }

}
?>