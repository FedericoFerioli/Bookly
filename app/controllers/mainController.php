<?php
defined('APP') or die("Accesso negato");

class MainController{

    public function index(){
        include "views/main.php";
    }
}