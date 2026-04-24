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
        /* Reset minimo e font */
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Header e Navigazione */
        header {
            background-color: #f4f4f4;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
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
            color: #333;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .nav-list a:hover {
            color: #007bff;
        }

        /* Contenuto Principale */
        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .hero-section {
            margin-bottom: 3rem;
        }

        .latest-announces {
            background: #fafafa;
            padding: 1.5rem;
            border-radius: 8px;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem;
            font-size: 0.8rem;
            color: #777;
            border-top: 1px solid #eee;
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
                    <li><a href="index.php?page=personalArea&action=dashboard">AREA PERSONALE</a></li>
                    <li><a href="index.php?page=Login&action=login">LOGIN</a></li>
                    <li><a href="index.php?page=Login&action=registration">REGISTRATI</a></li>
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
            <h3>Annunci recenti</h3>
            <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">Bacheca Annunci</h1>
        <span class="badge bg-secondary"><?= count($threeListings) ?> libri disponibili</span>
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