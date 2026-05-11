<?php defined('APP') or die('Accesso negato'); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly - Il tuo usato scolastico</title>
    <style>
        /* --- RESET E VARIABILI --- */
        :root {
            --primary: #007bff;
            --primary-hover: #0056b3;
            --bg-body: #f0f2f5;
            --white: #ffffff;
            --text-main: #1c1e21;
            --text-muted: #65676b;
            --border-color: #ddd;
            --shadow: 0 2px 10px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- HEADER E NAVBAR --- */
        header {
            background-color: var(--white);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-section h1 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--primary);
            font-weight: 800;
        }

        /* Gruppi di Navigazione */
        nav {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .nav-group {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            gap: 25px;
            align-items: center;
        }

        .nav-group a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            transition: var(--transition);
        }

        .nav-group a:hover, .nav-group a.active {
            color: var(--primary);
        }

        /* Bottone CTA Pubblica */
        .btn-pubblica {
            background-color: var(--primary);
            color: var(--white) !important;
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 0.8rem;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);
        }

        .btn-pubblica:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* --- CONTENUTO PRINCIPALE --- */
        main {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* --- FOOTER --- */
        footer {
            background-color: var(--white);
            border-top: 1px solid var(--border-color);
            padding: 2.5rem 1rem;
            text-align: center;
            margin-top: 4rem;
        }

        footer p {
            margin: 5px 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 900px) {
            .header-container { flex-direction: column; gap: 1rem; }
            nav { flex-direction: column; gap: 15px; }
            .nav-group { gap: 15px; }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <a href="index.php?page=main" class="logo-section">
                <img src="../public/images/concept_logo_Bookly_only_logo.png" alt="Logo Bookly" height="50">
                <h1>Bookly</h1>
            </a>

            <nav>
                <ul class="nav-group">
                    <li><a href="index.php?page=main" <?= (!isset($_GET['page']) || $_GET['page'] == 'main') ? 'class="active"' : '' ?>>Home</a></li>
                    <li><a href="index.php?page=listings&action=all" <?= (isset($_GET['page']) && $_GET['page'] == 'listings') ? 'class="active"' : '' ?>>Bacheca</a></li>
                    <li><a href="index.php?page=personalArea&action=new_insertion">Pubblica</a></li>
                </ul>

                <ul class="nav-group">
                    <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == true): ?>
                        <li>
                            <a href="index.php?page=personalArea&action=dashboard" <?= (isset($_GET['page']) && $_GET['page'] == 'personalArea') ? 'class="active"' : '' ?>>
                                Area Personale
                            </a>
                        </li>
                    <?php else: ?>
                        <li><a href="index.php?page=Login&action=login">Login</a></li>
                        <li><a href="index.php?page=Login&action=registration">Registrati</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php include $view; ?>
    </main>

    <footer>
        <div class="container">
            <p>Copyright © 2026 <strong>The Bookly Project</strong></p>
            <p style="font-size: 0.75rem; opacity: 0.7;">Sviluppato con &hearts; per facilitare lo studio tra studenti</p>
        </div>
    </footer>

</body>
</html>