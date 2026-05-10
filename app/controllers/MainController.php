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

    public function index(){
        $threeListings = $this->model->select3last();
        for($i = 0; $i < 3; $i++){
            $threeListings[$i]['images'] = $this->model->getImagesById($threeListings[$i]['insertion_id']);
        }

        include 'views/main/main_template.php';
    }

}

