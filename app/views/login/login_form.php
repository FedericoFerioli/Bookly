<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow">
        <div class="card-body">

          <h3 class="text-center mb-4">Accesso</h3>

          <?php 
          // Usiamo $_GET perché il controller reindirizza con ?msg=error nell'URL
          if(isset($_GET['msg'])){
            if($_GET['msg'] == 'error'){
              echo '<div class="alert alert-danger">
                      Credenziali errate. Riprova.
                    </div>';
            }
          }
          ?>

          <form method="post" action="index.php?page=login&action=check">

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="esempio@email.it" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="********" required>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">
                Accedi
              </button>
            </div>

          </form>

          <hr>

          <div class="text-center mt-3">
            <a href="index.php?page=login&action=registration" class="text-decoration-none">
                Non hai un account? Registrati qui
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>