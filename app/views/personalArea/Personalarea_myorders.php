<?php if(!defined('APP')) die('Accesso negato'); ?>

<div class="container py-4">

    <h1 class="display-5 fw-bold text-primary mb-4">I miei ordini</h1>

    <?php if(!empty($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success'] ?>
        <?php unset($_SESSION['success']); ?>
    </div>
    <?php endif; ?>
    <?php if(!empty($_SESSION['err'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['err'] ?>
        <?php unset($_SESSION['err']); ?>
    </div>
    <?php endif; ?>




    <!-- libri che si stanno vendendo -->
    <h4 class="fw-bold mb-3">Libri che sto vendendo</h4>

    <?php if(empty($to_sell)): ?>
        <p class="text-muted">Nessuna vendita in corso.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
            <?php foreach($to_sell as $ins): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <span class="badge bg-warning text-dark mb-2">In vendita</span>
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($ins['title']) ?></h5>
                            <p class="text-muted small mb-1">di <?= htmlspecialchars($ins['publisher'] ?? 'N.D.') ?></p>
                            <p class="text-muted small mb-1">Materia: <?= htmlspecialchars($ins['subject_name'] ?? 'N.D.') ?></p>
                            <p class="fw-bold text-success mt-2"><?= number_format($ins['price'], 2, ',', '.') ?> €</p>
                            <p class="text-muted small mb-1">
                                Stai vendendo a : <?= htmlspecialchars($ins['name'] . ' ' . $ins['surname']) ?>
                                Email: <?= htmlspecialchars($ins['email']) ?>
                            </p>
                            <p class="text-muted small mb-1">
                                Luogo: <?= htmlspecialchars($ins['place']) ?><br>
                                Giorno: <?= (new DateTime($ins['exchange_day']))->format('d/m/Y') ?><br>
                                Ora: <?= (new DateTime($ins['exchange_day']))->format('H:i') ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="index.php?page=Viewlisting&action=details&id=<?= $ins['insertion_id'] ?>" 
                               class="btn btn-outline-primary w-100 btn-sm">Vedi annuncio</a>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="index.php?page=personalArea&action=modify_insertion_state&id=<?= $ins['insertion_id'] ?>" 
                               class="btn btn-outline-primary w-100 btn-sm">Ho venduto l'annuncio ed è andato tutto bene</a>
                        </div>
                        <a href="mailto:<?= htmlspecialchars($ins['email']) ?>" class="btn btn-outline-primary btn-sm">
                            Contatta venditore
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- libri che si stanno comprando -->
    <h4 class="fw-bold mb-3">Libri che sto comprando</h4>
    <?php if(empty($to_buy)): ?>
        <p class="text-muted">Nessun acquisto in corso.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach($to_buy as $ins): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <span class="badge bg-info text-dark mb-2">In acquisto</span>
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($ins['title']) ?></h5>
                            <p class="text-muted small mb-1">di <?= htmlspecialchars($ins['publisher'] ?? 'N.D.') ?></p>
                            <p class="text-muted small mb-1">Materia: <?= htmlspecialchars($ins['subject_name'] ?? 'N.D.') ?></p>
                            <p class="text-muted small mb-1">
                                Venditore: <?= htmlspecialchars($ins['name'] . ' ' . $ins['surname']) ?>
                                Email: <?= htmlspecialchars($ins['email']) ?>
                            </p>
                            <p class="text-muted small mb-1">
                                Luogo: <?= htmlspecialchars($ins['place']) ?><br>
                                Giorno: <?= (new DateTime($ins['exchange_day']))->format('d/m/Y') ?><br>
                                Ora: <?= (new DateTime($ins['exchange_day']))->format('H:i') ?>
                            </p>

                            <p class="fw-bold text-success mt-2"><?= number_format($ins['price'], 2, ',', '.') ?> €</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="index.php?page=Viewlisting&action=details&id=<?= $ins['insertion_id'] ?>" 
                               class="btn btn-outline-primary w-100 btn-sm">Vedi annuncio</a>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="index.php?page=personalArea&action=confirm_insertion&id=<?= $ins['insertion_id'] ?>" 
                               class="btn btn-outline-primary w-100 btn-sm">Ho acquistato il libro e va tutto bene</a>
                        </div>
                        <a href="mailto:<?= htmlspecialchars($ins['email']) ?>" class="btn btn-outline-primary btn-sm">
                            Contatta l'acqirente, ci sono dei problemi
                        </a>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>