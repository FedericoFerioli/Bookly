<?php 
if(!defined('APP')) die('Accesso negato'); 
?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
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
                    <button class="btn btn-primary w-100 btn-lg">Contatta il venditore</button>
                </div>
            </div>
        </div>
    </div>
</div>