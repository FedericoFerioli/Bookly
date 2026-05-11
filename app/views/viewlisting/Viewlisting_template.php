<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly - Il tuo usato scolastico</title>
    
    <style>
        /* --- VARIABILI E RESET --- */
        :root {
            --primary: #007bff;
            --primary-hover: #0056b3;
            --bg-body: #f0f2f5;
            --white: #ffffff;
            --text-main: #1c1e21;
            --text-muted: #65676b;
            --border-color: #ddd;
            --shadow: 0 2px 10px rgba(0,0,0,0.08);
            --radius: 12px;
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

        /* --- HEADER --- */
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

        /* NAVIGAZIONE */
        nav {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-group {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            gap: 20px;
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

        /* Bottone speciale */
        .btn-cta {
            background-color: var(--primary);
            color: var(--white) !important;
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 0.8rem;
        }

        .btn-cta:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* --- CONTENUTO (MAIN) --- */
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
            padding: 2rem 1rem;
            text-align: center;
            margin-top: 4rem;
        }

        footer p {
            margin: 5px 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* --- UTILITY CLASSES (Sostituiscono le basi di Bootstrap nelle View) --- */
        .container { max-width: 1200px; margin: 0 auto; }
        
        /* Griglia base per le card o le colonne */
        .row { 
            display: flex; 
            flex-wrap: wrap; 
            margin: -15px; 
        }
        
        .col-8 { flex: 0 0 66.66%; padding: 15px; }
        .col-4 { flex: 0 0 33.33%; padding: 15px; }

        .card {
            background: var(--white);
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            padding: 20px;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid transparent;
        }
        .alert-success { background: #d4edda; color: #155724; border-color: #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border-color: #f5c6cb; }

        /* --- RESPONSIVE --- */
        @media (max-width: 900px) {
            .header-container { flex-direction: column; gap: 1rem; }
            nav { flex-direction: column; gap: 15px; }
            .col-8, .col-4 { flex: 0 0 100%; }
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
        <p>Copyright © 2026 <strong>The Bookly Project</strong></p>
        <p style="font-size: 0.75rem; opacity: 0.8;">Made for students with passion</p>
    </footer>

</body>
</html>