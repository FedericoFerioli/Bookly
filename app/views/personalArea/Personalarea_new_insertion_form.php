<?php 
if(!defined('APP')) die('Accesso negato'); 

$dati = $_SESSION['new_libro_precaricato'] ?? null;
$errore = $_SESSION['msg_errore'] ?? null;
$errore_inserzione = $_SESSION['msg_modifica'] ?? null;

unset($_SESSION['new_libro_precaricato'], $_SESSION['msg_errore']);
?>

<style>
    /* CONTENITORE PRINCIPALE */
    .new-insertion-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .new-insertion-card {
        background: #fff;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    }

    .new-insertion-title {
        font-size: 2rem;
        color: #007bff;
        margin-bottom: 25px;
        font-weight: 700;
    }

    /* FIELDSET ISBN */
    .isbn-search-box {
        border: 1px solid #dbeafe;
        background: #f8fbff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .isbn-search-box legend {
        font-weight: 700;
        color: #007bff;
        padding: 0 10px;
    }

    .isbn-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* FORM */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group-full {
        grid-column: span 2;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea {
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
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

    /* SEZIONI */
    .section-divider {
        margin: 35px 0 25px;
        border: none;
        border-top: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 1.3rem;
        margin-bottom: 20px;
        color: #111827;
    }

    /* RADIO BUTTON */
    .conditions-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
    }

    .condition-item {
        margin-bottom: 18px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ececec;
    }

    .condition-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
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

    /* FOTO */
    .photos-box {
        background: #f9fafb;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 20px;
    }

    .photo-input {
        margin-bottom: 15px;
    }

    /* BOTTONE */
    .submit-btn,
    .isbn-btn {
        background: #007bff;
        color: white;
        border: none;
        padding: 14px 22px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .submit-btn:hover,
    .isbn-btn:hover {
        background: #005ecb;
        transform: translateY(-2px);
    }

    .submit-container {
        margin-top: 35px;
        text-align: center;
    }

    .submit-btn {
        width: 100%;
        font-size: 1rem;
    }

    /* MESSAGGI */
    .error-message {
        color: #dc2626;
        margin-top: 10px;
        font-weight: 600;
    }

    .success-message {
        background: #ecfdf5;
        color: #059669;
        padding: 15px;
        border-radius: 10px;
        margin-top: 20px;
        font-weight: 600;
        border: 1px solid #a7f3d0;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group-full {
            grid-column: span 1;
        }

        .new-insertion-card {
            padding: 25px;
        }

        .new-insertion-title {
            font-size: 1.7rem;
        }
    }
</style>

<div class="new-insertion-container">

    <div class="new-insertion-card">

        <h3 class="new-insertion-title">Nuova Inserzione</h3>

        <fieldset class="isbn-search-box">
            <legend>Cerca nel database tramite ISBN</legend>

            <form method="post" action="index.php?page=personalArea&action=search_isbn" class="isbn-form">
                <input type="text" 
                       name="isbn" 
                       placeholder="Inserisci ISBN..." 
                       value="<?php echo $dati['isbn'] ?? ''; ?>" 
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
              action="index.php?page=personalArea&action=save_insertion" 
              enctype="multipart/form-data">

            <input type="hidden" 
                   name="book_id" 
                   value="<?= $dati['book_id'] ?? '' ?>">

            <div class="form-grid">

                <div class="form-group form-group-full">
                    <label>Titolo Libro</label>
                    <input type="text" 
                           name="title" 
                           value="<?php echo $dati['title'] ?? ''; ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label>Autore/i</label>
                    <input type="text" 
                           name="authors" 
                           value="<?php echo $dati['authors'] ?? ''; ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label>Editore</label>
                    <input type="text" 
                           name="publisher" 
                           value="<?php echo $dati['publisher'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label>Materia</label>
                    <input type="text" 
                           name="subject" 
                           value="<?php echo $dati['name'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label>Prezzo Consigliato (€)</label>
                    <input type="text" 
                           name="original_price" 
                           value="<?php echo $dati['cover_price'] ?? ''; ?>" 
                           readonly>

                    <small>(Dato originale non modificabile)</small>
                </div>
            </div>

            <hr class="section-divider">

            <h4 class="section-title">Dati della tua vendita</h4>

            <div class="form-grid">

                <div class="form-group">
                    <label>Il tuo prezzo di vendita (€)</label>
                    <input type="number" 
                           step="0.01" 
                           name="my_price" 
                           required>
                </div>

                <div class="form-group form-group-full">
                    <label>Descrizione</label>
                    <textarea name="description" 
                              rows="4" 
                              required></textarea>
                </div>

                <div class="form-group form-group-full">
                    <label>Condizioni del libro</label>

                    <div class="conditions-box">

                        <div class="condition-item">
                            <input type="radio" 
                                   id="cond_nuovo_c" 
                                   name="condition" 
                                   value="Nuovo con cartellino" 
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
                                   value="Nuovo senza cartellino">

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
                                   value="ottime condizioni">

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
                                   value="Leggermente usato">

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
                                   value="usato">

                            <label for="cond_usato">
                                <strong>Usato / Segni di usura</strong>
                            </label>

                            <p>
                                Sottolineature, copertina vissuta o annotazioni ai margini.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="form-group form-group-full">
                    <label>Foto del libro (max 3)</label>

                    <div class="photos-box">

                        <div class="photo-input">
                            <label>Foto 1</label>
                            <input type="file" 
                                   name="images[]" 
                                   accept="image/*">
                        </div>

                        <div class="photo-input">
                            <label>Foto 2</label>
                            <input type="file" 
                                   name="images[]" 
                                   accept="image/*">
                        </div>

                        <div class="photo-input">
                            <label>Foto 3</label>
                            <input type="file" 
                                   name="images[]" 
                                   accept="image/*">
                        </div>

                    </div>
                </div>

            </div>

            <?php if (isset($_SESSION['msg_modifica'])): ?>
                <div class="success-message">
                    <?php 
                        echo $_SESSION['msg_modifica']; 
                        unset($_SESSION['msg_modifica']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="submit-container">
                <button type="submit" class="submit-btn">
                    PUBBLICA ANNUNCIO
                </button>
            </div>

        </form>

    </div>

</div>