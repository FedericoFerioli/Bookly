<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>
    /* ==========================================================================
       NUOVO CSS ESCLUSIVO PER IL LAYOUT A TABELLA DEGLI ORDINI COMPLETATI
       ========================================================================== */
    
    .completed-orders-container {
        width: 100%;
        box-sizing: border-box;
    }
    
    .view-title {
        color: #007bff; 
        margin: 0 0 5px 0; 
        font-size: 1.8rem; 
        font-weight: 700;
    }
    
    .view-subtitle {
        color: #65676b; 
        margin: 0 0 2rem 0;
        font-size: 1rem;
    }

    /* Wrapper per rendere la tabella responsive su schermi piccoli */
    .table-responsive-wrapper {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        background: #fff;
    }

    /* Struttura base della Tabella */
    .custom-orders-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.95rem;
        min-width: 700px; /* Evita che la tabella si rimpicciolisca troppo comprimendo il testo */
    }

    .custom-orders-table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        padding: 16px 20px;
        border-bottom: 2px solid #dee2e6;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .custom-orders-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .custom-orders-table tr:last-child td {
        border-bottom: none;
    }

    .custom-orders-table tr:hover {
        background-color: #fafbfc;
    }

    /* Mini contenitore per l'anteprima immagine della copertina */
    .table-img-container {
        width: 50px;
        height: 70px;
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .table-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .no-img-text {
        font-size: 0.65rem;
        color: #8a8d91;
        text-align: center;
        font-weight: 600;
        line-height: 1.1;
    }

    /* Celle con informazioni testuali */
    .book-title-text {
        font-weight: 700;
        color: #1c1e21;
        margin: 0 0 4px 0;
        font-size: 0.95rem;
        line-height: 1.3;
    }

    .book-meta-text {
        font-size: 0.8rem;
        color: #65676b;
        margin: 0;
    }

    /* Badge per Materia e Stato */
    .subject-custom-badge {
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        background-color: #e7f3ff; 
        color: #1877f2;
        display: inline-block;
        white-space: nowrap;
    }

    .status-custom-badge {
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        background-color: #d4edda; 
        color: #155724; 
        border: 1px solid #c3e6cb;
        display: inline-block;
        white-space: nowrap;
    }

    .price-custom-text {
        color: #28a745;
        font-weight: 700;
        font-size: 1.1rem;
        white-space: nowrap;
    }

    /* Bottone d'azione compatto */
    .btn-table-action {
        display: inline-block;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
        background: transparent;
        white-space: nowrap;
    }

    .btn-table-action:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Schermata Stato Vuoto */
    .empty-custom-state {
        background: #fff; 
        padding: 4rem 2rem; 
        text-align: center; 
        border-radius: 12px; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
        border: 1px solid #e0e0e0; 
        margin-top: 2rem;
    }

    .empty-custom-state-icon {
        font-size: 3.5rem; 
        margin-bottom: 1rem;
    }

    .empty-custom-state-title {
        margin: 0 0 10px 0; 
        color: #1c1e21; 
        font-size: 1.4rem;
    }

    .empty-custom-state-text {
        color: #65676b; 
        margin: 0 auto 2rem auto; 
        max-width: 400px; 
        font-size: 0.95rem;
    }

    .btn-custom-sell {
        display: inline-block; 
        text-decoration: none;
        padding: 10px 25px;
        color: #007bff;
        border: 2px solid #007bff;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.2s;
    }

    .btn-custom-sell:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>

<div class="completed-orders-container">
    <div>
        <h2 class="view-title">I tuoi ordini completati</h2>
        <p class="view-subtitle">Ecco lo storico dei libri che hai venduto con successo su Bookly.</p>
    </div>

    <?php if (empty($completedInsertions)): ?>
        <div class="empty-custom-state">
            <div class="empty-custom-state-icon">📦</div>
            <h3 class="empty-custom-state-title">Nessun ordine completato</h3>
            <p class="empty-custom-state-text">Non hai ancora venduto nessun libro o le tue transazioni sono in attesa di essere completate.</p>
            <a href="index.php?page=personalArea&action=new_insertion" class="btn-custom-sell">
                Vendi il tuo primo libro
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive-wrapper">
            <table class="custom-orders-table">
                <thead>
                    <tr>
                        <th style="width: 80px; text-align: center;">Copertina</th>
                        <th>Dettagli Libro</th>
                        <th>Materia</th>
                        <th>Prezzo</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($completedInsertions as $order): ?>
                        <tr>
                            <td style="text-align: center;">
                                <div class="table-img-container" style="margin: 0 auto;">
                                    <?php if (!empty($order['images'])): ?>
                                        <?php 
                                            $imgName = is_array($order['images'][0]) ? ($order['images'][0]['path'] ?? '') : $order['images'][0];
                                        ?>
                                        <img src="/ferioli/public/images/insertions/<?= htmlspecialchars(basename($imgName)) ?>" 
                                             class="table-img"
                                             alt="Copertina">
                                    <?php else: ?>
                                        <span class="no-img-text">Nessuna<br>Foto</span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <h4 class="book-title-text"><?= htmlspecialchars($order['title']) ?></h4>
                                <p class="book-meta-text">
                                    <strong>Editore:</strong> <?= htmlspecialchars($order['publisher'] ?? 'N.D.') ?> | 
                                    <strong>Condizione:</strong> <?= htmlspecialchars($order['book_condition'] ?? 'Usato') ?>
                                </p>
                            </td>

                            <td>
                                <span class="subject-custom-badge">
                                    <?= htmlspecialchars($order['subject'] ?? $order['name'] ?? 'Materia N.D.') ?>
                                </span>
                            </td>

                            <td>
                                <span class="price-custom-text">
                                    <?= number_format($order['price'], 2, ',', '.') ?> €
                                </span>
                            </td>

                            <td>
                                <span class="status-custom-badge">
                                    Venduto
                                </span>
                            </td>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>