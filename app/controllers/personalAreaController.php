<?php  
defined('APP') or die('Acceso negato');

require_once 'models/PersonalareaModel.php';

class PersonalareaController{
    public $model;
    public $page;

    public function __construct(){
        $this->model = new PersonalareaModel();
        $this->page = 'Personalarea';
    }

    public function index(){
        include 'views/main/main_template.php';
    }

    public function listings(){
        include 'views/listings/listings_template.php';
    }

    //view con annunci propri e info personali

    //view per accedere alla pagina per la modifica delle info personali

    //funzione per accedere all view della creazione annuncio

    //funzione per accedere all view della modifica annuncio
}

?>