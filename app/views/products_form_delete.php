<?php 
defined('APP') or die('restricted access');
?>

<h1>Deleting products</h1>
<form action="index.php?page=products&action=destroy" method="post">
    <h3>Nome</h3>
        <select name="name">
            <?php foreach($names as $name): ?>
            <option value="<?= $name['name']; ?>"><?= $name['name']; ?> </option>
        <?php endforeach?>


</form>