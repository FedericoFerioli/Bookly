<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<h3>Login</h3>

<?php 
if(isset($_POST['msg'])){
  if($_POST['msg'] == 'error'){
    echo "<h1>errore, corrispondenza non trovata</h1>";
  }
}

?>


<form method="post" action="index.php?page=login&action=check">
  <label>email</label><br>
  <input type="text" name="email" required><br><br>

  <label>Password</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit">Accedi</button>
</form>

<a href="index.php?page=Login&action=registration">Ti vuoi registrare?</a>