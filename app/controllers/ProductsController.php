<?php  
defined('APP') or die('Acceso negato');
?>

<?php
require_once 'models/ProductsModel.php';


class ProductsController{
    public $model;
    public $page;


    public function __construct(){
        $this->model = new ProductsModel();
        $this->page = 'Products';
    }

    //funzione pulsanti pagina
    public function index(){
        $table = $this->model->SelectAll();
        include 'views/template.php';
    }

    public function create(){
        $table = $this->model->selectAll();
        $categories = $this->model->selectCategories();

        $view = 'views/products_form_create.php';
        include 'views/template.php';
    }

    public function delete(){
        $table = $this->model->SelectAll();
        $names = $this->model->SelectNames();
        $view = 'views/products_form_delete.php';
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