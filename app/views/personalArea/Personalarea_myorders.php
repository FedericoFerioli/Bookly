<?php if(!defined('APP')) die('Accesso negato'); ?>

<style>
    .orders-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        align-items: start;
        margin-top: 30px;
    }

    .orders-section {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
    }

    .orders-section h4 {
        margin-bottom: 25px;
        color: #111827;
        font-size: 1.3rem;
    }

    .custom-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 20px;
    }

    .custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.08);
    }

    .custom-card-body {
        padding: 20px;
    }

    .custom-card-footer {
        padding: 15px 20px;
        border-top: 1px solid #f0f0f0;
        background: #fafafa;
    }

    .badge-custom-sell {
        background: #fff3cd;
        color: #856404;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 12px;
    }

    .badge-custom-buy {
        background: #dbeafe;
        color: #1d4ed8;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 12px;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #111827;
    }

    .book-info {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 6px;
        line-height: 1.5;
    }

    .book-price {
        font-size: 1.3rem;
        font-weight: 800;
        color: #16a34a;
        margin-top: 15px;
    }

    .btn-custom {
        display: block;
        width: 100%;
        text-align: center;
        text-decoration: none;
        padding: 10px 14px;
        border-radius: 10px;
        font-weight: 600;
        margin-bottom: 10px;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .btn-outline-custom {
        border: 2px solid #007bff;
        color: #007bff;
        background: transparent;
    }

    .btn-outline-custom:hover {
        background: #007bff;
        color: white;
    }

    .btn-success-custom {
        border: none;
        background: #16a34a;
        color: white;
    }

    .btn-success-custom:hover {
        background: #15803d;
    }

    .empty-text {
        color: #6b7280;
        font-style: italic;
    }

    /* BLOCCO INFO IMPORTANTI */
    .highlight-info {
        background: #f8fbff;
        border: 1px solid #bfdbfe;
        border-left: 5px solid #2563eb;
        border-radius: 12px;
        padding: 14px 16px;
        margin: 18px 0;
    }

    .highlight-info p {
        margin: 0 0 10px 0;
        color: #1e3a8a;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .highlight-info p:last-child {
        margin-bottom: 0;
    }

    .highlight-label {
        font-weight: 700;
        color: #111827;
    }

    .highlight-info strong {
        color: #2563eb;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .orders-wrapper {
            grid-template-columns: 1fr;
        }
    }
</style>

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

    <div class="orders-wrapper">

        <!-- SEZIONE VENDITE -->
        <div class="orders-section">

            <h4 class="fw-bold">Libri che devo vendere</h4>

            <?php if(empty($to_sell)): ?>

                <p class="empty-text">Nessuna vendita in corso.</p>

            <?php else: ?>

                <?php foreach($to_sell as $ins): ?>

                    <div class="custom-card">

                        <div class="custom-card-body">

                            <span class="badge-custom-sell">
                                In vendita
                            </span>

                            <h5 class="book-title">
                                <?= htmlspecialchars($ins['title']) ?>
                            </h5>

                            <p class="book-info">
                                di <?= htmlspecialchars($ins['publisher'] ?? 'N.D.') ?>
                            </p>

                            <p class="book-info">
                                Materia: <?= htmlspecialchars($ins['subject_name'] ?? 'N.D.') ?>
                            </p>
                            
                            <div class="highlight-info">

                                <p>
                                    <span class="highlight-label">Venditore:</span><br>
                                    <strong>
                                        <?= htmlspecialchars($ins['name'] . ' ' . $ins['surname']) ?>
                                    </strong>
                                </p>

                                <p>
                                    <span class="highlight-label">Email:</span><br>
                                    <strong>
                                        <?= htmlspecialchars($ins['email']) ?>
                                    </strong>
                                </p>

                                <p>
                                    <span class="highlight-label">Scambio:</span><br>

                                    📍 <?= htmlspecialchars($ins['place']) ?><br>

                                    📅 <?= (new DateTime($ins['exchange_day']))->format('d/m/Y') ?><br>

                                    🕒 <?= (new DateTime($ins['exchange_day']))->format('H:i') ?>
                                </p>

                            </div>

                            <div class="book-price">
                                <?= number_format($ins['price'], 2, ',', '.') ?> €
                            </div>

                        </div>

                        <div class="custom-card-footer">

                            <a href="index.php?page=Viewlisting&action=details&id=<?= $ins['insertion_id'] ?>" 
                               class="btn-custom btn-outline-custom">
                                Vedi annuncio
                            </a>

                            <a href="index.php?page=personalArea&action=modify_insertion_state&id=<?= $ins['insertion_id'] ?>" 
                               class="btn-custom btn-success-custom">
                                Vendita completata
                            </a>

                            <a href="mailto:<?= htmlspecialchars($ins['email']) ?>" 
                               class="btn-custom btn-outline-custom">
                                Contatta acquirente
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <!-- SEZIONE ACQUISTI -->
        <div class="orders-section">

            <h4 class="fw-bold">Libri che sto comprando</h4>

            <?php if(empty($to_buy)): ?>

                <p class="empty-text">Nessun acquisto in corso.</p>

            <?php else: ?>

                <?php foreach($to_buy as $ins): ?>

                    <div class="custom-card">

                        <div class="custom-card-body">

                            <span class="badge-custom-buy">
                                In acquisto
                            </span>

                            <h5 class="book-title">
                                <?= htmlspecialchars($ins['title']) ?>
                            </h5>

                            <p class="book-info">
                                di <?= htmlspecialchars($ins['publisher'] ?? 'N.D.') ?>
                            </p>

                            <p class="book-info">
                                Materia: <?= htmlspecialchars($ins['subject_name'] ?? 'N.D.') ?>
                            </p>

                            <div class="highlight-info">

                                <p>
                                    <span class="highlight-label">Venditore:</span><br>
                                    <strong>
                                        <?= htmlspecialchars($ins['name'] . ' ' . $ins['surname']) ?>
                                    </strong>
                                </p>

                                <p>
                                    <span class="highlight-label">Email:</span><br>
                                    <strong>
                                        <?= htmlspecialchars($ins['email']) ?>
                                    </strong>
                                </p>

                                <p>
                                    <span class="highlight-label">Scambio:</span><br>

                                    📍 <?= htmlspecialchars($ins['place']) ?><br>

                                    📅 <?= (new DateTime($ins['exchange_day']))->format('d/m/Y') ?><br>

                                    🕒 <?= (new DateTime($ins['exchange_day']))->format('H:i') ?>
                                </p>

                            </div>

                            <div class="book-price">
                                <?= number_format($ins['price'], 2, ',', '.') ?> €
                            </div>

                        </div>

                        <div class="custom-card-footer">

                            <a href="index.php?page=Viewlisting&action=details&id=<?= $ins['insertion_id'] ?>" 
                               class="btn-custom btn-outline-custom">
                                Vedi annuncio
                            </a>

                            <a href="index.php?page=personalArea&action=confirm_insertion&id=<?= $ins['insertion_id'] ?>" 
                               class="btn-custom btn-success-custom">
                                Conferma acquisto
                            </a>

                            <a href="mailto:<?= htmlspecialchars($ins['email']) ?>" 
                               class="btn-custom btn-outline-custom">
                                Contatta venditore
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>

</div>