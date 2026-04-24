<?php  
defined('APP') or die('Acceso negato');

require_once('models/LoginModel.php');

class loginController{
    private $model;
    private $page;

    public function __construct(){
        $this->model = new loginModel();
        $this->page = 'login';

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



        //controllo dei dati inseriti nel form
        //email fornita dall'utnete
        //Controllo formato email generico di php
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Formato email non valido";
        }

        //Controllo dominio specifico @isit100.fe.it
        $requiredDomain = "@isit100.fe.it";
        if (!str_ends_with($email, $requiredDomain)) {
            $errors[] = "Devi utilizzare l'email istituzionale della scuola (@isit100.fe.it)";
        }

        // 3. Controllo corrispondenza password
        if ($confirm_password !== $password) {
            $errors[] = "Le password non corrispondono";
        }

        // 4. (Opzionale ma consigliato) Controllo lunghezza minima password
        if (strlen($password) < 8) {
            $errors[] = "La password deve contenere almeno 8 caratteri";
        }

        $password = hash("sha256", $password);
 
        if(empty($errors)){
        //richiesta al model 
        $param = [$name, $surname, $gender, $email, $dob ,$password];
        $this->model->insertRecord($param);
        }else{
            header('location:index.php?page=login&action=login&msg=error');
            exit;
        }

        //ricaricamneto della pagina
        header('location: index.php?page=login&action=login');
        exit;
    }

public function check(){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = hash("sha256", $password);

    $param = [$email, $password];
    $user = $this->model->find($param);
    
    if($user){
        session_regenerate_id(true);
        $_SESSION['logged'] = true;
        $_SESSION['user_id'] = $user['user_id'];            
        header('location:index.php?page=main&action=index');
        exit;
    } else {
        header('location:index.php?page=login&action=login&msg=error');
        exit;
    }
}

public function logout(){
    $_SESSION = []; 
    session_destroy();
    header('location: index.php');
    exit;
}

}
?>