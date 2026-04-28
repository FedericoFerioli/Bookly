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


    public function details(){
        $id = $_GET['id'] ?? 0;
        $insertion = $this->model->getOne($id);
        $view = 'views/viewlisting/Viewlisting_details.php';
        include 'views/viewlisting/Viewlisting_template.php';
    }

    public function buy(){
        $id                 = (int)($_GET['id'] ?? 0);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $id;
        $insertions = [];

        foreach ($_SESSION['cart'] as $cart_id) {
            $insertions[] = $this->model->getOne($cart_id);
        }

        $places             = $this->model->getPlaces();
        $other_insertions   = $this->model->insertionsByUser([$insertions[0]['selling_user']]); //avnno passati anche gli id del carrello così che non siano visualizzati

        $view = 'views/viewlisting/Viewlisting_buy.php';
        include 'views/viewlisting/Viewlisting_template.php';

    }

    public function add_to_cart(){
        $_SESSION['cart'][] = (int)($_GET['id'] ?? 0);

        $view = 'views/viewlisting/Viewlisting_buy.php';
        include 'views/viewlisting/Viewlisting_template.php';
    }

        public function sold_insertion(){
            $ids          = $_SESSION['cart'];
            $place_id     = (int)($_POST['place_id'] ?? 0);
            $sell_time    = $_POST['sell_time'] ?? null;
            $exchange_day = $_POST['date'] ?? null;

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
                    if (in_array($data->format('Y-m-d'), $festivi)) { // ← graffa mancante
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
                $id = $ids[0]; // ← prendi il primo elemento per il redirect
                header("Location: index.php?page=Viewlisting&action=buy&id=$id");
                exit;
            }
        }



    }
