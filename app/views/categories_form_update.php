<?php  
defined('APP') or die('Acceso negato');
?>
<form action="index.php?page=main&action=edit" method="post">
    <input type="number" name="id" id="" placeholder="Inserisci l'id" required>
    <input type="text" name="newName" id="" placeholder="Inserisci il nuovo nome">
    <input type="text" name="newDescription" id="" placeholder="Inserisci la nuova descrizione">
            

    <br>
    <input type="submit" value="Update">
</form>