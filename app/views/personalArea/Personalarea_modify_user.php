<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>
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
                <label class="form-label">E-mail universitaria</label>

                <input type="email" 
                       class="form-control" 
                       name="email"
                       value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                       pattern=".+@isit100\.fe\.it$"
                       required>

                <span class="input-hint">
                    È consentita solo una mail istituzionale @isit100.fe.it
                </span>
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