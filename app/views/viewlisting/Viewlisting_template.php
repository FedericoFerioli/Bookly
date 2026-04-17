<?php defined('APP') or die('Accesso negato'); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly - Il tuo usato scolastico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; min-height: 100vh; display: flex; flex-direction: column; }
        main { flex: 1; }
        .navbar-brand img { height: 40px; }
        footer { background: #343a40; color: white; padding: 20px 0; margin-top: 40px; }
        .nav-link:hover { color: #0d6efd !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="/public/images/concept_logo_Bookly_1.png" alt="Logo" class="me-2">
                <span class="fw-bold fs-3 text-primary">Bookly</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-semibold">
                    <li class="nav-item"><a class="nav-link" href="index.php?page=main">HOME</a></li>
                    <li class="nav-item"><a class="nav-link text-primary" href="index.php?page=listings&action=all">BACHECA</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary rounded-pill px-4" href="index.php?page=Personalarea&action=new_insertion">
                            + PUBBLICA
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <?php include $view; ?>
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0 small opacity-75">Copyright © 2026 The Bookly Project - Made with &hearts; for students</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>