<?php  
defined('APP') or die('Acceso negato');

require_once('models/ViewlistingModel.php');

class ViewlistingController{
    private $model;
    private $page;

    public function __construct(){
        $this->model = new ViewlistingModel();
        $this->page = 'Viewlisting';

    }


    public function details(){
        $id = $_GET['id'] ?? 0;
        $insertion = $this->model->getOne($id);


        $view = 'views/viewlisting/Viewlisting_details.php';
        include 'views/viewlisting/Viewlisting_template.php';
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
}
?>