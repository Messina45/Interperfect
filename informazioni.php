<!DOCTYPE html>
<html lang="IT-it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InterPerfect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <?php 
    $conn=mysqli_connect("localhost","root","","interperfect");


    // Avvia o riprende la sessione
    session_start();

    // Controlla se l'utente è loggato
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        // L'utente è loggato, mostra il suo nome utente
        $username = $_SESSION['username']; // Ottieni il nome utente dalla sessione
    }
?>
</head>
<body>
    <div class="topnav">
        <a href="Index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a class="active" href="informazioni.php">Informazioni</a>
        <?php
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
    <br>
    
    <div class="frontinfo">
        <h1>INTERPERFECT</h1>
        <br>
        <h3>“UN PUNTO DI RIFERIMENTO IMPRESCINDIBILE NEL MONDO DELLA MODA, ISPIRANDO E INFLUENZANDO GENERAZIONI DI APPASSIONATI DI MODA IN TUTTO IL MONDO”</h3>
        <br><br><br>
        
        <p>La quintessenza della moda, uno dei brand più di successo degl'ultimi vent'anni. 
            <br><br>
            Un marchio che ha saputo conquistare il cuore degli amanti dello stile con la sua eleganza senza tempo e la sua creatività senza confini. 
            <br><br>
            Ogni collezione è un'opera d'arte da indossare, capace di trasformare chiunque in una vera icona di stile.
        </p>
        <br><br>
    
        <p><strong>CONTATTI</strong>
            <br><br>
            Tel: +39 045-2155426
            <br><br>
            Mail: Interperfect@interprise.vr.it
            <br><br>
            Fax: AGGIORNATEVI!!!
        </p>
    </div>
</body>
</html>