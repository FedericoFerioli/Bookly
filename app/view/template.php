<?php  
defined('APP') or die('Accesso negato');
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

<div class="container mt-4">

    <header class="mb-4">
        <h2>Gestione Database</h2>
    </header>

    <!-- MENU -->
    <nav class="mb-4">
        <a href="index.php?page=main&action=index" class="btn btn-primary me-2">
            Categorie
        </a>

        <a href="index.php?page=products&action=index" class="btn btn-success">
            Prodotti
        </a>
    </nav>

    <!-- MENU CRUD -->
    <nav class="mb-4">
        <ul class="nav nav-pills">

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=<?php echo $this->page ?>&action=index">
                    Home
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=<?php echo $this->page ?>&action=create">
                    Create
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=<?php echo $this->page ?>&action=delete">
                    Delete
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=<?php echo $this->page ?>&action=update">
                    Update
                </a>
            </li>

        </ul>
    </nav>

    <!-- TABELLA -->
    <section class="mb-4">
        <?php include 'table' . ucfirst($this->page) . '.php'; ?>
    </section>

    <!-- FORM -->
    <section>
        <?php 
        if(!empty($view)){
            include $view;
        }
        ?>
    </section>

</div>

<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
