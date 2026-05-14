<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>

    /* ——— FLASH MESSAGES ——— */
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-icon {
        font-size: 1.1rem;
    }

    .alert-close {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: inherit;
        opacity: 0.6;
        line-height: 1;
        padding: 0;
        flex-shrink: 0;
    }

    .alert-close:hover {
        opacity: 1;
    }

    /* ——— USER INFO CARD ——— */
    .user-info-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 2.5rem;
    }

    .user-info-card-header {
        background-color: #007bff;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .user-info-card-header h4 {
        margin: 0;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
    }

    .header-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-header {
        text-decoration: none;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 700;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-header-light {
        background-color: #fff;
        color: #007bff;
    }

    .btn-header-light:hover {
        background-color: #e9f2ff;
    }

    .btn-header-outline {
        background-color: transparent;
        color: #fff;
        border: 2px solid rgba(255,255,255,0.7);
    }

    .btn-header-outline:hover {
        background-color: rgba(255,255,255,0.15);
    }

    .btn-header-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-header-danger:hover {
        background-color: #c82333;
    }

    .user-info-card-body {
        padding: 1.5rem;
    }

    .user-stats-grid {
        display: grid;
        grid-template-columns: 2fr 3fr 1fr 1fr;
        gap: 1rem;
    }

    .stat-box {
        padding: 1rem;
        border-radius: 10px;
        background: #f0f2f5;
    }

    .stat-box label {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #65676b;
        letter-spacing: 0.04em;
        margin-bottom: 4px;
    }

    .stat-box .stat-value {
        font-size: 1rem;
        font-weight: 700;
        color: #1c1e21;
        margin: 0;
    }

    .stat-box.text-center {
        text-align: center;
    }

    .stat-badge {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-top: 2px;
    }

    .stat-number {
        font-size: 1.4rem;
        font-weight: 800;
        color: #007bff;
    }

    /* ——— SEZIONE GESTIONE ANNUNCI ——— */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-header h3 {
        margin: 0 0 2px 0;
        font-size: 1.4rem;
        font-weight: 700;
        color: #1c1e21;
    }

    .section-header p {
        margin: 0;
        color: #65676b;
        font-size: 0.88rem;
    }

    .btn-primary-action {
        text-decoration: none;
        background-color: #007bff;
        color: #fff;
        padding: 10px 22px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.88rem;
        transition: background-color 0.2s;
        white-space: nowrap;
    }

    .btn-primary-action:hover {
        background-color: #0069d9;
    }

    /* ——— GRIGLIA ANNUNCI ——— */
    .insertions-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 24px;
    }

    /* ——— CARD ANNUNCIO ——— */
    .insertion-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .insertion-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    /* Immagine */
    .card-img-wrapper {
        height: 220px;
        background-color: #f0f2f5;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-bottom: 1px solid #eee;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .insertion-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }

    .subject-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        background-color: #007bff;
        color: #fff;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 2;
    }

    .photo-counter {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .no-image-placeholder {
        text-align: center;
        color: #65676b;
        padding: 1rem;
    }

    .no-image-placeholder span {
        font-size: 2rem;
        display: block;
        margin-bottom: 6px;
        opacity: 0.3;
    }

    /* Corpo card */
    .card-body {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 4px 0;
        color: #1c1e21;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .card-publisher {
        font-size: 0.82rem;
        color: #65676b;
        margin: 0 0 auto 0;
    }

    .card-price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .price-tag {
        font-size: 1.25rem;
        font-weight: 800;
        color: #28a745;
    }

    .condition-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        background-color: #f0f2f5;
        color: #4b4f56;
        border: 1px solid #ddd;
    }

    /* Footer card con bottoni */
    .card-footer {
        padding: 12px 15px;
        background: #fff;
        display: flex;
        flex-direction: column;
        gap: 8px;
        border-top: 1px solid #f0f0f0;
    }

    .btn-action {
        display: block;
        width: 100%;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        border-radius: 8px;
        transition: all 0.2s;
        box-sizing: border-box;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #fff3cd;
        color: #856404;
    }

    .btn-edit:hover {
        background-color: #ffeeba;
        color: #533f03;
    }

    .btn-delete {
        background-color: #f8d7da;
        color: #842029;
    }

    .btn-delete:hover {
        background-color: #f5c2c7;
        color: #58151c;
    }

    /* ——— STATO VUOTO ——— */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
    }

    .empty-state-icon {
        font-size: 3rem;
        opacity: 0.2;
        display: block;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #65676b;
        margin: 0 0 6px 0;
    }

    .empty-state p {
        color: #65676b;
        font-size: 0.9rem;
        margin: 0 0 1.5rem 0;
    }

    /* ——— RESPONSIVE ——— */
    @media (max-width: 992px) {
        .insertions-grid { grid-template-columns: 1fr 1fr; }
        .user-stats-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 600px) {
        .insertions-grid { grid-template-columns: 1fr; }
        .user-stats-grid { grid-template-columns: 1fr 1fr; }
        .card-img-wrapper { height: 180px; }
        .header-actions { display: none; } /* nasconde i bottoni su mobile piccolo */
    }
