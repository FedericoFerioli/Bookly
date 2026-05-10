<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly - Compravendita Libri</title>
    <style>
    /* RESET E BASE */
    body {
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        margin: 0;
        padding: 0;
        line-height: 1.6;
        background-color: #f0f2f5;
        color: #1c1e21;
    }

    /* HEADER */
    header {
        background-color: #fff;
        padding: 1rem 0;
        border-bottom: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .logo-section {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo-section h1 {
        margin: 0;
        font-size: 1.8rem;
        color: #007bff;
    }

    nav {
        display: flex;
        gap: 20px;
    }

    .nav-list {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
        gap: 15px;
    }

    .nav-list a {
        text-decoration: none;
        color: #4b4f56;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* MAIN CONTENT */
    main {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .hero-section {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* GRIGLIA ANNUNCI */
    .row {
        display: grid;
        /* Divide lo spazio in 3 colonne uguali che occupano il 100% della larghezza */
        grid-template-columns: 1fr 1fr 1fr; 
        gap: 30px; /* Aumentiamo un po' lo spazio tra le card visto che sono grandi */
        padding: 20px 0;
        width: 100%;
    }

    /* STILE CARD */
    .card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .card-header {
        padding: 12px 15px;
        background: #fff;
    }

    /* IMMAGINE COPERTINA */
    .card-img-top, .bg-light.d-flex {
        height: 350px; /* Aumentato per adattarsi alla larghezza maggiore */
        width: 100%;
        object-fit: contain;
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
    }

    /* CONTENUTI CARD */
    .card-body {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0 0 5px 0;
        color: #050505;
        /* Taglia il testo se troppo lungo */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-subtitle {
        font-size: 0.85rem;
        color: #65676b;
        margin-bottom: 15px;
    }

    /* PREZZO E BADGE */
    .mt-3.d-flex {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .text-success {
        color: #28a745 !important;
        font-weight: 800;
        font-size: 1.3rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .bg-info { background-color: #e7f3ff; color: #1877f2; }
    .bg-light { background-color: #f2f3f5; color: #4b4f56; border: none; }

    /* BOTTONE DETTAGLI */
    .card-footer {
        padding: 15px;
        background: #fff;
    }

    .btn-outline-primary {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        color: #007bff;
        border: 2px solid #007bff;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.2s;
        box-sizing: border-box;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* FOOTER */
    footer {
        text-align: center;
        padding: 2rem;
        color: #65676b;
        border-top: 1px solid #ddd;
        margin-top: 3rem;
    }

    /* Responsive: sotto i 992px passa a 2 colonne, sotto i 600px a 1 colonna */
    @media (max-width: 992px) {
        .row { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 600px) {
        .row { grid-template-columns: 1fr; }
        .card-img-top, .bg-light.d-flex { height: 250px; } /* Più basse su mobile */
    }
</style>
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo-section">
                <a href="index.php?page=main&action=index">
                    <img src="../public/images/concept_logo_Bookly_only_logo.png" alt="Logo Bookly" height="60" width="60">
                </a>
                <h1>Bookly</h1>
            </div>

            <nav>
                <ul class="nav-list">
                    <li><a href="index.php?page=main&action=index">HOME</a></li>
                    <li><a href="index.php?page=listings&action=all">BACHECA</a></li>
                    <li><a href="index.php?page=personalArea&action=new_insertion">PUBBLICA</a></li>
                </ul>
                <ul class="nav-list">
                    <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == true): ?>
                        <li><a href="index.php?page=personalArea&action=dashboard">AREA PERSONALE</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=Login&action=login">LOGIN</a></li>
                        <li><a href="index.php?page=Login&action=registration">REGISTRATI</a></li>
                    <?php endif; ?>
                </ul> 
            </nav>
        </div>
    </header>

    <main>
        <article class="hero-section">
            <h1>Cos'è Bookly?</h1>
            <p>Descrizione di Bookly: la piattaforma dedicata alla compravendita di libri usati per studenti e appassionati.</p>
        </article>

        <section class="latest-announces">
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-5 fw-bold text-primary">Annunci recenti</h1>
                </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach($threeListings as $insertion): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-light border-0 pt-3">
                        <span class="badge rounded-pill bg-info text-dark">
                            <?= htmlspecialchars($insertion['name'] ?? 'Materia N.D.') ?>
                        </span>
                    </div>

                    <?php if (!empty($insertion['images'])): ?>
                        <img src="/ferioli/public/images/insertions/<?= htmlspecialchars(basename($insertion['images'][0])) ?>" 
                            class="card-img-top"
                            alt="Copertina libro"
                            style="height: 180px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                            style="height: 180px;">
                            <span class="text-muted">Nessuna immagine</span>
                        </div>
                    <?php endif; ?>
                    
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
        </section>
    </main>

    <footer>
        <p>Copyright © 2026 The Bookly Project - Tutti i diritti riservati</p>
    </footer>

</body>
</html>