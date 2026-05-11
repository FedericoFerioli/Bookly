<?php 
if(!defined('APP')) die('Accesso negato'); 
?>

<style>
    /* Sfondo e font coerenti con la Home e i Dettagli */
    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .registration-wrapper {
        max-width: 1200px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    /* Card Bianca coordinata */
    .custom-card {
        background: white;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: none;
    }

    /* Titolo in Blu Bookly */
    .form-heading {
        color: #007bff;
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* Stile Input chiari */
    .form-label {
        color: #555;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .form-control, .form-select {
        background-color: #fff !important;
        border: 1px solid #d1d8e0 !important;
        color: #333 !important;
        padding: 0.7rem;
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #007bff !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.1) !important;
    }

    /* Input group per la password */
    .input-group-text {
        background-color: #f8f9fa !important;
        border: 1px solid #d1d8e0 !important;
        color: #007bff !important;
        cursor: pointer;
        border-radius: 0 8px 8px 0 !important;
    }

    /* Bottone Blu coordinato con Home e Dettagli */
    .btn-bookly {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 0.8rem;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-bookly:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        color: white;
    }

    /* Link e Checkbox */
    .text-accent {
        color: #007bff !important;
    }

    .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<div class="registration-wrapper">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card custom-card">
                <div class="card-body p-4 p-md-5">
                    
                    <h2 class="text-center mb-4 form-heading">UNISCITI A BOOKLY</h2>
                    <p class="text-center text-muted mb-4 small">Crea il tuo account istituzionale per iniziare a scambiare libri.</p>
                    
                    <form method="post" action="index.php?page=login&action=store">
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" placeholder="Inserisci nome" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cognome</label>
                                <input type="text" class="form-control" name="surname" placeholder="Inserisci cognome" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Istituzionale</label>
                            <input type="email" class="form-control" name="email" 
                                   pattern=".+@isit100\.fe\.it$" 
                                   placeholder="nome.cognome@isit100.fe.it" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="passInput" required>
                                    <span class="input-group-text" onclick="togglePass('passInput', this)">👀</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Conferma Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="confirm_password" id="confirmInput" required>
                                    <span class="input-group-text" onclick="togglePass('confirmInput', this)">👀</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label">Data di Nascita</label>
                                <input type="date" class="form-control" name="dob" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Genere</label>
                                <select class="form-select" name="gender">
                                    <option value="M">Maschio</option>
                                    <option value="F">Femmina</option>
                                    <option value="O">Altro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label small text-muted" for="terms">
                                Accetto i <a href="#" class="text-decoration-none text-accent fw-bold">Termini e Condizioni</a> del servizio.
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-bookly">CREA ACCOUNT</button>
                        </div>

                    </form>

                    <div class="text-center mt-4">
                        <span class="small text-muted">Hai già un account? </span>
                        <a href="index.php?page=Login&action=login" class="small fw-bold text-decoration-none text-accent">Accedi ora</a>
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