# Bookly

Bookly è un'applicazione web per l'acquisto di libri online, sviluppata come progetto scolastico. Permette agli utenti di sfogliare il catalogo, cercare libri e completare acquisti in modo semplice.

---

## Tecnologie utilizzate

- **PHP** 
- **MariaDB** — database relazionale
- **HTML / CSS / JavaScript** — frontend
- **Apache** — web server

---

## Requisiti

- PHP 8.0 o superiore
- MariaDB 10.5 o superiore
- Un server web

---

## Installazione

1. **Clona il repository**
   ```bash
   git clone https://github.com/FedericoFerioli/bookly.git
   cd bookly
   ```

2. **Configura il database**
   - Crea un database MariaDB chiamato `bookly`
   - Importa lo schema:
     ```bash
     mysql -u root -p bookly < docs/database.sql
     ```

3. **Configura la connessione al database**
   - Copia il file di configurazione di esempio:
     ```bash
     cp config/config.example.php config/config.php
     ```
   - Apri `config/config.php` e inserisci le tue credenziali:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'bookly');
     define('DB_USER', 'il_tuo_utente');
     define('DB_PASS', 'la_tua_password');
     ```

4. **Avvia il progetto**
   - Punta il server web alla cartella `public/`
   - Oppure con il server built-in di PHP:
     ```bash
     php -S localhost:8000 -t public/
     ```
   - Apri il browser su `http://localhost:8000`

---

## Struttura del progetto

```
bookly/
├── public/          ← File accessibili dal browser (index.php, CSS, JS)
├── src/             ← Logica dell'applicazione (funzioni, classi PHP)
├── config/          ← Configurazione database e costanti
├── docs/
│   ├── api/         ← Documentazione generata da phpDocumentor
│   └── database.sql ← Schema del database
└── README.md
```

---

## Funzionalità

- Visualizzazione inserzione degli utenti
- Filtraggio per diversi campi
- Scheda dettaglio libro
- Carrello e appuntamento
- Registrazione e login utenti
- Area personale

---

## Autori

Progetto sviluppato da:

- **Federico Ferioli** — [@FedericoFerioli](https://github.com/FedericoFerioli)
- **Christian Facchini** — [@Giemme5](https://github.com/Giemme5)
- **Majdoline El Kard** — [@majdo1ine](https://github.com/majdo1ine)
- **Riccardo Frabetti** — [@frabetti7949](https://github.com/frabetti7949)

---

## Licenza

Progetto scolastico — tutti i diritti riservati.
