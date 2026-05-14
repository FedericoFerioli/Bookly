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

    /**
     * Metodo per controllare se un utente è registrato
     */
    public function isLogged(){
        if($_SESSION['logged'] != true){
            header('location:index.php?page=login&action=login');
            exit;
        }
    }

    /**
     * Metodo per quando il COMPRATORE conferma che lo scambio è andato bene
     */
    public function confirm_insertion(){
        $id = (int)($_GET['id'] ?? 0);

        //questo metodo del model modifica la colonna confirmation a 1
        $result = $this->model->set_confirmation($id);

        if($result){
            $_SESSION['success'] = 'Hai confermato lo scambio! Aspetta che il venditore lo faccia a sua volta';
        } else {
            $_SESSION['err'] = 'Errore nella conferma dello scambio. Hai già confermato lo scambio, aspetta che lo faccia anche il venditore';
        }

        header('Location: index.php?page=personalArea&action=my_orders');
        exit;
    }

    /**
     * Metodo per quando il VENDITORE conferma che lo scambio è andato bene
     */
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

    /**
     * metodo per la view dashboard
     */
    public function dashboard(){
        $this->isLogged();
        
        //Prendiamo dalla sessione lo user_id
        $param = [$_SESSION['user_id']];

        /**
         * Estraiamo le inserzioni dell'utente + le immagini relative
         */
        $insertions = $this->model->SelectInsertionOfUser($param);

        foreach ($insertions as &$insertion) {
            $insertion['images'] = $this->model->getImagesById($insertion['insertion_id']);
        }   

        unset($insertion);

        //prendiamo le informazioni dell'utente
        $userData = $this->model->getUserInfo($param);

        $view = 'views/Personalarea/Perosonalarea_dashboard.php';
        include 'views/Personalarea/personalArea_template.php';
    }

    //metodo per view dei propri ordini: sia che si stanno vendendo, sia che si stanno comprando
    public function my_orders(){

        $user_id= $_SESSION['user_id'];

        $to_buy = $this->model->getInsertionToBuy($user_id);
        $to_sell = $this->model->getInsertionToSell($user_id);

        $view = 'views/Personalarea/Personalarea_myorders.php';
        include 'views/Personalarea/personalArea_template.php';
    }

    //visualizza il form per creare un nuovo annuncio 
    public function new_insertion(){
        //controliamo se l'utente è loggato
        $this->isLogged();

        //$courses = $this->model->selectCourses();

        $view = 'views/Personalarea/Personalarea_new_insertion_form.php';
        include 'views/Personalarea/personalArea_template.php';

    }
    
    /**
     * Metdo per view modificare un'inserzione
     */
    public function modify_insertion(){
        //controlliamo se l'utente è loggato
        $this->isLogged();

        //prendiamo l'id dell'inserzione
        $id = $_GET['id'] ?? 0;

        //Rimuoviamo precedenti messaggi della sessione
        unset($_SESSION['msg_modifica']);

        
        $thisInsertion = $this->model->getOne($id);
        //$courses = $this->model->selectCourses();

        $view = 'views/Personalarea/Personalarea_modify_insertion.php';
        include 'views/Personalarea/personalArea_template.php';
    }

    /**
     * Metodo per eliminare un'inserzione
     */
    public function delete_insertion(){
        //controlliamo che l'utente sia loggato
        $this->isLogged();
        //id inserzione
        $id = $_GET['id'] ?? 0;

        $param = [$id];
        $deletionInsertion = $this->model->deleteInsertion($param);

        //Se l'eliminazione del record non è andata a buon fine salviamo in sessione un messaggio (da visualizzare nella dashboard)
        if(!$deletionInsertion){
            $_SESSION['err'] = 'Errore durante la cancellazione.';
        }else{
            $_SESSION['success'] = 'Inserzione eliminata.';
        }

        header('Location: index.php?page=personalArea&action=dashboard');
        exit;
    }

    /**
     * Metodo per creare un nuova inserzione 
     */
    public function save_insertion(){
        $book_id = $_POST['book_id'] ?? null;

        /*
        if (!$book_id) {
            die("Errore: Sessione scaduta o libro non trovato. Riprova la ricerca ISBN.");
        }*/

        //dati form
        $price = trim($_POST['my_price'] ?? '');
        $book_condition = trim($_POST['condition'] ?? '');
        $insertion_state = "selling";
        $description = trim($_POST['description'] ?? '');
        //L'utente che vende è quello che sta creando l'inserzione
        $selling_user = trim($_SESSION['user_id'] ?? '');

        $param = [$price, $book_condition, $description, $insertion_state, $selling_user, $book_id];
        $insertion = $this->model->newInsertion($param);

        //Prendiamo l'id dell'ultima inserizone dell'utente
        $insertion_id = $this->model->getLastInsertionId($selling_user); 

        //tipe mime accettati
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        //cartella destinazione immagini
        $uploadDir = '/var/www/html/ferioli/public/images/insertions/';        
        $files        = $_FILES['images'] ?? null;
        $maxImages    = 3;
        
        if ($files) {
            //Limitiamo il numero di immagini
            $count = min(count($files['name']), $maxImages);

            for ($i = 0; $i < $count; $i++) {
                //saltiamo i file che hanno avuto degli errori durante l'upload
                if ($files['error'][$i] !== 0) continue;

                $finfo    = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $files['tmp_name'][$i]);
                finfo_close($finfo);

                //Controlliamo che il mime type sia tra quelli accettati
                if (!in_array($mimeType, $allowedTypes)) continue;

                $ext         = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                $newName     = uniqid('book_', true) . '.' . $ext;
                $destination = $uploadDir . $newName;

                //spostiamo il file nella cartella di destinazione /var/www/html/ferioli/public/images/insertions/
                $moved = move_uploaded_file($files['tmp_name'][$i], $destination);
                if ($moved) {
                    $this->model->saveInsertionImage($destination, $insertion_id);         
                }
            }
        }

        if($insertion){
            unset($_SESSION['new_libro_precaricato']);            
            $_SESSION['msg_modifica'] = "Inserimento completato";        
            header('Location: index.php?page=personalArea&action=new_insertion');
            exit;
        }else{
            $_SESSION['msg_modifica'] = "Non siamo riusciti a craere l'inserzione";        
            header('Location: index.php?page=personalArea&action=new_insertion');
            exit;
        }

    }

        
    /**
     * search_isbn
     * Ricerca nel database del libro attraverso l'isbn
     * @return void
     */
    public function search_isbn(){
        //dati form
        $isbn = trim($_POST['isbn'] ?? '');
 
        $param = [$isbn];
        $libro_trovato = $this->model->isbnResearch($param);

        if ($libro_trovato) {
            $_SESSION['new_libro_precaricato'] = $libro_trovato;
        } else {
            $_SESSION['msg_errore'] = "Nessun libro trovato per questo ISBN.";        
        }

        header('Location: index.php?page=personalArea&action=new_insertion');
        exit;
    }

    //    
    /**
     * search_isbn_for_modify
     * Ricerca del libro per l'isbn per la modifica, l'header deve reindirizzare a una rotta diversa che include anche l'insertion id
     * @return void
     */
    public function search_isbn_for_modify(){
        // dati dal form 
        $id_inserzione= trim($_GET['id']);
        $isbn = trim($_POST['isbn'] ?? '');
 
        //richiesta al model 
        $param = [$isbn];
        $libro_trovato = $this->model->isbnResearch($param);

        if ($libro_trovato) {
            $_SESSION['libro_precaricato'] = $libro_trovato;
        } else {
            $_SESSION['msg_errore'] = "Nessun libro trovato per questo ISBN.";        
        }

        
        header('Location: index.php?page=personalArea&action=modify_insertion&id='.$id_inserzione);
        //header('Location: index.php?page=personalArea&action=modify_insertion');
        exit;
    }
    
    /**
     * change_insertion
     * Funzione per modificare le info di una inserzione
     * @return void
     */
    public function change_insertion(){

        $book_id = $_POST['book_id'] ?? null;

        //debug
        if (!$book_id) {
            die("Errore: Sessione scaduta o libro non trovato. Riprova la ricerca ISBN.");
        }

        $title       = trim($_POST['title'] ?? '');
        $authors     = trim($_POST['authors'] ?? '');
        $publisher   = trim($_POST['publisher'] ?? '');
        $subject     = trim($_POST['subject'] ?? '');
        $my_price    = trim($_POST['my_price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $condition   = trim($_POST['condition'] ?? '');
        $insertion   = trim($_GET['insertion_id'] ?? $_POST['insertion_id']);

        //$param = [$book_id, $my_price, $condition, $description, $insertion]
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
            $_SESSION['msg_modifica_success'] = "Modifica completata con successo";        

        }else{
            $_SESSION['msg_modifica_unsuccess'] = "Non siamo riusciti a modificare l'inserzione";        
        }
    
        header('Location: index.php?page=personalArea&action=dashboard');
        exit;
        
    }
    
    /**
     * modify_user_info
     * Funzione per visualizzare il form per la modifica delle info dell'utente
     * @return void
     */
    public function modify_user_info(){
        $id     = (int)($_SESSION['user_id'] ?? 0); //prendiamo l'id dalla sessione

        $param  = [$id];
        $user   = $this->model->getUserInfo($param);

        $view = 'views/Personalarea/Personalarea_modify_user.php';
        include 'views/Personalarea/personalArea_template.php';
    }
    
    /**
     * change_user_info
     * Funzione per modificare i dati di un utente sul db
     * @return void
     */
    public function change_user_info() {
        $id      = (int)($_SESSION['user_id'] ?? 0);
        $name    = trim($_POST['name']    ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $email   = trim($_POST['email']   ?? '');
        $dob     = $_POST['dob']          ?? '';
        $gender  = $_POST['gender']       ?? 'O';
        $password = $_POST['password']    ?? '';

        if (!$name || !$surname || !$email || !$dob) {
            $_SESSION['error'] = 'Compila tutti i campi obbligatori.';
            header('Location: index.php?page=personalArea&action=modify_user_info');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Formato email non valido";
        }
        //se è stata inserita la password includiamola in $params se no no
        if ($password !== '') {
            if (strlen($password) < 8) {
                $_SESSION['error'] = 'La password deve essere di almeno 8 caratteri.';
                header('Location: index.php?page=personalArea&action=modify_user_info');
                exit;
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $result = $this->model->updateUserInfo($id, $name, $surname, $email, $dob, $gender, $password);
        }else{
            $result = $this->model->updateUserInfo($id, $name, $surname, $email, $dob, $gender);
        }

        if ($result) {
            $_SESSION['success'] = 'Le tue informazioni sono state modificate con successo.';
        } else {
            $_SESSION['err'] = 'Errore durante l\'aggiornamento.';
        }

        header('Location: index.php?page=personalArea&action=dashboard');
        exit;
    }


        
    /**
     * view_completed_orders
     * funzione che estrae le inserzioni che sono state vendute dell'utente e fa visualizzare la view
     * @return void
     */
    public function view_completed_orders(){
        $this->isLogged();

        $user_id = $_SESSION['user_id'];

        $completedInsertions = $this->model->getCompletedOrders($user_id);


        foreach ($completedInsertions as &$completedInsertion) {
            $completedInsertion['images'] = $this->model->getImagesById($completedInsertion['insertion_id']);
        }   

        unset($completedInsertion);

        if($completedInsertions === false){
            $_SESSION['err'] = 'Non siamo riusciti a caricare i tuoi ordini.';
            header('Location: index.php?page=personalArea&action=dashboard');
            exit;
        }

        $view = 'views/Personalarea/Personalarea_completed_orders.php';
        include 'views/Personalarea/personalArea_template.php';
    }
}
