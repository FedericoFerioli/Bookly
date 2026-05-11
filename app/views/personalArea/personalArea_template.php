<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly - Area Personale</title>
    <style>
        /* RESET E BASE — identico a main_template */
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f0f2f5;
            color: #1c1e21;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            align-items: center;
        }

        .nav-list a {
            text-decoration: none;
            color: #4b4f56;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .nav-list a:hover {
            color: #007bff;
        }

        .nav-list a.active {
            color: #007bff;
        }

        /* MAIN CONTENT */
        main {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 1rem;
            box-sizing: border-box;
        }

        /* FOOTER — identico a main_template */
        footer {
            text-align: center;
            padding: 2rem;
            color: #65676b;
            border-top: 1px solid #ddd;
            margin-top: 3rem;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }

            nav {
                flex-direction: column;
                gap: 8px;
                align-items: center;
            }

            .nav-list {
                flex-wrap: wrap;
                justify-content: center;
            }
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
                        <li><a href="index.php?page=personalArea&action=dashboard" class="active">AREA PERSONALE</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=Login&action=login">LOGIN</a></li>
                        <li><a href="index.php?page=Login&action=registration">REGISTRATI</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php include $view; ?>
    </main>

    <footer>
        <p>Copyright © 2026 The Bookly Project - Tutti i diritti riservati</p>
    </footer>

</body>
</html>