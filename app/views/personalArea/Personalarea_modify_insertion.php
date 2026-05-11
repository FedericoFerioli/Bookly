<?php 
if(!defined('APP')) die('Accesso negato'); 

$datiIsbn= $_SESSION['libro_precaricato'] ?? null;
$errore = $_SESSION['msg_errore'] ?? null;

unset($_SESSION['msg_errore']);
?>

<style>
    .edit-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .edit-card {
        background: #fff;
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    }

    .edit-title {
        font-size: 2rem;
        color: #007bff;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .isbn-box {
        background: #f8fbff;
        border: 1px solid #dbeafe;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .isbn-box legend {
        font-weight: 700;
        color: #2563eb;
        padding: 0 10px;
    }

    .isbn-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .full-width {
        grid-column: span 2;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: #fff;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 4px rgba(0,123,255,0.12);
    }

    input[readonly] {
        background: #f3f4f6;
        color: #6b7280;
    }

    small {
        margin-top: 5px;
        color: #6b7280;
    }

    .divider {
        margin: 35px 0;
        border: none;
        border-top: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 1.3rem;
        margin-bottom: 20px;
        color: #111827;
    }

    /* CONDIZIONI */
    .conditions-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
    }

    .condition-item {
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #ececec;
    }

    .condition-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .condition-item input[type="radio"] {
        margin-right: 8px;
        transform: scale(1.1);
    }

    .condition-item p {
        margin: 5px 0 0 28px;
        font-size: 0.9rem;
        color: #6b7280;
        line-height: 1.5;
    }

    /* BOTTONE */
    .btn-primary-custom {
        width: 100%;
        background: #007bff;
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
        background: #005ecb;
        transform: translateY(-2px);
    }

    .isbn-btn {
        background: #007bff;
        color: white;
        border: none;
        padding: 12px 18px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .isbn-btn:hover {
        background: #005ecb;
    }

    .error-message {
        color: #dc2626;
        font-weight: 600;
        margin-top: 10px;
    }

    @media (max-width: 768px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .full-width {
            grid-column: span 1;
        }

        .edit-card {
            padding: 25px;
        }

        .edit-title {
            font-size: 1.7rem;
        }
    }
</style>

<div class="edit-container">

    <div class="edit-card">

        <h3 class="edit-title">Modifica Inserzione</h3>

        <fieldset class="isbn-box">

            <legend>Cerca nel database tramite ISBN</legend>

            <form method="post" 
                  action="index.php?page=personalArea&action=search_isbn_for_modify&id=<?= $thisInsertion['insertion_id'] ?? '' ?>" 
                  class="isbn-form">

                <input type="text" 
                       name="isbn" 
                       placeholder="Inserisci ISBN..." 
                       value="<?= $datiIsbn['isbn'] ?? ($thisInsertion['isbn'] ?? '') ?>" 
                       required>

                <button type="submit" class="isbn-btn">
                    Cerca
                </button>

            </form>

            <?php if($errore): ?>
                <p class="error-message"><?= $errore ?></p>
            <?php endif; ?>

        </fieldset>

        <form method="post" 
              action="index.php?page=personalArea&action=change_insertion&insertion_id=<?= $thisInsertion['insertion_id'] ?? '' ?>">

            <input type="hidden" 
                   name="insertion_id" 
                   value="<?= $thisInsertion['insertion_id'] ?>">

            <input type="hidden" 
                   name="book_id" 
                   value="<?= $datiIsbn['book_id'] ?? ($thisInsertion['book_id'] ?? ''); ?>">

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>Titolo Libro</label>
                    <input type="text" 
                           name="title" 
                           value="<?= $datiIsbn['title'] ?? ($thisInsertion['title'] ?? ''); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label>Autore/i</label>
                    <input type="text" 
                           name="authors" 
                           value="<?= $datiIsbn['authors'] ?? ($thisInsertion['authors'] ?? ''); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label>Editore</label>
                    <input type="text" 
                           name="publisher" 
                           value="<?= $datiIsbn['publisher'] ?? ($thisInsertion['publisher'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label>Materia</label>
                    <input type="text" 
                           name="subject" 
                           value="<?= $datiIsbn['subject_name'] ?? ($thisInsertion['subject_name'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label>Prezzo Consigliato (€)</label>
                    <input type="text" 
                           name="original_price" 
                           value="<?= $datiIsbn['cover_price'] ?? ($thisInsertion['cover_price'] ?? ''); ?>" 
                           readonly>

                    <small>(Dato originale non modificabile)</small>
                </div>

            </div>

            <hr class="divider">

            <h4 class="section-title">Dati della tua vendita</h4>

            <div class="form-grid">

                <div class="form-group">
                    <label>Il tuo prezzo di vendita (€)</label>
                    <input type="number" 
                           step="0.01" 
                           name="my_price" 
                           value="<?= $thisInsertion['price'] ?? ''; ?>" 
                           required>
                </div>

                <div class="form-group full-width">

                    <label>Condizioni del libro</label>

                    <?php 
                    $current_cond = $thisInsertion['book_condition'] ?? ''; 
                    ?>

                    <div class="conditions-box">

                        <div class="condition-item">
                            <input type="radio" 
                                   id="cond_nuovo_c" 
                                   name="condition" 
                                   value="Nuovo con cartellino"
                                   <?= ($current_cond == 'Nuovo con cartellino') ? 'checked' : ''; ?> 
                                   required>

                            <label for="cond_nuovo_c">
                                <strong>Nuovo con cartellino</strong>
                            </label>

                            <p>
                                Mai usato, ancora nel cellophane originale o con etichetta dell'editore.
                            </p>
                        </div>

                        <div class="condition-item">
                            <input type="radio" 
                                   id="cond_nuovo_s" 
                                   name="condition" 
                                   value="Nuovo senza cartellino"
                                   <?= ($current_cond == 'Nuovo senza cartellino') ? 'checked' : ''; ?>>

                            <label for="cond_nuovo_s">
                                <strong>Nuovo senza cartellino</strong>
                            </label>

                            <p>
                                Mai usato, ma privo di confezione originale.
                            </p>
                        </div>

                        <div class="condition-item">
                            <input type="radio" 
                                   id="cond_ottimo" 
                                   name="condition" 
                                   value="ottime condizioni"
                                   <?= ($current_cond == 'ottime condizioni') ? 'checked' : ''; ?>>

                            <label for="cond_ottimo">
                                <strong>Ottimo stato</strong>
                            </label>

                            <p>
                                Letto con cura. Nessuna sottolineatura o piega evidente.
                            </p>
                        </div>

                        <div class="condition-item">
                            <input type="radio" 
                                   id="cond_leggero" 
                                   name="condition" 
                                   value="Leggermente usato"
                                   <?= ($current_cond == 'Leggermente usato') ? 'checked' : ''; ?>>

                            <label for="cond_leggero">
                                <strong>Leggermente usato</strong>
                            </label>

                            <p>
                                Qualche rara sottolineatura o piccoli segni di usura.
                            </p>
                        </div>

                        <div class="condition-item">
                            <input type="radio" 
                                   id="cond_usato" 
                                   name="condition" 
                                   value="usato"
                                   <?= ($current_cond == 'usato') ? 'checked' : ''; ?>>

                            <label for="cond_usato">
                                <strong>Usato / Segni di usura</strong>
                            </label>

                            <p>
                                Sottolineature, copertina vissuta o annotazioni ai margini.
                            </p>
                        </div>

                    </div>

                </div>

                <div class="form-group full-width">
                    <label>Descrizione</label>

                    <textarea name="description" 
                              rows="5" 
                              required><?= $thisInsertion['description'] ?? ''; ?></textarea>
                </div>

            </div>

            <div style="margin-top: 35px;">
                <button type="submit" class="btn-primary-custom">
                    SALVA MODIFICHE
                </button>
            </div>

        </form>

    </div>

</div>