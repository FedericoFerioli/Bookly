<?php 
if(!defined('APP')) die('Accesso negato'); 
?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">

            <!-- IMMAGINI -->
            <?php if (!empty($insertion['images'])): ?>
                <div class="d-flex gap-2 mb-4">
                    <?php foreach ($insertion['images'] as $img): ?>
                        <img src="/ferioli/public/images/insertions/<?= htmlspecialchars(basename($img)) ?>" 
                             alt="foto libro"
                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h1 class="display-4 fw-bold"><?= htmlspecialchars($insertion['title']) ?></h1>
            <p class="lead text-muted">di <?= htmlspecialchars($insertion['authors']) ?></p>
            <hr>
            <h4>Descrizione del venditore:</h4>
            <p><?= nl2br(htmlspecialchars($insertion['description'])) ?></p>
            
            <div class="alert alert-light border">
                <h5>Dettagli Libro:</h5>
                <ul>
                    <li><strong>Editore:</strong> <?= htmlspecialchars($insertion['publisher']) ?></li>
                    <li><strong>Materia:</strong> <?= htmlspecialchars($insertion['subject_name']) ?></li>
                    <li><strong>Condizioni:</strong> <?= htmlspecialchars($insertion['book_condition']) ?></li>
                </ul>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3 class="text-success fw-bold"><?= number_format($insertion['price'], 2, ',', '.') ?> €</h3>
                    <p class="small text-muted">Venduto da: <strong><?= htmlspecialchars($insertion['name']) ?> <?= htmlspecialchars($insertion['surname']) ?></strong></p>

                        <?php if(in_array((int)$insertion['insertion_id'], $myInsertions)): ?>
                            <a href="index.php?page=personalArea&action=modify_insertion&id=<?= $insertion['insertion_id'] ?>" 
                               class="btn btn-outline-warning btn-sm w-50">
                                Modifica la tua inserzione
                            </a>
                        <?php else: ?>
                        <a href="index.php?page=Viewlisting&action=buy&id=<?= $insertion['insertion_id'] ?>"
                            class="btn btn-outline-primary w-100">
                            Contatta il venditore
                        </a>                   
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>