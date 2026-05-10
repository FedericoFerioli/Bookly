<!-- Titoli delle inserzioni nel carrello -->
<p>Stai acquistando:
    <?php foreach ($insertions as $i => $ins): ?>
        <strong><?= htmlspecialchars($ins['title']) ?></strong><?= $i < count($insertions) - 1 ? ', ' : '' ?>
        <?php if ($i > 0): ?>
            <a href="index.php?page=Viewlisting&action=remove_from_cart&id_to_remove=<?= $ins['insertion_id'] ?>" 
               style="color: red; text-decoration: none; font-weight: bold; margin-left: 10px;"
               onclick="return confirm('Vuoi davvero rimuovere questo articolo?')">
               🗑️
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</p>

<form action="index.php?page=Viewlisting&action=sold_insertion" method="POST">

    <?php if (!empty($_SESSION['errori'])): ?>
        <ul>
            <?php foreach ($_SESSION['errori'] as $errore): ?>
                <li><?= htmlspecialchars($errore) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errori']); ?>
    <?php endif; ?>

    <label for="place_id">Luogo</label>
    <select name="place_id" id="place_id">
        <?php foreach ($places as $place): ?>
            <option value="<?= htmlspecialchars($place['place_id']) ?>">
                <?= htmlspecialchars($place['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="sell_time">Orario</label>
    <select name="sell_time" id="sell_time">
        <option value="08:00">08:00</option>
        <option value="09:00">09:00</option>
        <option value="10:00">10:00</option>
        <option value="11:00">11:00</option>
        <option value="12:00">12:00</option>
        <option value="13:00">13:00</option>
        <option value="14:00">14:00</option>
    </select>

    <label for="date">Data</label>
    <input type="date" name="date" id="date">


    <input type="checkbox" required> Bookly non si assume alcuna responsabilità sullo scambio di soldi

    <button type="submit">Imposta l'appuntamento</button>

</form>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">Altri annunci dell'utente che puoi aggiungere al carrello</h1>
        <span class="badge bg-secondary"><?= count($other_insertions) ?> libri disponibili</span>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach($other_insertions as $ins): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-light border-0 pt-3">
                        <span class="badge rounded-pill bg-info text-dark">
                            <?= htmlspecialchars($ins['subject_name'] ?? 'Materia N.D.') ?>
                        </span>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title text-truncate fw-bold" title="<?= htmlspecialchars($ins['title']) ?>">
                            <?= htmlspecialchars($ins['title']) ?>
                        </h5>
                        <p class="card-subtitle mb-2 text-muted small">
                            di <?= htmlspecialchars($ins['publisher'] ?? 'Editore sconosciuto') ?>
                        </p>

                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="fs-4 fw-bold text-success">
                                <?= number_format($ins['price'], 2, ',', '.') ?> €
                            </span>
                            <span class="badge bg-light text-dark border">
                                <?= htmlspecialchars($ins['book_condition'] ?? 'Usato') ?>
                            </span>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-top-0 pb-3">
                        <?php if (in_array($ins['insertion_id'], $_SESSION['cart'])): ?>
                            <button class="btn btn-success w-100" disabled>✓ Nel carrello</button>
                        <?php else: ?>
                            <a href="index.php?page=Viewlisting&action=add_to_cart&id=<?= $ins['insertion_id'] ?>"
                               class="btn btn-outline-primary w-100">
                               Aggiungi annuncio al carrello
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>