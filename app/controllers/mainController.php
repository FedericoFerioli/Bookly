<?php
defined('APP') or die("Accesso negato");
require_once "models/mainModel.php";


class MainController{

    public function index(){
        include "views/main.php";
    }
}