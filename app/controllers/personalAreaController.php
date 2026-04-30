<?php
defined('APP') or die('Acceso negato');

require_once 'models/PersonalareaModel.php';

class PersonalAreaController{
    public $model;
    public $page;

    public function __construct(){
        $this->model = new PersonalareaModel();
        $this->page = 'personalArea';
    }

    public function isLogged(){
        if($_SESSION['logged'] != true){
            header('location:index.php?page=login&action=login');
            exit;
        }
    }

    //Metodo per quando il compratore conferma che lo scambio è andato bene
    public function confirm_insertion(){
        $id = (int)($_GET['id'] ?? 0);
        //questo metodo del model modifica la colonna confirmation a 1
        $result = $this->model->set_confirmation($id);

        if($result){
            $_SESSION['success'] = 'Hai confermato lo scambio!';
        } else {
            $_SESSION['err'] = 'Errore nella conferma dello scambio.';
        }

        header('Location: index.php?page=personalArea&action=my_orders');
        exit;
    }

    //Metodo per quando il venditore conferma che lo scambio è andato bene
    public function modify_insertion_state(){
        $id = (int)($_GET['id'] ?? 0);

        //questo metodo modifica insertion_state a 'sold' ma solo se confirmation è settato a 1
        $result = $this->model->set_insertionState($id);

        $_SESSION['err'] = '';
        
        if(!$result){
            $_SESSION['err'] = "l'acquirente non ha ancora confermato l'acquisto, aspetta che lo completi prima di confermare l'acquisto";
        }else{
            $_SESSION['success'] = 'Compravendita avvenuta con successo!';

        }

        header('Location: index.php?page=personalArea&action=my_orders');
        exit;
    }


    //metodo per visualizzare la dashboard
    public function dashboard(){
        $this->isLogged();
        
        $param = [$_SESSION['user_id']];

        $insertions = $this->model->SelectInsertionOfUser($param);
        $userData = $this->model->getUserInfo($param);

        $userData = $userData[0];
        $view = 'views/Personalarea/Perosonalarea_dashboard.php';
        include 'views/Personalarea/personalArea_template.php';
    }

    //metodo per vederi i propri ordini: sia che si stanno vendendo, sia che si stanno comprando
    public function my_orders(){

        $user_id= $_SESSION['user_id'];

        $to_sell = $this->model->getInsertionToSell($user_id);
        $to_buy = $this->model->getInsertionToBuy($user_id);

        $view = 'views/Personalarea/Personalarea_myorders.php';
        include 'views/Personalarea/personalArea_template.php';
    }

    //visualizza il form per creare un nuovo annuncio 
    public function new_insertion(){   
        $this->isLogged();
        $courses = $this->model->selectCourses();
        $view = 'views/Personalarea/Personalarea_new_insertion_form.php';
        include 'views/Personalarea/personalArea_template.php';

    }
    
    public function modify_insertion(){
        $this->isLogged();
        $id = $_GET['id'] ?? 0;

        $thisInsertion = $this->model->getOne($id);
        $courses = $this->model->selectCourses();

        $view = 'views/Personalarea/Personalarea_modify_insertion.php';
        include 'views/Personalarea/personalArea_template.php';
    }

    public function delete_insertion(){
        $this->isLogged();
        $id = $_GET['id'] ?? 0;
        $param = [$id];
        $deletionInsertion = $this->model->deleteInsertion($param);

        if(!$deletionInsertion){
            $_SESSION['err'] = 'Errore durante la cancellazione.';
        }
        header('Location: index.php?page=personalArea&action=dashboard');
        exit;
    }

    

