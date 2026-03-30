<?php  
defined('APP') or die('Acceso negato');
?>

<h1>Elimina categoria</h1>

<form action="index.php?page=categories&action=destroy" method="post">
    <h3>Nome</h3>
    <select name="name">
        <?php foreach($names as $name): ?>
        <option value="<?= $name['name']; ?>"><?= $name['name']; ?> </option>
    <?php endforeach?>
            
    <br>
    <input type="submit" value="Delete">
</form>