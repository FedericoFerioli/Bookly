<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>
    
    /* --- LAYOUT SPECIFICO CARRELLO --- */
    .checkout-wrapper {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 30px;
        align-items: start;
    }

    /* Elenco libri nel carrello */
    .cart-list {
        background: var(--white);
        padding: 20px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child { border-bottom: none; }

    .cart-item-info {
        display: flex;
        flex-direction: column;
    }

    .cart-item-title {
        font-weight: 700;
        color: var(--text-main);
    }

    /* Form Appuntamento */
    .appointment-card {
        background: var(--white);
        padding: 25px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--primary);
        position: sticky;
        top: 100px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-select, .form-input-date {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        margin-bottom: 20px;
        font-family: inherit;
    }

    .checkbox-container {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    .btn-submit {
        width: 100%;
        padding: 15px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-submit:hover { background: var(--primary-hover); }

    /* Sezione Altri Annunci */
    .others-section {
        margin-top: 50px;
    }

    .grid-others {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 20px;
    }

    .badge-materia {
        background: #e7f3ff;
        color: var(--primary);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
    }

    .btn-add-cart {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
        text-decoration: none;
        border: 2px solid var(--primary);
        color: var(--primary);
        border-radius: 8px;
        font-weight: 700;
        transition: var(--transition);
    }

    .btn-add-cart:hover {
        background: var(--primary);
        color: white;
    }

    .btn-disabled {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
        background: #f0f2f5;
        color: #999;
        border-radius: 8px;
        border: 1px solid #ddd;
        cursor: not-allowed;
    }

    @media (max-width: 992px) {
        .checkout-wrapper { grid-template-columns: 1fr; }
        .grid-others { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
        .grid-others { grid-template-columns: 1fr; }
    }
</style>

<div class="container">
    <h2 style="margin-bottom: 30px;">Completa l'acquisto</h2>

    <div class="checkout-wrapper">
        
        <section>
            <div class="cart-list">
                <h3 style="margin-top: 0; font-size: 1.2rem; border-bottom: 2px solid #f0f2f5; padding-bottom: 10px;">
                    Libri scelti
                </h3>
                
                <?php foreach ($insertions as $i => $ins): ?>
                    <div class="cart-item">
                        <div class="cart-item-info">
                            <span class="cart-item-title"><?= htmlspecialchars($ins['title']) ?></span>
                            <span style="font-size: 0.85rem; color: #28a745; font-weight: 700;">
                                <?= number_format($ins['price'], 2, ',', '.') ?> €
                            </span>
                        </div>
                        
                        <?php if ($i > 0): ?>
                            <a href="index.php?page=Viewlisting&action=remove_from_cart&id_to_remove=<?= $ins['insertion_id'] ?>" 
                               style="text-decoration: none; font-size: 1.2rem;"
                               onclick="return confirm('Vuoi davvero rimuovere questo articolo?')">
                               🗑️
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($_SESSION['errori'])): ?>
                <div class="alert alert-danger" style="margin-top: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($_SESSION['errori'] as $errore): ?>
                            <li><?= htmlspecialchars($errore) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errori']); ?>
            <?php endif; ?>
        </section>

        <aside>
            <form action="index.php?page=Viewlisting&action=sold_insertion" method="POST" class="appointment-card">
                <h4 style="margin-top: 0; margin-bottom: 20px; color: var(--primary);">Organizza lo scambio</h4>
                
                <div class="form-group">
                    <label class="form-label" for="place_id">Luogo dell'incontro</label>
                    <select name="place_id" id="place_id" class="form-select" required>
                        <?php foreach ($places as $place): ?>
                            <option value="<?= htmlspecialchars($place['place_id']) ?>">
                                <?= htmlspecialchars($place['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="date">Giorno</label>
                    <input type="date" name="date" id="date" class="form-input-date" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="sell_time">Orario preferito</label>
                    <select name="sell_time" id="sell_time" class="form-select" required>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                    </select>
                </div>

                <label class="checkbox-container">
                    <input type="checkbox" required style="margin-top: 4px;">
                    <span>Dichiaro di aver compreso che Bookly non gestisce i pagamenti e non è responsabile dello scambio.</span>
                </label>

                <button type="submit" class="btn-submit">CONFERMA APPUNTAMENTO</button>
            </form>
        </aside>
    </div>

    <section class="others-section">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
            <h3 style="margin: 0; color: var(--text-main);">Altri annunci di questo venditore</h3>
            <span style="background: #eee; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">
                <?= count($other_insertions) ?> libri disponibili
            </span>
        </div>

        <div class="grid-others">
            <?php foreach($other_insertions as $ins): ?>
                <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="margin-bottom: 10px;">
                            <span class="badge-materia">
                                <?= htmlspecialchars($ins['subject_name'] ?? 'Materia N.D.') ?>
                            </span>
                        </div>
                        <h4 style="margin: 0 0 5px 0; font-size: 1rem; line-height: 1.3;">
                            <?= htmlspecialchars($ins['title']) ?>
                        </h4>
                        <p style="color: var(--text-muted); font-size: 0.8rem; margin-bottom: 15px;">
                            di <?= htmlspecialchars($ins['publisher'] ?? 'Editore sconosciuto') ?>
                        </p>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <span style="color: #28a745; font-weight: 800; font-size: 1.1rem;">
                                <?= number_format($ins['price'], 2, ',', '.') ?> €
                            </span>
                            <span style="font-size: 0.7rem; background: #f8f9fa; padding: 2px 6px; border-radius: 4px; border: 1px solid #eee;">
                                <?= htmlspecialchars($ins['book_condition'] ?? 'Usato') ?>
                            </span>
                        </div>
                    </div>

                    <div>
                        <?php if (in_array($ins['insertion_id'], $_SESSION['cart'])): ?>
                            <button class="btn-disabled" disabled>✓ Nel carrello</button>
                        <?php else: ?>
                            <a href="index.php?page=Viewlisting&action=add_to_cart&id=<?= $ins['insertion_id'] ?>"
                               class="btn-add-cart">
                                + Aggiungi
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>