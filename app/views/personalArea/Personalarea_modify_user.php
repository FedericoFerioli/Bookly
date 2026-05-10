<?php 
if(!defined('APP')) die('Accesso negato'); 
?>


<form method="post" action="index.php?page=personalArea&action=change_user_info">
    <label class="form-label">Nome</label>
    <input type="text" class="form-control" name="name" value= <?= htmlspecialchars($user['name'] ?? '')?> required>
    <label class="form-label">Cognome</label>
    <input type="text" class="form-control" name="surname"
        value="<?= htmlspecialchars($user['surname'] ?? '') ?>" required>

    <label class="form-label">E-mail</label>
    <input type="email" class="form-control" name="email"
        value="<?= htmlspecialchars($user['email'] ?? '') ?>"
        pattern=".+@isit100\.fe\.it$" required>
    
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="passInput" required>


    <label class="form-label">Data di Nascita</label>
    <input type="date" class="form-control" name="dob"
        value="<?= htmlspecialchars($user['dob'] ?? '') ?>" required>

    <label class="form-label">Genere</label>
    <select class="form-select form-control" name="gender">
        <option value="M" <?= ($user['gender'] ?? '') === 'M' ? 'selected' : '' ?>>M</option>
        <option value="F" <?= ($user['gender'] ?? '') === 'F' ? 'selected' : '' ?>>F</option>
        <option value="O" <?= ($user['gender'] ?? '') === 'O' ? 'selected' : '' ?>>Altro</option>
    </select>

    <button type="submit" class="btn btn-red">Salva informazioni modificate</button>

    </form>
