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
        include 'views/template.php';
    }

}

?>