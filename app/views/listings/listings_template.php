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
/* FOOTER */
        .main-footer {
            background-color: #ffffff;
            border-top: 1px solid #e0e0e0;
            padding: 3rem 0 1.5rem 0;
            margin-top: 4rem;
            color: #4b4f56;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1.5fr 1fr;
            gap: 40px;
            margin-bottom: 2rem;
        }

        .footer-column h3 {
            color: #1c1e21;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            text-transform: uppercase;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 0.6rem;
            font-size: 0.9rem;
        }

        .footer-column a {
            text-decoration: none;
            color: #65676b;
            transition: color 0.2s;
        }

        .footer-column a:hover {
            color: #007bff;
        }

        /* Stile speciale per la lista email */
        .team-list li {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #65676b;
            font-family: 'Courier New', Courier, monospace; /* Tocco tech per programmatori */
            font-size: 0.85rem !important;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .footer-logo img { height: 45px; }
        .footer-logo span { font-size: 1.6rem; font-weight: 800; color: #007bff; }

        .school-link a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 12px;
            background: #f0f7ff;
            color: #007bff;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .footer-bottom {
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
            text-align: center;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; gap: 30px; text-align: center; }
            .footer-logo, .team-list li { justify-content: center; }
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

<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-grid">
            
            <div class="footer-column brand-col">
                <div class="footer-logo">
                    <img src="../public/images/concept_logo_Bookly_only_logo.png" alt="Logo Bookly">
                    <span>Bookly</span>
                </div>
                <p>La piattaforma di compravendita libri creata dagli studenti per gli studenti dell'<strong>ISIT Bassi-Burgatti</strong>.</p>
                <div class="school-link">
                    <a href="https://www.isit100.fe.it/" target="_blank">
                        <i class="bi bi-link-45deg"></i> Sito Istituzionale ISIT
                    </a>
                </div>
            </div>

            <div class="footer-column">
                <h3>Sviluppatori</h3>
                <ul class="team-list">
                    <li><i class="bi bi-envelope"></i> ferioli.7941@isit100.fe.it</li>
                    <li><i class="bi bi-envelope"></i> facchini.7935@isit100.fe.it</li>
                    <li><i class="bi bi-envelope"></i> frabetti.7949@isit100.fe.it</li>
                    <li><i class="bi bi-envelope"></i> elkard.7926@isit100.fe.it</li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Naviga</h3>
                <ul>
                    <li><a href="index.php?page=main&action=index">Home</a></li>
                    <li><a href="index.php?page=listings&action=all">Bacheca</a></li>
                    <li><a href="index.php?page=personalArea&action=new_insertion">Vendi Libro</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>Copyright © 2026 <strong>The Bookly Project</strong> - ISIT Bassi-Burgatti (Cento)</p>
            <small>Progetto informatica</small>
        </div>
    </div>
</footer>

</body>
</html>