<?php 
if(!defined('APP')) die('Accesso negato'); 
?>


<a href="index.php?page=listings&action=reset_filters">Rimuovi filtri</a>



<form method="post"  action="index.php?page=listings&action=filter_insertion">
<!-- selezione anno: prima seconda ecc -->
<div style="margin-top: 15px;">
    <label style="font-weight: bold; display: block; margin-bottom: 10px;">Anni scolastici:</label>
    
    <div style="display: flex; flex-direction: column; gap: 5px;">
        <label>
            <input type="checkbox" name="classes[]" value="PRIMA"> Prima
        </label>
        
        <label>
            <input type="checkbox" name="classes[]" value="SECONDA"> Seconda
        </label>
        
        <label>
            <input type="checkbox" name="classes[]" value="TERZA"> Terza
        </label>
        
        <label>
            <input type="checkbox" name="classes[]" value="QUARTA"> Quarta
        </label>
        
        <label>
            <input type="checkbox" name="classes[]" value="QUINTA"> Quinta
        </label>
    </div>
</div>
<!-- selezione indirizzo, prendiamo $courses da il controller che esegue la query quando entriamo nella pagina -->
    <div>      
        <label>Indirizzo</label>
        <select name="course_id">
            <option value="">Tutti gli indirizzi </option>
            <?php foreach($courses as $course): ?>
                <option value="<?= $course['course_id']; ?>"><?= $course['name']; ?> </option>
            <?php endforeach?>
        </select>
    </div>

<!-- materia -->
     <div>      
        <label>Materia</label>
        <select name="subject_id">
            <option value="">Tutte le materie </option>
            <?php foreach($subjects as $subject): ?>
                <option value="<?= $subject['subject_id']; ?>"><?= $subject['name']; ?> </option>
            <?php endforeach?>
        </select>
    </div>

<!-- range di prezzo -->

        <div class="price-range-container" style="max-width: 400px; margin: 20px 0; font-family: sans-serif;">
            <label style="font-weight: bold; display: block; margin-bottom: 10px;">Fascia di prezzo: 
                <span id="range-label"><?php echo $minPrice?>€ - <?php echo $maxPrice?>€</span>
            </label>
            
            <div class="slider-wrapper" style="position: relative; height: 40px;">
                <input type="range" name="price_min" id="input-min" min="<?php echo $minPrice?>" max="<?php echo $maxPrice?>" value="<?php echo $minPrice?>" step="1" 
                    style="position: absolute; width: 100%; pointer-events: none; -webkit-appearance: none; background: none;">
                
                <input type="range" name="price_max" id="input-max" min="<?php echo $minPrice?>" max="<?php echo $maxPrice?>" value="<?php echo $maxPrice?>" step="1" 
                    style="position: absolute; width: 100%; pointer-events: none; -webkit-appearance: none; background: none;">
                
                <div class="slider-track" style="position: absolute; top: 15px; width: 100%; height: 5px; background: #ddd; border-radius: 5px; z-index: -1;"></div>
            </div>
        </div>

        <style>
            /* Rende i pallini cliccabili nonostante il pointer-events: none sul resto */
            input[type="range"]::-webkit-slider-thumb {
                pointer-events: auto;
                -webkit-appearance: none;
                height: 18px;
                width: 18px;
                border-radius: 50%;
                background: #007bff;
                cursor: pointer;
                border: 2px solid #fff;
                box-shadow: 0 0 2px rgba(0,0,0,0.5);
            }
            input[type="range"]::-moz-range-thumb {
                pointer-events: auto;
                height: 18px;
                width: 18px;
                border-radius: 50%;
                background: #007bff;
                cursor: pointer;
                border: 2px solid #fff;
            }
        </style>

        <script>
            const minInput = document.getElementById('input-min');
            const maxInput = document.getElementById('input-max');
            const label = document.getElementById('range-label');

            function updateRange() {
                let minVal = parseInt(minInput.value);
                let maxVal = parseInt(maxInput.value);

                // Impedisce che il minimo superi il massimo
                if (minVal > maxVal) {
                    let tmp = minVal;
                    minInput.value = maxVal;
                    minVal = maxVal;
                }

                label.innerHTML = minVal + "€ - " + maxVal + "€";
            }

            minInput.addEventListener('input', updateRange);
            maxInput.addEventListener('input', updateRange);
        </script>
<!-- Condizione -->
<div style="margin-top: 15px;">
    <label style="font-weight: bold; display: block; margin-bottom: 10px;">Condizioni del libro:</label>
    
    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="cond_nuovo_c" name="condition[]" value="Nuovo con cartellino">
        <label for="cond_nuovo_c"><strong>Nuovo con cartellino</strong></label>
        <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Mai usato, ancora nel cellophane originale o con etichetta dell'editore.</p>
    </div>

    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="cond_nuovo_s" name="condition[]" value="Nuovo senza cartellino">
        <label for="cond_nuovo_s"><strong>Nuovo senza cartellino</strong></label>
        <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Mai usato, ma privo di confezione originale. Pagine intonse e copertina perfetta.</p>
    </div>

    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="cond_ottimo" name="condition[]" value="ottime condizioni">
        <label for="cond_ottimo"><strong>Ottimo stato</strong></label>
        <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Letto con cura. Nessuna sottolineatura, piega o segno evidente sulla copertina.</p>
    </div>

    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="cond_leggero" name="condition[]" value="Leggermente usato">
        <label for="cond_leggero"><strong>Leggermente usato</strong></label>
        <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Qualche rara sottolineatura a matita o piccoli segni di usura negli angoli.</p>
    </div>

    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="cond_usato" name="condition[]" value="usato">
        <label for="cond_usato"><strong>Usato / Segni di usura</strong></label>
        <p style="margin: 0 0 5px 25px; font-size: 0.9em; color: #666;">Sottolineature (penna/evidenziatore), copertina vissuta o annotazioni ai margini.</p>
    </div>
</div>
<!-- publishers -->
 <select name="publisher">
    <option value="">Tutti gli editori</option>
    <?php foreach($publishers as $p): ?>
        <option value="<?= htmlspecialchars($p['publisher']) ?>">
            <?= htmlspecialchars($p['publisher']) ?>
        </option>
    <?php endforeach; ?>

</select>
    <button type="submit">
        Filtra
    </button>

</form>
<!-- fine form -->

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">Bacheca Annunci</h1>
        <span class="badge bg-secondary"><?= count($insertions) ?> libri disponibili</span>
    </div>


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach($insertions as $insertion): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-light border-0 pt-3">
                        <span class="badge rounded-pill bg-info text-dark">
                            <?= htmlspecialchars($insertion['name'] ?? 'Materia N.D.') ?>
                        </span>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title text-truncate fw-bold" title="<?= $insertion['title'] ?>">
                            <?= htmlspecialchars($insertion['title']) ?>
                        </h5>
                        <p class="card-subtitle mb-2 text-muted small">
                            di <?= htmlspecialchars($insertion['publisher'] ?? 'Editore sconosciuto') ?>
                        </p>

                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="fs-4 fw-bold text-success">
                                <?= number_format($insertion['price'], 2, ',', '.') ?> €
                            </span>
                            <span class="badge bg-light text-dark border">
                                <?= htmlspecialchars($insertion['book_condition'] ?? 'Usato') ?>
                            </span>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-top-0 pb-3">
                            <a href="index.php?page=Viewlisting&action=details&id=<?= $insertion['insertion_id'] ?>"
                                class="btn btn-outline-primary w-100">
                                Vedi Dettagli
                            </a>                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>