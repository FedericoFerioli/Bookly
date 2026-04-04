<?php  
defined('APP') or die('Acceso negato');
?>

<form action="index.php?page=products&action=store" method="post">
    <input type="text" name="name" id="" placeholder="Inserisci il nome" required> 
    <input type="text" name="brand" id="" placeholder="Inserisci il brand" required>
    <input type="text" name="amount" id="" placeholder="Inserisci il l'amount" required>
    <input type="number" name="price" id="" placeholder="Inserisci il price" required>
    <select name="category_id">
        <?php foreach($main as $category): ?>
        <option value="<?= $category['category_id']; ?>"><?= $category['name']; ?> </option>
    <?php endforeach?>
    <br>
    <input type="submit" value="Invia">
</form>