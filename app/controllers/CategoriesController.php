<?php  
defined('APP') or die('Acceso negato');
?>

<?php
require_once 'models/CategoriesModel.php';


class CategoriesController{
    public $model;
    public $page;

    public function __construct(){
        $this->model = new CategoriesModel();
        $this->page = 'Categories';

    }

    //funzione pulsanti pagina
    public function index(){
        $table = $this->model->SelectAll();
        include 'views/template.php';
    }
    
    public function create(){
        $table = $this->model->selectAll();

        $view = 'views/categories_form_create.php';
        include 'views/template.php';
    }

    public function delete(){
        $table = $this->model->SelectAll();
        $names = $this->model->SelectNames();
        $view = 'views/categories_form_delete.php';
        include 'views/template.php';
    }

    public function update(){
        $table = $this->model->SelectAll();
        $view = 'views/categories_form_update.php';
        include 'views/template.php';
    }

    


    //funzioni sul database
    public function store(){
        // dati dal form 
        $name = $_POST['name'];
        $description = $_POST['description'];

        //richiesta al model 
        $param = [$name, $description];
        $this->model->insertRecord($param);

        //ricaricamneto della pagina
        header('location: index.php');
        exit;
    }
    
    public function destroy(){
        // dati dal form 
        $name = $_POST['name'];

        //richiesta al model 
        $param = [$name];
        $this->model->deleteRecord($param);

        //ricaricamneto della pagina
        header('location: index.php');
        exit;
    }
}
?>