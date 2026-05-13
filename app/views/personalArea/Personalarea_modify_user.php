<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>

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
    .profile-container {
        max-width: 700px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .profile-card {
        background: #fff;
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    }

    .profile-title {
        font-size: 2rem;
        font-weight: 700;
        color: #007bff;
        margin-bottom: 30px;
    }

    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
        font-size: 0.95rem;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        font-size: 0.95rem;
        background: #fff;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 4px rgba(0,123,255,0.12);
    }

    .input-hint {
        margin-top: 6px;
        font-size: 0.85rem;
        color: #6b7280;
    }

    .btn-save {
        margin-top: 10px;
        width: 100%;
        background: #007bff;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-save:hover {
        background: #005ecb;
        transform: translateY(-2px);
    }

    .password-note {
        background: #f8fbff;
        border: 1px solid #dbeafe;
        border-left: 4px solid #2563eb;
        padding: 12px 15px;
        border-radius: 10px;
        font-size: 0.9rem;
        color: #1e3a8a;
        margin-top: -10px;
    }

    @media (max-width: 768px) {

        .profile-card {
            padding: 25px;
        }

        .profile-title {
            font-size: 1.7rem;
        }
    }
</style>

<div class="profile-container">

    <div class="profile-card">

        <h2 class="profile-title">
            Modifica Profilo
        </h2>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                ⚠ <?= htmlspecialchars($_SESSION['error']) ?>
                <button onclick="this.parentElement.remove()">X</button>
            </div>

        <?php unset($_SESSION['error']); ?>

        <?php endif; ?>
    


        <form method="post" 
              action="index.php?page=personalArea&action=change_user_info"
              class="profile-form">

            <div class="form-group">
                <label class="form-label">Nome</label>

                <input type="text" 
                       class="form-control" 
                       name="name" 
                       value="<?= htmlspecialchars($user['name'] ?? '') ?>" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Cognome</label>

                <input type="text" 
                       class="form-control" 
                       name="surname"
                       value="<?= htmlspecialchars($user['surname'] ?? '') ?>" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">E-mail</label>

                <input type="email" 
                       class="form-control" 
                       name="email"
                       value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                       required>
            </div>

            <div class="form-group">

                <label class="form-label">Password</label>

                <input type="password" 
                       class="form-control" 
                       name="password" 
                       id="passInput">
                       
                <br>

                <div class="password-note">
                    Lascia vuoto se non vuoi modificare la password.
                </div>

            </div>

            <div class="form-group">
                <label class="form-label">Data di nascita</label>

                <input type="date" 
                       class="form-control" 
                       name="dob"
                       value="<?= htmlspecialchars($user['dob'] ?? '') ?>" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Genere</label>

                <select class="form-select" name="gender">

                    <option value="M" 
                        <?= ($user['gender'] ?? '') === 'M' ? 'selected' : '' ?>>
                        M
                    </option>

                    <option value="F" 
                        <?= ($user['gender'] ?? '') === 'F' ? 'selected' : '' ?>>
                        F
                    </option>

                    <option value="O" 
                        <?= ($user['gender'] ?? '') === 'O' ? 'selected' : '' ?>>
                        Altro
                    </option>

                </select>
            </div>

            <button type="submit" class="btn-save">
                Salva informazioni modificate
            </button>

        </form>

    </div>

</div>