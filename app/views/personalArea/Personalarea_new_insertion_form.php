<?php 
if(!defined('APP')) die('Accesso negato'); 

// Recuperiamo i dati dalla sessione (se esistono)
$dati = $_SESSION['libro_precaricato'] ?? null;
$errore = $_SESSION['msg_errore'] ?? null;
$errore_inserzione = $_SESSION['msg_errore_inserzione'] ?? null;

// Puliamo subito la sessione così al prossimo refresh il form torna vuoto
unset($_SESSION['libro_precaricato']);
unset($_SESSION['msg_errore']);
?>

<div>
  <h3>Nuova Inserzione</h3>

  <fieldset style="margin-bottom: 20px; padding: 15px;">
    <legend>Cerca nel database tramite ISBN</legend>
    <form method="post" action="index.php?page=Personalarea&action=search_isbn">
        <input type="text" name="isbn" placeholder="Inserisci ISBN..." required>
        <button type="submit">Cerca</button>
    </form>
    <?php if($errore) echo "<p style='color:red'>$errore</p>"; ?>
  </fieldset>

  <hr>

  <form method="post" action="index.php?page=Personalarea&action=save_insertion">
    <div>
      <label>Titolo Libro</label>
      <input type="text" name="title" value="<?php echo $dati['title'] ?? ''; ?>" required>
    </div>

    <div>
      <label>bookid</label>
      <input type="text" name="authors" value="<?php echo $dati['authors'] ?? ''; ?>" readonly>
    </div>

    <div>
      <label>Autore/i</label>
      <input type="text" name="authors" value="<?php echo $dati['authors'] ?? ''; ?>" required>
    </div>

    <div>
      <label>Editore</label>
      <input type="text" name="publisher" value="<?php echo $dati['publisher'] ?? ''; ?>">
    </div>

    <div>
      <label>Materia</label>
      <input type="text" name="subject" value="<?php echo $dati['name'] ?? ''; ?>">
    </div>

    <div>
      <label>Prezzo Consigliato (€)</label>
      <input type="text" name="original_price" value="<?php echo $dati['price'] ?? ''; ?>" readonly>
      <small>(Dato originale non modificabile)</small>
    </div>

    <hr>
    <h4>Dati della tua vendita</h4>
    
    <div>
      <label>Il tuo prezzo di vendita (€)</label>
      <input type="number" step="0.01" name="my_price" required>
    </div>

    <div>
      <label>Condizioni del libro</label>
      <select name="condition">
          <option value="nuovo">Nuovo</option>
          <option value="ottimo">Ottimo stato</option>
          <option value="usato">Segni di usura</option>
      </select>
    </div>

    <div>
      <label>Description</label>
      <input type="text"  name="description" required>
    </div>

    <div>      
        <label>Indirizzo</label>
        <select name="course_id">
            <?php foreach($courses as $course): ?>
                <option value="<?= $course['course_id']; ?>"><?= $course['name']; ?> </option>
            <?php endforeach?>
    </div>

    <?php if($errore_inserzione) echo "<p style='color:red'>$errore_inserzione</p>"; ?>

    <div style="margin-top: 20px;">
      <button type="submit">PUBBLICA ANNUNCIO</button>
    </div>

  </form>
</div>