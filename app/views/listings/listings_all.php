<h1>tutte le inserzioni</h1>

<?php foreach($insertions as $insertion): ?>
    <div class="annuncio">
        <h3><?= $insertion['title'] ?></h3>
        <p><?= $insertion['authors'] ?></p>
        <p><?= $insertion['name'] ?></p>
    </div>
<?php endforeach; ?>