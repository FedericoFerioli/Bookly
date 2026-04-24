<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>
    :root {
        --dark-bg: #0b0b0b;
        --card-bg: #161616;
        --accent-red: #d90429;
        --hover-red: #ef233c;
        --text-bright: #ffffff;
        --text-soft: #adb5bd;
    }

    body {
        background-color: var(--dark-bg);
        color: var(--text-bright);
        font-family: 'Inter', sans-serif;
    }

    .custom-card {
        background-color: var(--card-bg);
        border: 1px solid #2d2d2d;
        border-radius: 1rem;
    }

    /* Sovrascriviamo Bootstrap per il tema Dark */
    .form-label {
        color: var(--text-soft);
        font-weight: 500;
    }

    .form-control {
        background-color: #222 !important;
        border: 1px solid #333 !important;
        color: white !important;
    }

    .form-control:focus {
        border-color: var(--accent-red) !important;
        box-shadow: 0 0 0 0.25 remote rgba(217, 4, 41, 0.25) !important;
    }

    /* Stile per l'input group (il tasto password) */
    .input-group-text {
        background-color: #333 !important;
        border: 1px solid #333 !important;
        color: var(--text-soft) !important;
        cursor: pointer;
    }

    .input-group-text:hover {
        color: var(--accent-red) !important;
    }

    .btn-red {
        background-color: var(--accent-red);
        border: none;
        color: white;
        padding: 0.8rem;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .btn-red:hover {
        background-color: var(--hover-red);
        color: white;
        transform: translateY(-1px);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            
            <div class="card custom-card shadow-lg">
                <div class="card-body p-4 p-md-5">
                    
                    <h2 class="text-center mb-4" style="color: var(--accent-red); font-weight: 800;">JOIN US</h2>
                    
                    <form method="post" action="index.php?page=login&action=store">
                        
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Cognome</label>
                                <input type="text" class="form-control" name="surname" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Istituzionale</label>
                            <input type="email" class="form-control" name="email" 
                                   pattern=".+@isit100\.fe\.it$" 
                                   placeholder="nome.cognome@isit100.fe.it" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="passInput" required>
                                <span class="input-group-text" onclick="togglePass('passInput', this)">
                                    <i class="bi bi-eye"></i> 👀
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Conferma Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="confirm_password" id="confirmInput" required>
                                <span class="input-group-text" onclick="togglePass('confirmInput', this)">
                                    <i class="bi bi-eye"></i> 👀
                                </span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label">Data di Nascita</label>
                                <input type="date" class="form-control" name="dob" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Genere</label>
                                <select class="form-select form-control" name="gender">
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                    <option value="O">Altro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label small" for="terms">
                                Accetto i <a href="#" class="text-decoration-none" style="color: var(--accent-red);">Termini e Condizioni</a>
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-red">REGISTRATI</button>
                        </div>

                    </form>

                    <div class="text-center mt-4">
                        <span class="small text-muted">Hai già un account? </span>
                        <a href="index.php?page=login" class="small fw-bold text-decoration-none" style="color: var(--accent-red);">Accedi</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function togglePass(id, btn) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        btn.innerHTML = "🙈";
    } else {
        input.type = "password";
        btn.innerHTML = "👀";
    }
}
</script>