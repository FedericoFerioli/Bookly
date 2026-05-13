<?php
if(!defined('APP')) die('Accesso negato');

class ErrorController {
    public function notFound(): void {
        /**
         * Settiamo la response a 404
         */
        http_response_code(404); 
        /**
         * Pagina 404 percorso assoluto
         */
        require_once "/var/www/html/ferioli/app/404.php";
    }
}