</style>

<!-- FLASH MESSAGES -->
    <?php if(isset($_SESSION['msg_modifica_success'])): ?>

        <div class="alert alert-success">
            ✓ <?= htmlspecialchars($_SESSION['msg_modifica_success']) ?>

            <button onclick="this.parentElement.remove()">X</button>
        </div>

        <?php unset($_SESSION['msg_modifica_success']); ?>

    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>

        <div class="alert alert-success">
            ✓ <?= htmlspecialchars($_SESSION['success']) ?>

            <button onclick="this.parentElement.remove()">X</button>
        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>
    
    


    <?php if(isset($_SESSION['msg_modifica_unsuccess'])): ?>
        <div class="alert alert-danger">
            ⚠ <?= htmlspecialchars($_SESSION['msg_modifica_unsuccess']) ?>
            <button onclick="this.parentElement.remove()">X</button>
        </div>

        <?php unset($_SESSION['msg_modifica_unsuccess']); ?>

    <?php endif; ?>

    <?php if(isset($_SESSION['msg_user_success'])): ?>

        <div class="alert alert-success">
            ✓ <?= htmlspecialchars($_SESSION['msg_user_success']) ?>

            <button onclick="this.parentElement.remove()">X</button>
        </div>

        <?php unset($_SESSION['msg_user_success']); ?>

    <?php endif; ?>
    
    <?php if(isset($_SESSION['msg_user_success'])): ?>

        <div class="alert alert-success">
            ✓ <?= htmlspecialchars($_SESSION['msg_user_success']) ?>

            <button onclick="this.parentElement.remove()">X</button>
        </div>

        <?php unset($_SESSION['msg_user_success']); ?>

    <?php endif; ?>


    <?php if(isset($_SESSION['msg_user_unsuccess'])): ?>
        <div class="alert alert-danger">
            ⚠ <?= htmlspecialchars($_SESSION['msg_user_unsuccess']) ?>
            <button onclick="this.parentElement.remove()">X</button>
        </div>

        <?php unset($_SESSION['msg_user_unsuccess']); ?>

    <?php endif; ?>

    <?php if(isset($_SESSION['err'])): ?>
        <div class="alert alert-danger">
            ⚠ <?= htmlspecialchars($_SESSION['err']) ?>
            <button onclick="this.parentElement.remove()">X</button>
        </div>

        <?php unset($_SESSION['err']); ?>
    <?php endif; ?>

