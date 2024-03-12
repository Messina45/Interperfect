<!DOCTYPE html>
<html lang="IT-it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InterPerfect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="topnav">
        <a href="Index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="informazioni.html">Informazioni</a>
        <?php
        // Avvia o riprende la sessione
        session_start();

        // Controlla se l'utente è loggato
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // L'utente è loggato, mostra il suo nome utente
            $username = $_SESSION['username']; // Ottieni il nome utente dalla sessione
            echo "<p>Benvenuto, $username! <a href='?logout=true'>Logout</a></p>"; // Link per il logout
        } else {
            // L'utente non è loggato, mostra il link per accedere
            echo "<a class='login' href='Login_Registrazione/InserisciLogin.php'>Login/Registrazione</a>";
        }

        if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
            
            session_destroy(); // Termina la sessione
            // Ciclo attraverso tutti i cookie e li elimino uno per uno
            foreach ($_COOKIE as $nome_cookie => $valore_cookie) {
                setcookie($nome_cookie, '', time() - 3600, '/'); // Imposta il cookie con un tempo di scadenza nel passato
            }
            echo "<script>alert('Hai effettuato il logout con successo!');</script>";
            header("Location: index.php"); // Reindirizza alla pagina di login
            exit();
        }

        ?>      
        </div>
        <br><br>

    <div class="logo">
        <img src="imgs/INTERLOGO.png" alt="Immagine">
        <p style="font-size: 24px;">INTERPERFECT</p>
    </div>
    
    <div class="CentroLogin">
        <img src="imgs/cartacredito.png" alt="Immagine">
        <h1>PAGAMENTO</h1>
        <br>
        <form method='POST' action="ControlloPagamento.php" onsubmit="return controllaInput();">
            <input type="text" id="numcarta" name="numcarta" placeholder="NUMERO CARTA" required>
            <br>
            <input type="password" id="cvv" name="cvv" placeholder="CVV" required>
            <br>
            <input type="text" id="scadenza" name="scadenza" placeholder="DATA SCADENZA" required>
            <br>
            <button type="submit" id="btn_accedi" name="btn_accedi">PAGA!!</button>
        </form>
        <br>
        <br style="padding-top: 30px;">
    </div>
    

    </body>
</html>