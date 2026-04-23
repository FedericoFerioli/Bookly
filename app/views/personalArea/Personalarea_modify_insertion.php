<?php 
if(!defined('APP')) die('Accesso negato'); 

// Recuperiamo i dati: la priorità va al libro appena cercato via ISBN, 
// altrimenti usiamo i dati originali dell'inserzione caricati dal controller.
$datiIsbn= $_SESSION['libro_precaricato'] ?? null;
$errore = $_SESSION['msg_errore'] ?? null;

// Pulizia messaggi flash dopo la visualizzazione
unset($_SESSION['msg_errore']);
?>

<div>
    <h3>Modifica Inserzione</h3>

    <fieldset style="margin-bottom: 20px; padding: 15px;">
        <legend>Cerca nel database tramite ISBN</legend>
        <form method="post" action="index.php?page=personalArea&action=search_isbn_for_modify&id=<?= $thisInsertion['insertion_id'] ?? '' ?>">
            <input type="text" name="isbn" placeholder="Inserisci ISBN..." value="<?= $datiIsbn['isbn'] ?? ($thisInsertion['isbn'] ?? '') ?>" required>
            <button type="submit">Cerca</button>
        </form>
        <?php if($errore) echo "<p style='color:red'>$errore</p>"; ?>
    </fieldset>

    <hr>

    <form method="post" action="index.php?page=personalArea&action=change_insertion&insertion_id=<?= $thisInsertion['insertion_id'] ?? '' ?>">

        <input type="hidden" name="insertion_id" value="<?= $thisInsertion['insertion_id'] ?>">

        <input type="hidden" name="book_id" value="<?= $datiIsbn['book_id'] ?? ($thisInsertion['book_id'] ?? ''); ?>">
        
        <div>
            <label>Titolo Libro</label>
            <input type="text" name="title" value="<?= $datiIsbn['title'] ?? ($thisInsertion['title'] ?? ''); ?>" required>
        </div>

        <div>
            <label>Autore/i</label>
            <input type="text" name="authors" value="<?= $datiIsbn['authors'] ?? ($thisInsertion['authors'] ?? ''); ?>" required>
        </div>

        <div>
            <label>Editore</label>
            <input type="text" name="publisher" value="<?= $datiIsbn['publisher'] ?? ($thisInsertion['publisher'] ?? ''); ?>">
        </div>

        <div>
            <label>Materia</label>
            <input type="text" name="subject" value="<?= $datiIsbn['subject_name'] ?? ($thisInsertion['subject_name'] ?? ''); ?>">
        </div>

        <div>
            <label>Prezzo Consigliato (€)</label>
            <input type="text" name="original_price" value="<?= $datiIsbn['cover_price'] ?? ($thisInsertion['cover_price'] ?? ''); ?>" readonly>
            <small>(Dato originale non modificabile)</small>
        </div>

        <hr>
        <h4>Dati della tua vendita</h4>
        
        <div>
            <label>Il tuo prezzo di vendita (€)</label>
            <input type="number" step="0.01" name="my_price" value="<?= $thisInsertion['price'] ?? ''; ?>" required>
        </div>

        <div style="margin-top: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 10px;">Condizioni del libro:</label>
            
            <?php 
            $current_cond = $thisInsertion['book_condition'] ?? ''; 
            ?>

            <div style="margin-bottom: 10px;">
                <input type="radio" id="cond_nuovo_c" name="condition" value="Nuovo con cartellino" <?= ($current_cond == 'Nuovo con cartellino') ? 'checked' : ''; ?> required>
                <label for="cond_nuovo_c"><strong>Nuovo con cartellino</strong></label>
                <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Mai usato, ancora nel cellophane originale o con etichetta dell'editore.</p>
            </div>

            <div style="margin-bottom: 10px;">
                <input type="radio" id="cond_nuovo_s" name="condition" value="Nuovo senza cartellino" <?= ($current_cond == 'Nuovo senza cartellino') ? 'checked' : ''; ?>>
                <label for="cond_nuovo_s"><strong>Nuovo senza cartellino</strong></label>
                <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Mai usato, ma privo di confezione originale. Pagine intonse e copertina perfetta.</p>
            </div>

            <div style="margin-bottom: 10px;">
                <input type="radio" id="cond_ottimo" name="condition" value="ottime condizioni" <?= ($current_cond == 'ottime condizioni') ? 'checked' : ''; ?>>
                <label for="cond_ottimo"><strong>Ottimo stato</strong></label>
                <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Letto con cura. Nessuna sottolineatura, piega o segno evidente sulla copertina.</p>
            </div>

            <div style="margin-bottom: 10px;">
                <input type="radio" id="cond_leggero" name="condition" value="Leggermente usato" <?= ($current_cond == 'Leggermente usato') ? 'checked' : ''; ?>>
                <label for="cond_leggero"><strong>Leggermente usato</strong></label>
                <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Qualche rara sottolineatura a matita o piccoli segni di usura negli angoli.</p>
            </div>

            <div style="margin-bottom: 10px;">
                <input type="radio" id="cond_usato" name="condition" value="usato" <?= ($current_cond == 'usato') ? 'checked' : ''; ?>>
                <label for="cond_usato"><strong>Usato / Segni di usura</strong></label>
                <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Sottolineature (penna/evidenziatore), copertina vissuta o annotazioni ai margini.</p>
            </div>
        </div>

        <div>
            <label>Descrizione</label>
            <input type="text" name="description" value="<?= $thisInsertion['description'] ?? ''; ?>" required>
        </div>

        <div>      
            <label>Indirizzo (Corso)</label>
            <select name="course_id">
                <?php foreach($courses as $course): ?>
                    <option value="<?= $course['course_id']; ?>" 
                        <?= (isset($thisInsertion['course_id']) && $course['course_id'] == $thisInsertion['course_id']) ? 'selected' : ''; ?>>
                        <?= $course['name']; ?> 
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <?php if (isset($_SESSION['msg_errore_inserzione'])): ?>
            <p style="color: green; font-weight: bold;">
                <?php 
                    echo $_SESSION['msg_errore_inserzione']; 
                    unset($_SESSION['msg_errore_inserzione']); // Lo cancelliamo QUI
                ?>
            </p>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <button type="submit">SALVA MODIFICHE</button>
        </div>
    </form>
</div>