<div class="user-info-card">
    <div class="user-info-card-header">
        <h4>Area Personale</h4>
        <div class="header-actions">
            <a href="index.php?page=personalArea&action=my_orders" class="btn-header btn-header-light">I Miei Ordini in corso</a>
            <a href="index.php?page=personalArea&action=view_completed_orders" class="btn-header btn-header-light">I Miei Ordini completati</a>
            <a href="index.php?page=personalArea&action=modify_user_info" class="btn-header btn-header-outline">Modifica le mie informazioni</a>
            <a href="index.php?page=Login&action=logout" class="btn-header btn-header-danger">Disconettiti</a>
        </div>
    </div>

    <div class="user-info-card-body">
        <div class="user-stats-grid">
            <div class="stat-box">
                <label>Nome e cognome</label>
                <p class="stat-value"><?= htmlspecialchars(($userData['name'] ?? '') . ' ' . ($userData['surname'] ?? '')) ?></p>
            </div>
            <div class="stat-box">
                <label>Email Account</label>
                <p class="stat-value"><?= htmlspecialchars($userData['email'] ?? 'N.D.') ?></p>
            </div>
            <div class="stat-box text-center">
                <label>Genere</label>
                <span class="stat-badge"><?= htmlspecialchars($userData['gender'] ?? 'N.D.') ?></span>
            </div>
            <div class="stat-box text-center">
                <label>Libri Attivi</label>
                <p class="stat-number"><?= count($insertions) ?></p>
            </div>
        </div>
    </div>
</div>

<!-- SEZIONE GESTIONE ANNUNCI -->
<div class="section-header">
    <div>
        <h3>Gestione Annunci</h3>
        <p>Visualizza, modifica o elimina i tuoi libri in vendita.</p>
    </div>
    <?php if (!empty($insertions)): ?>
        <a href="index.php?page=personalArea&action=new_insertion" class="btn-primary-action">+ Nuovo Annuncio</a>
    <?php endif; ?>
</div>

<div class="insertions-grid">
    <?php foreach($insertions as $insertion): ?>
        <div class="insertion-card">

            <div class="card-img-wrapper">
                <span class="subject-tag"><?= htmlspecialchars($insertion['subject'] ?? 'Materia') ?></span>

                <?php if (!empty($insertion['images']) && isset($insertion['images'][0])): ?>
                    <img src="/ferioli/public/images/insertions/<?= htmlspecialchars(basename($insertion['images'][0])) ?>" alt="Copertina">
                    <?php if (count($insertion['images']) > 1): ?>
                        <span class="photo-counter"><?= count($insertion['images']) ?> foto</span>
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
                <p class="card-publisher"><?= htmlspecialchars($insertion['publisher'] ?? 'Editore sconosciuto') ?></p>

                <div class="card-price-row">
                    <span class="price-tag"><?= number_format($insertion['price'], 2, ',', '.') ?> €</span>
                    <span class="condition-badge"><?= htmlspecialchars($insertion['book_condition'] ?? 'Usato') ?></span>
                </div>
            </div>

            <div class="card-footer">
                <a href="index.php?page=Viewlisting&action=details&id=<?= $insertion['insertion_id'] ?>" 
                   class="btn-action btn-edit">Gestisci Annuncio</a>
                <a href="index.php?page=personalArea&action=delete_insertion&id=<?= $insertion['insertion_id'] ?>" 
                   class="btn-action btn-delete"
                   onclick="return confirm('Sei sicuro di voler eliminare questo annuncio? L\'azione è irreversibile.')">Rimuovi</a>
            </div>

        </div>
    <?php endforeach; ?>

    <?php if (empty($insertions)): ?>
        <div style="grid-column: 1 / -1;">
            <div class="empty-state">
                <span class="empty-state-icon">📚</span>
                <h4>La tua bacheca è vuota</h4>
                <p>Inizia a vendere i tuoi libri usati ora!</p>
                <a href="index.php?page=personalArea&action=new_insertion" class="btn-primary-action">Crea Annuncio</a>
            </div>
        </div>
    <?php endif; ?>
</div>