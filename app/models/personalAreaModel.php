<?php  
defined('APP') or die('Acceso negato');

require_once __DIR__ . '/../../config/dbconnect.php';
class personalAreaModel{
    private $pdo;
    public function __construct(){
        $this->pdo = DB::connect();
    }

    //qua serve una funzione che estragga tutte le inserzioni di un utente

    //funzione per aggiungere un'inserzione
    public function addInsertion(array $param) :bool{
        $dml="INSERT INTO insertions(`price`,`exchange_day`,`book_condition`,`sell_time`,`insertion_state`,`post_date`,`selling_user`,`buying_user`,`place_id`,`book_id`,`course_id`)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        //$param contiene tutti i dati necessari
        $stm=$this->pdo->prepare($dml); //prepara l'istruzione query ricevuta in $dml
        $stm->execute($param); //esegue la query preparata usando come valori il contenuto dell'array $param
        return $stm->rowCount()!==0; //controlla che l'inserimento sia andato a buon fine
    }

    //funzione per modificare un'inserzione

    //funzione per eliminare un'inserzione
    public function deleteInsertion(array $param): bool{
        $dml="DELETE FROM insertions WHERE `insertion_id`=?";
        //$param=[insertion_id]
        $stm=$this->pdo->prepare($dml); //prepara l'istruzione query ricevuta in $dml
        $stm->execute($param); //esegue la query preparata usando come valori il contenuto dell'array $param
        return $stm->rowCount()!==0; //controlla che l'eliminazione sia andato a buon fine
    }
}