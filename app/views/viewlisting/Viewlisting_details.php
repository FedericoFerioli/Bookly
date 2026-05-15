<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>
    .details-wrapper {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1.5rem;
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 30px;
    }

    /* --- GALLERIA IMMAGINI --- */
    .gallery-container {
        background: var(--white);
        padding: 20px;
        border-radius: 15px;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
    }

    .main-image-preview {
        width: 100%;
        height: 450px;
        background: #f8f9fa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 15px;
        border: 1px solid #eee;
    }

    .main-image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .thumbnail-grid {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .thumb {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: var(--transition);
    }

    .thumb:hover { border-color: var(--primary); }

    /* --- INFO LIBRO --- */
    .book-main-info {
        background: var(--white);
        padding: 30px;
        border-radius: 15px;
        box-shadow: var(--shadow);
    }

    .book-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: var(--text-main);
        line-height: 1.2;
    }

    .book-author {
        font-size: 1.2rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    .info-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }

    .info-section h4 {
        color: var(--primary);
        margin-bottom: 1rem;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .specs-list {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .specs-list li {
        font-size: 0.95rem;
        color: var(--text-main);
    }

    .specs-list strong { color: var(--text-muted); font-weight: 600; margin-right: 5px; }

    /* --- SIDEBAR ACTION CARD --- */
    .action-card {
        background: var(--white);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        position: sticky;
        top: 100px;
        text-align: center;
        border: 1px solid var(--primary);
    }

    .price-tag {
        font-size: 2.5rem;
        font-weight: 800;
        color: #28a745;
        margin-bottom: 10px;
    }

    .seller-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .btn-contact {
        display: block;
        width: 100%;
        padding: 15px;
        background: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: var(--transition);
    }

    .btn-contact:hover {
        background: var(--primary-hover);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    }

    .btn-edit {
        display: block;
        width: 100%;
        padding: 12px;
        background: #fff;
        color: #ffc107;
        border: 2px solid #ffc107;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 700;
        transition: var(--transition);
    }

    .btn-edit:hover { background: #ffc107; color: #fff; }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .details-wrapper { grid-template-columns: 1fr; }
        .action-card { position: static; }
    }
</style>

<div class="details-wrapper">
    <div class="content-column">
        <div class="gallery-container">
            <div class="main-image-preview">
                <?php if (!empty($insertion['images'])): ?>
                    <img src="/ferioli/public/images/insertions/<?= htmlspecialchars(basename($insertion['images'][0])) ?>" id="mainImg" alt="Foto libro principale">
                <?php else: ?>
                    <span class="text-muted">Nessuna immagine disponibile</span>
                <?php endif; ?>
            </div>
            
            <?php if (count($insertion['images'] ?? []) > 1): ?>
                <div class="thumbnail-grid">
                    <?php foreach ($insertion['images'] as $img): ?>
                        <img src="/ferioli/public/images/insertions/<?= htmlspecialchars(basename($img)) ?>" 
                             class="thumb" 
                             onclick="document.getElementById('mainImg').src=this.src"
                             alt="miniatura libro">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="book-main-info">
            <h1 class="book-title"><?= htmlspecialchars($insertion['title']) ?></h1>
            <p class="book-author">di <strong><?= htmlspecialchars($insertion['authors']) ?></strong></p>
            
            <div class="info-section">
                <h4>Descrizione del venditore</h4>
                <p style="white-space: pre-line; color: #444; line-height: 1.8;">
                    <?= htmlspecialchars($insertion['description']) ?>
                </p>
            </div>

            <div class="info-section">
                <h4>Dettagli Tecnici</h4>
                <ul class="specs-list">
                    <li><strong>Editore:</strong> <?= htmlspecialchars($insertion['publisher'] ?? 'N.D.') ?></li>
                    <li><strong>Materia:</strong> <?= htmlspecialchars($insertion['subject_name'] ?? 'Generale') ?></li>
                    <li><strong>Condizioni:</strong> <?= htmlspecialchars($insertion['book_condition']?? '') ?></li>
                </ul>
            </div>
        </div>
    </div>

    <aside class="sidebar-column">
        <div class="action-card">
            <div class="price-tag">
                <?= number_format($insertion['price'], 2, ',', '.') ?> €
            </div>
            
            <div class="seller-info">
                <p class="small text-muted" style="margin-bottom: 5px;">Venduto da</p>
                <p style="font-weight: 700; margin: 0; font-size: 1.1rem;">
                    <?= htmlspecialchars($insertion['name']) ?> <?= htmlspecialchars($insertion['surname']) ?>
                </p>
            </div>

            <?php if($insertion['insertion_state'] == 'reserved'): ?>
                <a >
                    Questo libro sta venendo venduto
                </a>
            <?php elseif(in_array((int)$insertion['insertion_id'], $myInsertions)): ?>
                <a href="index.php?page=personalArea&action=modify_insertion&id=<?= $insertion['insertion_id'] ?>" 
                   class="btn-edit">
                    Modifica Inserzione
                </a>
            <?php elseif($insertion['insertion_state'] == 'selling'): ?>
                <a href="index.php?page=Viewlisting&action=buy&id=<?= $insertion['insertion_id'] ?>"
                   class="btn-contact">
                    Contatta il venditore
                </a>

            <?php endif; ?>
        </div>
    </aside>

</div>