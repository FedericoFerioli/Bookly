<?php  
defined('APP') or die('Acceso negato');
?>
<?php 
require_once 'dbconfig.php'; #file contenente credenziali di accesso al database

class DB{ #Classe del database
    public static function connect(){ #Funzione per connettersi e poter lavorare nel DB
        try{
    $pdo = new PDO( #PDO: classe che simboleggia una connessione tra PHP e un database
            "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=" . CHARSET, 
            USERNAME,
            PASSWORD,   #Inserimento automatico dell'indirizzo del database e delle credenziali per l'accesso 
            [PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION] #Controllo errori
            );
        return $pdo;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}



