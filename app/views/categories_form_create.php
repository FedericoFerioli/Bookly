<?php  
defined('APP') or die('restricted access');
?>
<h1>Inserisci nuova categoria</h1>

<form action="index.php?page=main&action=store" method="post">
    <h3>Categoria</h3>
    <input type="text" name="name" id="" placeholder="Inserisci la categoria" required> 
    <h3>Descrizione</h3>
    <textarea name="description" placeholder="Inserisci la descrizione" required></textarea>
    <br>
    <input type="submit" value="Create">
</form>