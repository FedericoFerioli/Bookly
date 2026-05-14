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

    /**
     * Form per il login
     */
    public function login(){
        $view = 'views/login/login_form.php';
        include 'views/login/login_template.php';
    }

    /**
     * Form per la registrazione
     */
    public function registration(){
        $view = 'views/login/login_registration_form.php';
        include 'views/login/login_template.php';
    }


    /**
     * Registrazione di un utente
     */
    public function store(){
        $errors = [];

        $name = trim($_POST['name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $gender = trim($_POST['gender'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? '') );
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');
        $dob = trim($_POST['dob'] ?? '');

        if(empty($name)){
            $errors[] = "Inserisci un nome";
        }

        if(empty($surname)){
            $errors[] = 'Inserisci un cognome';
        }

        if(empty($gender)){
            $errors[] = 'Inserisci un genere';
        }

        if(empty($email)){
            $errors[] = 'Inserisci un\'email';
        }

        if(empty($password)){
            $errors[] = 'Inserisci una password';
        }
        if(empty($confirm_password)){
            $errors[] = 'Inserisci una password';
        }
        if(empty($dob)){
            $errors[] = 'Inserisci la data di nascita';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Formato email non valido";
        }

        if ($confirm_password !== $password) {
            $errors[] = "Le password non corrispondono";
        }

        if (strlen($password) < 8) {
            $errors[] = "La password deve contenere almeno 8 caratteri";
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
 
        if(empty($errors)){

            $param = [$name, $surname, $gender, $email, $dob, $password];
            $this->model->insertRecord($param);

        }else{
            $_SESSION['errors'] = $errors;
            header('location:index.php?page=login&action=registration&msg=error');
            exit;
        }

        //ricaricamneto della pagina
        header('location: index.php?page=login&action=login');
        exit;
    }

    public function check() {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $row = $this->model->getPassword($email);

        if ($row && password_verify($password, $row['password'])) {
            session_regenerate_id(true);

            $_SESSION['logged']  = true;
            $_SESSION['user_id'] = $row['user_id']; // ora $row contiene anche user_id

            header('location: index.php?page=main&action=index');
            exit;
        } else {
            $_SESSION['err'] = "Credenziali non valide.";
            header('location: index.php?page=login&action=login&msg=error');
            exit;
        }
    }

    /**
     * Logout
     * Metodo per quando si preme 'disconettiti'
     */
    public function logout(){
        $_SESSION = []; 
        session_destroy();
        header('location: index.php');
        exit;
    }

}
?>