    public function save_insertion(){


        $book_id = $_POST['book_id'] ?? null;

        if (!$book_id) {
            die("Errore: Sessione scaduta o libro non trovato. Riprova la ricerca ISBN.");
        }


        $price = trim($_POST['my_price'] ?? '');
        $book_condition = trim($_POST['condition'] ?? '');
        $insertion_state = "selling";
        $description = trim($_POST['description'] ?? '');
        $selling_user = trim($_SESSION['user_id'] ?? '');

        $param = [$price, $book_condition, $description, $insertion_state, $selling_user, $book_id];
        $insertion = $this->model->newInsertion($param);

        
        $insertion_id = $this->model->getLastInsertionId($selling_user);

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $uploadDir = '/var/www/html/ferioli/public/images/insertions/';        
        $files        = $_FILES['images'] ?? null;
        $maxImages    = 3;
        
        if ($files) {
            $count = min(count($files['name']), $maxImages);

            for ($i = 0; $i < $count; $i++) {
                if ($files['error'][$i] !== 0) continue;

                $finfo    = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $files['tmp_name'][$i]);
                finfo_close($finfo);

                if (!in_array($mimeType, $allowedTypes)) continue;

                $ext         = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                $newName     = uniqid('book_', true) . '.' . $ext;
                $destination = $uploadDir . $newName;

                $moved = move_uploaded_file($files['tmp_name'][$i], $destination);
                if ($moved) {
                    $this->model->saveInsertionImage($destination, $insertion_id);         
                }
            }
        }

        if($insertion){
            unset($_SESSION['new_libro_precaricato']);            
            $_SESSION['msg_errore_inserzione'] = "Inserimento completato";        
            header('Location: index.php?page=personalArea&action=new_insertion');
            exit;
        }else{
            $_SESSION['msg_errore_inserzione'] = "Non siamo riusciti a craere l'inserzione";        
            header('Location: index.php?page=personalArea&action=new_insertion');
            exit;
        }

    }

    public function search_isbn(){
        // dati dal form 
        $isbn = trim($_POST['isbn'] ?? '');
 
        //richiesta al model 
        $param = [$isbn];
        $libro_trovato = $this->model->isbnResearch($param);

        // 2. Verifichi se il libro è stato trovato
        if ($libro_trovato) {
            // Il libro viene salvato in una sessione se viene trovato
            $_SESSION['new_libro_precaricato'] = $libro_trovato;
        } else {
            $_SESSION['msg_errore'] = "Nessun libro trovato per questo ISBN.";        
        }

    header('Location: index.php?page=personalArea&action=new_insertion');
    exit;
    }

    public function search_isbn_for_modify(){
        // dati dal form 
        $id_inserzione= trim($_GET['id']);
        $isbn = trim($_POST['isbn'] ?? '');
 
        //richiesta al model 
        $param = [$isbn];
        $libro_trovato = $this->model->isbnResearch($param);

        // 2. Verifichi se il libro è stato trovato
        if ($libro_trovato) {
            // Il libro viene salvato in una sessione se viene trovato
            $_SESSION['libro_precaricato'] = $libro_trovato;
        } else {
            $_SESSION['msg_errore'] = "Nessun libro trovato per questo ISBN.";        
        }

    header('Location: index.php?page=personalArea&action=modify_insertion&id='.$id_inserzione);
    exit;
    }

    public function change_insertion(){

        $book_id = $_POST['book_id'] ?? null;

        if (!$book_id) {
            die("Errore: Sessione scaduta o libro non trovato. Riprova la ricerca ISBN.");
        }

        $title = trim($_POST['title'] ?? '');
        $authors = trim($_POST['authors'] ?? '');
        $publisher = trim($_POST['publisher'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $my_price = trim($_POST['my_price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $condition = trim($_POST['condition'] ?? '');
        $insertion = trim($_GET['insertion_id'] ?? $_POST['insertion_id']);

        //$param = [$book_id, $my_price, $condition, $description, $course, $insertion]
        $param = [
        $book_id,
        $my_price,
        $condition,
        $description,
        $insertion
        ];
            
        $insertion = $this->model->modifyInsertion($param);

        if($insertion){
            unset($_SESSION['libro_precaricato']);            
            $_SESSION['msg_errore_inserzione'] = "Modifica completata con successo";        
            header('Location: index.php?page=personalArea&action=dashboard');
            exit;
        }else{
            $_SESSION['msg_errore_inserzione'] = "Non siamo riusciti a modificare l'inserzione";        
            header('Location: index.php?page=personalArea&action=dashboard');
            exit;
        }

    }
    }

?>