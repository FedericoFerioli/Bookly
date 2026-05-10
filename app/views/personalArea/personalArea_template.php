<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .logo {
            height: 50px;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .nav-link {
            transition: 0.2s;
        }

        .nav-link:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #2e7d32;">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="index.php?page=main&action=index">
                <img src="../public/images/concept_logo_Bookly_only_logo.png" class="logo me-2" alt="Bookly">
                <strong>Bookly</strong>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=main&action=index">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=listings&action=all">Bacheca</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=personalArea&action=new_insertion">
                            Pubblica
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>
    
    <main class="container py-4">
        <?php include $view; ?>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© 2026 Bookly Project</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
