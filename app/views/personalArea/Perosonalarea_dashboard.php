<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<div class="container py-4">

    <!-- AREA UTENTE -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Area Personale</h5>

            <div>
                <a href="index.php?page=personalArea&action=my_orders" class="btn btn-light btn-sm me-2">
                    I miei ordini
                </a>
                <a href="index.php?page=Login&action=logout" class="btn btn-outline-light btn-sm">
                    Logout
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nome:</strong> <?= htmlspecialchars($userData['name'] ?? 'Dato mancante') ?></p>
                    <p><strong>Cognome:</strong> <?= htmlspecialchars($userData['surname'] ?? 'Dato mancante') ?></p>
                    <p><strong>Genere:</strong> <?= htmlspecialchars($userData['gender'] ?? 'Dato mancante') ?></p>
                </div>

                <div class="col-md-6">
                    <p><strong>Email:</strong> <?= htmlspecialchars($userData['email'] ?? 'Dato mancante') ?></p>
                    <p><strong>Data di nascita:</strong> <?= htmlspecialchars($userData['dob'] ?? 'Dato mancante') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- BACHECA -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">📚 I tuoi annunci</h4>
        <span class="badge bg-secondary">
            <?= count($insertions) ?> libri
        </span>
    </div>

    <div class="row g-4">
        <?php foreach($insertions as $insertion): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">

                    <div class="card-header bg-light border-0">
                        <span class="badge bg-info text-dark">
                            <?= htmlspecialchars($insertion['name'] ?? 'Materia N.D.') ?>
                        </span>
                    </div>

                    <div class="card-body">
                        <h6 class="fw-bold text-truncate">
                            <?= htmlspecialchars($insertion['title']) ?>
                        </h6>

                        <p class="text-muted small mb-2">
                            <?= htmlspecialchars($insertion['publisher'] ?? 'Editore sconosciuto') ?>
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold text-success">
                                <?= number_format($insertion['price'], 2, ',', '.') ?> €
                            </span>

                            <span class="badge bg-light border text-dark">
                                <?= htmlspecialchars($insertion['book_condition'] ?? 'Usato') ?>
                            </span>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <div class="d-flex gap-2">

                            <a href="index.php?page=personalArea&action=modify_insertion&id=<?= $insertion['insertion_id'] ?>" 
                               class="btn btn-outline-warning btn-sm w-50">
                               ✏️ Modifica
                            </a>

                            <a href="index.php?page=personalArea&action=delete_insertion&id=<?= $insertion['insertion_id'] ?>" 
                               class="btn btn-outline-danger btn-sm w-50"
                               onclick="return confirm('Eliminare questo annuncio?')">
                               🗑️ Elimina
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
