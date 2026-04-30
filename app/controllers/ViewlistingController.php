<?php  
defined('APP') or die('Acceso negato');

require_once('models/ViewlistingModel.php');

class ViewlistingController{
    private $model;
    private $page;

    public function __construct(){
        $this->model = new ViewlistingModel();
        $this->page = 'Viewlisting';

    }

    public function isLogged(){
        if($_SESSION['logged'] != true){
            header('location:index.php?page=login&action=login');
            exit;
        }
    }

    public function details(){
        if(isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }

        $this->isLogged();

        $id = $_GET['id'] ?? 0;
        $insertion = $this->model->getOne($id);
        $insertion['images'] = $this->model->getImagesById($insertion['insertion_id']);
        

        $view = 'views/viewlisting/Viewlisting_details.php';
        include 'views/viewlisting/Viewlisting_template.php';
    }


    //quando si clicca contatta il venditore
    public function buy(){
        if(isset($_GET['id'])){
            $id = (int)($_GET['id'] ?? 0);
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
            $_SESSION['cart'][] = $id;
        }
        $insertions = [];

        //per ogni insertion_id nella sessione 'cart' prendiamo le informazioni delle inserzioni
        foreach ($_SESSION['cart'] as $cart_id) {
            $insertions[] = $this->model->getOne($cart_id);
        }

        //luoghi per il select
        $places             = $this->model->getPlaces();

        //prende le altre iserzioni dell'utente utilizzando il campo 'selling_user' dell'inserzione
        $other_insertions   = $this->model->insertionsByUser([$insertions[0]['selling_user']]);

        $view = 'views/viewlisting/Viewlisting_buy.php';
        include 'views/viewlisting/Viewlisting_template.php';

    }

    //quando si clicca aggiungi al carrello
    public function add_to_cart(){
        $_SESSION['cart'][] = (int)($_GET['id'] ?? 0);

        header("Location: index.php?page=Viewlisting&action=buy");
        exit;
    }

    //quando si clicca ordina
    public function sold_insertion(){
            $ids          = $_SESSION['cart'];
            $place_id     = (int)($_POST['place_id'] ?? 0);
            $sell_time    = $_POST['sell_time'] ?? null;
            $exchange_day = $_POST['date'] ?? null;
            $buyingUser   = $_SESSION['user_id'] ?? 0;

            $_SESSION['errori'] = [];

            // Controllo ids
            if (empty($ids) || !is_array($ids)) {
                $_SESSION['errori'][] = 'Nessun inserzione selezionata.';
            }

            // Validazione place_id
            if (empty($place_id)) {
                $_SESSION['errori'][] = 'Seleziona un luogo valido';
            }

            // Validazione sell_time
            $orari_validi = ['08:00','09:00','10:00','11:00','12:00','13:00','14:00'];
            if (empty($sell_time) || !in_array($sell_time, $orari_validi)) {
                $_SESSION['errori'][] = 'Seleziona un orario valido';
            }

            // Validazione exchange_day
            if (empty($exchange_day)) {
                $_SESSION['errori'][] = 'Seleziona una data.';
            } else {
                $data = DateTime::createFromFormat('Y-m-d', $exchange_day);

                if (!$data) {
                    $_SESSION['errori'][] = 'Formato data non valido.';
                } else {
                    $giorno = (int)$data->format('N');

                    if ($giorno == 7) {
                        $_SESSION['errori'][] = 'La domenica non è disponibile.';
                    }

                    $anno          = (int)$data->format('Y');
                    $inizio_estate = new DateTime("$anno-06-06");
                    $fine_estate   = new DateTime("$anno-09-15");
                    if ($data >= $inizio_estate && $data <= $fine_estate) {
                        $_SESSION['errori'][] = 'Le date delle vacanze estive non sono disponibili.';
                    }

                    $festivi = [
                        "$anno-01-01", "$anno-01-06", "$anno-04-25",
                        "$anno-05-01", "$anno-06-02", "$anno-08-15",
                        "$anno-11-01", "$anno-12-08", "$anno-12-25", "$anno-12-26",
                    ];
                    if (in_array($data->format('Y-m-d'), $festivi)) {
                        $_SESSION['errori'][] = 'La data selezionata è un giorno festivo.';
                    }

                    $inizio_natale = new DateTime("$anno-12-21");
                    $anno += 1;
                    $fine_natale   = new DateTime("$anno-01-06");
                    if ($data >= $inizio_natale && $data <= $fine_natale) {
                        $_SESSION['errori'][] = 'Le date delle vacanze natalizie non sono disponibili.';
                    }
                }
            }

            // Se ci sono errori torna indietro
            if (!empty($_SESSION['errori'])) {
                $id = $ids[0];
                header("Location: index.php?page=Viewlisting&action=buy&id=$id");
                exit;
            }
            
            $exchange_day = $exchange_day . ' ' . $sell_time . ':00';

            foreach($ids as $id){
                
                $param = [$exchange_day, $buyingUser, $place_id, $id]; 
                $this->model->setExchange($param);
            }

            header('Location: index.php?page=personalArea&action=my_orders');
            exit;
    }


    public function remove_from_cart() {
        //Recupera l'ID dell'inserzione da rimuovere (es: index.php?action=remove_from_cart&id=12)
        $id_to_remove = $_GET['id_to_remove'] ?? null;

        if ($id_to_remove !== null && isset($_SESSION['cart'])) {
            //Trova la posizione dell'ID nell'array
            $key = array_search($id_to_remove, $_SESSION['cart']);

            //Se esiste, rimuovilo
            if ($key !== false) {
                unset($_SESSION['cart'][$key]);

                //pzionale: Re-indicizza l'array per evitare buchi negli indici (0, 1, 3...)
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }

        // 5. Ritorna alla pagina del carrello
        header("Location: index.php?page=Viewlisting&action=buy");
        exit;
    }


}



    
