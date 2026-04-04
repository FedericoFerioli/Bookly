<?php  
defined('APP') or die('Acceso negato');

require_once('models/loginModel.php');

class loginController{
    private $model;
    private $page;

    public function __construct(){
        $this->model = new loginModel();
        $this->page = 'login';

    }

    //funzione pulsanti pagina
    public function index(){
        include 'views/template.php';
    }

    public function login(){
        $view = 'views/login_form.php';
        include 'views/login_template.php';
    }

    public function registration(){
        $view = 'views/login_registration_form.php';
        include 'views/login_template.php';
    }


    //funzioni sul database
    public function store(){
        // dati dal form 
        $errors = [];

        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $gender = trim($_POST['gender']);
        $email = strtolower(trim($_POST['email']));
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $dob = $_POST['dob'];



        //controllo dei danti inseriti nel form
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Formato email non valido";
        }
        if ($confirm_password !== $password){
            $errors[] = "Le password non corrispondono";
        }

 
        if(empty($errors)){
        //richiesta al model 
        $param = [$name, $surname, $gender, $email, $dob ,$password];
        $this->model->insertRecord($param);
        }else{
            header('location:index.php?page=login&action=login&msg=error');
            exit;
        }

        //ricaricamneto della pagina
        header('location: index.php?page=login&action=registration');
        exit;
    }

    public function check(){
        // dati dal form 
        $email = $_POST['email'];
        $password = $_POST['password'];

        //richiesta al model 
        $param = [$email, $password];

        if($this->model->find($param)){
            session_start();
            $_SESSION['customer_id'] = true;
            header('location:index.php?page=main&action=index');
            exit;
        }else{
            header('location:index.php?page=login&action=login&msg=error');
        }
    }

    public function logout(){
        session_destroy();
        header('location: index.php');
        exit;
    }
}
?>