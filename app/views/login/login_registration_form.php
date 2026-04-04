<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow">
        <div class="card-body">

          <h3 class="text-center mb-4">Registrazione</h3>

          <?php 
          if(isset($_GET['msg'])){
            if($_GET['msg'] == 'error'){
              echo '<div class="alert alert-danger">
                      Errore nella registrazione. Controlla i dati inseriti.
                    </div>';
            }
          }
          ?>

          <form method="post" action="index.php?page=login&action=store">

            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Cognome</label>
              <input type="text" class="form-control" name="surname" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Conferma Password</label>
              <input type="password" class="form-control" name="confirm_password" required>
            </div>

            <div class="mb-3">
              <label class="form-label d-block">Genere</label>
              
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" checked>
                <label class="form-check-label" for="genderM">M</label>
              </div>
              
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderF" value="F">
                <label class="form-check-label" for="genderF">F</label>
              </div>
              
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="genderO" value="O">
                <label class="form-check-label" for="genderO">Altro</label>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Data di Nascita</label>
              <input type="date" class="form-control" name="dob" required>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="terms" required>
              <label class="form-check-label">
                Accetto i termini e condizioni
              </label>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">
                Registrati
              </button>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>