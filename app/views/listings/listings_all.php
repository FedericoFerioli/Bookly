<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>
    /* ── LAYOUT GENERALE ── */
    .listings-page {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 2rem;
        align-items: start;
    }

    /* ── SIDEBAR FILTRI ── */
    .filters-sidebar {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        position: sticky;
        top: 1rem;
    }

    .filters-sidebar h2 {
        font-size: 1rem;
        font-weight: 700;
        color: #1c1e21;
        margin: 0 0 1.2rem 0;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid #f0f2f5;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-group {
        margin-bottom: 1.4rem;
        padding-bottom: 1.4rem;
        border-bottom: 1px solid #f0f2f5;
    }

    .filter-group:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
    }

    .filter-group label.group-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: #65676b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.8rem;
    }

    /* Checkbox stilizzati */
    .check-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 0.5rem;
        cursor: pointer;
    }

    .check-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        margin-top: 2px;
        accent-color: #007bff;
        cursor: pointer;
        flex-shrink: 0;
    }

    .check-item .check-label {
        font-size: 0.9rem;
        color: #1c1e21;
        line-height: 1.4;
    }

    .check-item .check-desc {
        font-size: 0.78rem;
        color: #65676b;
        margin: 2px 0 0 0;
    }

    /* Select stilizzata */
    .filter-select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #1c1e21;
        background: #f8f9fa;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2365676b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
        transition: border-color 0.2s;
    }

    .filter-select:focus {
        outline: none;
        border-color: #007bff;
    }

    /* Range slider */
    .price-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }

    .price-label span {
        font-size: 0.8rem;
        font-weight: 700;
        color: #65676b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    #range-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #007bff;
        background: #e7f3ff;
        padding: 2px 8px;
        border-radius: 20px;
    }

    .slider-wrapper {
        position: relative;
        height: 40px;
    }

    .slider-wrapper input[type="range"] {
        position: absolute;
        width: 100%;
        pointer-events: none;
        -webkit-appearance: none;
        background: none;
        top: 8px;
    }

    .slider-track {
        position: absolute;
        top: 20px;
        width: 100%;
        height: 4px;
        background: #e0e0e0;
        border-radius: 5px;
    }

    input[type="range"]::-webkit-slider-thumb {
        pointer-events: auto;
        -webkit-appearance: none;
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background: #007bff;
        cursor: pointer;
        border: 2px solid #fff;
        box-shadow: 0 0 4px rgba(0,123,255,0.4);
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

    /* Bottoni filtro */
    .btn-filter {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-bottom: 0.5rem;
    }

    .btn-filter:hover {
        background-color: #0069d9;
    }

    .btn-reset {
        display: block;
        width: 100%;
        padding: 8px;
        text-align: center;
        text-decoration: none;
        color: #65676b;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-reset:hover {
        border-color: #007bff;
        color: #007bff;
    }

    /* ── AREA RISULTATI ── */
    .listings-main {}

    .listings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .listings-header h1 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 800;
        color: #1c1e21;
    }

    .listings-count {
        font-size: 0.85rem;
        background: #f0f2f5;
        color: #65676b;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* ── GRIGLIA CARD ── */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.2rem;
    }

    /* ── CARD ── */
    .book-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .card-img-wrapper {
        position: relative;
        height: 200px;
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
        overflow: hidden;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #bbb;
        gap: 4px;
    }

    .no-image-placeholder span { font-size: 2rem; }
    .no-image-placeholder p { font-size: 0.8rem; margin: 0; }

    .subject-tag {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        background: #e7f3ff;
        color: #1877f2;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        z-index: 1;
    }

    .photo-counter {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 0.75rem;
        background: rgba(0,0,0,0.55);
        color: #fff;
        padding: 2px 8px;
        border-radius: 10px;
    }

    .card-body {
        padding: 14px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 4px 0;
        color: #050505;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-subtitle {
        font-size: 0.82rem;
        color: #65676b;
        margin: 0 0 12px 0;
    }

    .card-price-row {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #28a745;
    }

    .condition-badge {
        font-size: 0.72rem;
        padding: 4px 9px;
        border-radius: 6px;
        font-weight: 600;
        background: #f2f3f5;
        color: #4b4f56;
        border: 1px solid #e0e0e0;
    }

    .card-footer {
        padding: 12px 14px;
        background: #fff;
        border-top: 1px solid #f0f2f5;
    }

    .btn-detail {
        display: block;
        width: 100%;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        color: #007bff;
        border: 2px solid #007bff;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.88rem;
        transition: all 0.2s;
        box-sizing: border-box;
    }

    .btn-detail:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* ── STATO VUOTO ── */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        color: #65676b;
    }

    .empty-state span { font-size: 3rem; display: block; margin-bottom: 1rem; }
    .empty-state p { font-size: 1rem; margin: 0; }

    /* ── RESPONSIVE ── */
    @media (max-width: 992px) {
        .listings-page { grid-template-columns: 1fr; }
        .filters-sidebar { position: static; }
        .cards-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
        .cards-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="listings-page">

    <!-- ══ SIDEBAR FILTRI ══ -->
    <aside class="filters-sidebar">
        <h2>🔍 Filtri</h2>

        <form method="post" action="index.php?page=listings&action=filter_insertion">

            <!-- Anno scolastico -->
            <div class="filter-group">
                <label class="group-label">Anno scolastico</label>
                <?php foreach(['PRIMA','SECONDA','TERZA','QUARTA','QUINTA'] as $classe): ?>
                    <label class="check-item">
                        <input type="checkbox" name="classes[]" value="<?= $classe ?>">
                        <span class="check-label"><?= ucfirst(strtolower($classe)) ?></span>
                    </label>
                <?php endforeach; ?>
            </div>

            <!-- Indirizzo -->
            <div class="filter-group">
                <label class="group-label">Indirizzo</label>
                <select name="course_id" class="filter-select">
                    <option value="">Tutti gli indirizzi</option>
                    <?php foreach($courses as $course): ?>
                        <option value="<?= $course['course_id'] ?>"><?= htmlspecialchars($course['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Materia -->
            <div class="filter-group">
                <label class="group-label">Materia</label>
                <select name="subject_id" class="filter-select">
                    <option value="">Tutte le materie</option>
                    <?php foreach($subjects as $subject): ?>
                        <option value="<?= $subject['subject_id'] ?>"><?= htmlspecialchars($subject['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Fascia di prezzo -->
            <div class="filter-group">
                <div class="price-label">
                    <span>Prezzo</span>
                    <span id="range-label"><?= $minPrice ?>€ - <?= $maxPrice ?>€</span>
                </div>
                <div class="slider-wrapper">
                    <div class="slider-track"></div>
                    <input type="range" name="price_min" id="input-min"
                        min="<?= $minPrice ?>" max="<?= $maxPrice ?>"
                        value="<?= $minPrice ?>" step="1">
                    <input type="range" name="price_max" id="input-max"
                        min="<?= $minPrice ?>" max="<?= $maxPrice ?>"
                        value="<?= $maxPrice ?>" step="1">
                </div>
            </div>

            <!-- Condizione -->
            <div class="filter-group">
                <label class="group-label">Condizione</label>

                <?php 
                $conditions = [
                    'Nuovo con cartellino'    => 'Mai usato, ancora nel packaging originale.',
                    'Nuovo senza cartellino'  => 'Mai usato, privo di confezione originale.',
                    'ottime condizioni'       => 'Nessuna sottolineatura o segno evidente.',
                    'Leggermente usato'       => 'Qualche raro segno di matita o usura lieve.',
                    'usato'                   => 'Sottolineature, copertina vissuta o annotazioni.',
                ];
                foreach($conditions as $value => $desc): ?>
                    <label class="check-item">
                        <input type="checkbox" name="condition[]" value="<?= htmlspecialchars($value) ?>">
                        <span class="check-label">
                            <?= htmlspecialchars($value) ?>
                            <p class="check-desc"><?= $desc ?></p>
                        </span>
                    </label>
                <?php endforeach; ?>
            </div>

            <!-- Editore -->
            <div class="filter-group">
                <label class="group-label">Editore</label>
                <select name="publisher" class="filter-select">
                    <option value="">Tutti gli editori</option>
                    <?php foreach($publishers as $p): ?>
                        <option value="<?= htmlspecialchars($p['publisher']) ?>">
                            <?= htmlspecialchars($p['publisher']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-filter">Applica filtri</button>
            <a href="index.php?page=listings&action=reset_filters" class="btn-reset">✕ Rimuovi filtri</a>

        </form>
    </aside>

    <!-- ══ AREA RISULTATI ══ -->
    <section class="listings-main">

        <div class="listings-header">
            <h1>Bacheca Annunci</h1>
            <span class="listings-count"><?= count($insertions) ?> libri disponibili</span>
        </div>

        <div class="cards-grid">
            <?php if(empty($insertions)): ?>
                <div class="empty-state">
                    <span>📚</span>
                    <p>Nessun annuncio trovato con i filtri selezionati.</p>
                </div>
            <?php else: ?>
                <?php foreach($insertions as $insertion): ?>
                    <div class="book-card">

                        <div class="card-img-wrapper">
                            <span class="subject-tag">
                                <?= htmlspecialchars($insertion['subject'] ?? $insertion['name'] ?? 'Materia') ?>
                            </span>

                            <?php if (!empty($insertion['images']) && isset($insertion['images'][0])): ?>
                                <img src="/ferioli/public/images/insertions/<?= htmlspecialchars(basename($insertion['images'][0])) ?>"
                                     alt="Copertina libro">
                                <?php if (count($insertion['images']) > 1): ?>
                                    <span class="photo-counter">📷 <?= count($insertion['images']) ?></span>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="no-image-placeholder">
                                    <span>📚</span>
                                    <p>Senza immagine</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title" title="<?= htmlspecialchars($insertion['title']) ?>">
                                <?= htmlspecialchars($insertion['title']) ?>
                            </h5>
                            <p class="card-subtitle">
                                di <?= htmlspecialchars($insertion['publisher'] ?? 'Editore sconosciuto') ?>
                            </p>
                            <div class="card-price-row">
                                <span class="card-price">
                                    <?= number_format($insertion['price'], 2, ',', '.') ?> €
                                </span>
                                <span class="condition-badge">
                                    <?= htmlspecialchars($insertion['book_condition'] ?? 'Usato') ?>
                                </span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="index.php?page=Viewlisting&action=details&id=<?= $insertion['insertion_id'] ?>"
                               class="btn-detail">
                                Vedi Dettagli
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </section>

</div>

<script>
    const minInput = document.getElementById('input-min');
    const maxInput = document.getElementById('input-max');
    const label    = document.getElementById('range-label');

    function updateRange() {
        let minVal = parseInt(minInput.value);
        let maxVal = parseInt(maxInput.value);
        if (minVal > maxVal) { minInput.value = maxVal; minVal = maxVal; }
        label.textContent = minVal + "€ - " + maxVal + "€";
    }

    minInput.addEventListener('input', updateRange);
    maxInput.addEventListener('input', updateRange);
</script>