<?php foreach($table as $annuncio): ?>
    <div class="annuncio">
        <h3><?= $annuncio['title'] ?></h3>
        <p><?= $annuncio['authors'] ?></p>
        <p><?= $annuncio['prezzo'] ?> €</p>
    </div>
<?php endforeach; ?>