<?php  
defined('APP') or die('Acceso negato');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB manager</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div>
        <header>
            <section class="nonloso">
                <div class="logo-container">
                    <a>
                        <img src="/public/images/concept_logo_Bookly_1.png" alt="Logo di Bookly" class="logo">
                    </a>
                </div>
                <div class="titles">
                    <div><h1>Bookly</h1></div>
                    <div><a href="index.php?page=main&action=index">HOME</a></div>
                    <div><a href="index.php?page=listings&action=all">BACHECA</a></div>
                    <div><a href="index.php?page=Personalarea&action=new_insertion">PUBBLICA</a></div>
                </div>
            </section>
    </header>
        <main>
            <section>
                <?php include $view?>
            </section>
        </main>
        <footer>
            <div>
                <p>Copyright© 2026 The Bookly Project</p>
            </div>
        </footer>
    </div>    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>