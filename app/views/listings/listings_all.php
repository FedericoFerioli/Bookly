<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">Bacheca Annunci</h1>
        <span class="badge bg-secondary"><?= count($insertions) ?> libri disponibili</span>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach($insertions as $insertion): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-light border-0 pt-3">
                        <span class="badge rounded-pill bg-info text-dark">
                            <?= htmlspecialchars($insertion['name'] ?? 'Materia N.D.') ?>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title text-truncate fw-bold" title="<?= $insertion['title'] ?>">
                            <?= htmlspecialchars($insertion['title']) ?>
                        </h5>
                        <p class="card-subtitle mb-2 text-muted small">
                            di <?= htmlspecialchars($insertion['publisher'] ?? 'Editore sconosciuto') ?>
                        </p>
                        
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="fs-4 fw-bold text-success">
                                <?= number_format($insertion['price'], 2, ',', '.') ?> €
                            </span>
                            <span class="badge bg-light text-dark border">
                                <?= htmlspecialchars($insertion['book_condition'] ?? 'Usato') ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent border-top-0 pb-3">
                        <a href="index.php?page=Viewlisting&action=details&id=<?= $insertion['insertion_id'] ?>" 
                           class="btn btn-outline-primary w-100">
                           Vedi Dettagli
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>