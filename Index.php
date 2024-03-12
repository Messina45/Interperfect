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
                
                
//QUERY SELECT - TROVARE L'ID dallo USERNAME 
    $TrovaIDUtente ="SELECT ID_Utente FROM utente WHERE Username = '$username';";
    $ID_Utente = mysqli_query($conn, $TrovaIDUtente);
    if ($ID_Utente) {
        // Estrai il risultato come array associativo
        $row = mysqli_fetch_assoc($ID_Utente);
        
        // Se il risultato non è vuoto, assegna il prezzo alla variabile
        if ($row) {
            $ID_Utente = (int) $row['ID_Utente'];
        } else {
            // Se il risultato è vuoto, gestisci l'errore
            echo "Nessun risultato trovato.";
        }
    } else {
        // Se c'è stato un errore nella query, gestisci l'errore
        echo "Errore nella query: " . mysqli_error($conn);
    }

    
    //QUERY SELECT - Verificare se è un CEO 
    $TrovaDipendente ="SELECT Ruolo FROM dipendente WHERE ID_Utente = $ID_Utente;";
    $DIPENDENTE = mysqli_query($conn, $TrovaDipendente);
    if ($DIPENDENTE) {
        // Estrai il risultato come array associativo
        $row = mysqli_fetch_assoc($DIPENDENTE);
        
        // Se il risultato non è vuoto, assegna il prezzo alla variabile
        if ($row) {
            $DIPENDENTE = (string) $row['Ruolo'];
        } else {

        }
    } else {
        // Se c'è stato un errore nella query, gestisci l'errore
        echo "Errore nella query: " . mysqli_error($conn);
    }
}               
?>

</head>
<body onload="showSlides()">
    <div class="topnav">
        <a class="active" href="Index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="informazioni.php">Informazioni</a>
        <?php
        // Controlla se l'utente è loggato
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // L'utente è loggato, mostra il suo nome utente
            $username = $_SESSION['username']; // Ottieni il nome utente dalla sessione
            echo "<p>Benvenuto, $username!<a href='?logout=true'>Logout</a></p>"; // Link per il logout
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

        // Controlla se l'utente è dipendente
        if (isset($DIPENDENTE)) {
            if($DIPENDENTE == "CEO"){
                echo "<a href='GestioneLinee.php'>Gestione Linee</a>"; 
            }
        } 
                

        
        ?>
    </div>
    <br><br>

    <div class="logo">
        <img src="imgs/INTERLOGO.png" alt="Immagine">
        <p style="font-size: 24px;">INTERPERFECT</p>
    </div>

    
    <div class="front">
        <table>
            <tr>
                <td style="width: 50%;padding-right:20%">
                    <p>Presto il<br>lancio</p>
                    <p>La quintessenza della moda è pronta a ripartire in quinta marcia. . . LETTERALMENTE!</p>
                    <p>Visita il nuovo sito, innamorati dei nostri prodotti e striscia la carta!</p>
                </td>
                <td rowspan="3">
                <div class="slideshow-container">
                    <div class="mySlides fade">
                        <img src="imgs/foto1.jpg" style="width:100%">
                        <div class="caption">La perfezione è nel processo: la nostra maglietta, plasmata con precisione industriale, emerge come un capolavoro di design mentre viene plasmata dalla nostra avanzata macchina di produzione.</div>
                    </div>

                    <div class="mySlides fade">
                        <img src="imgs/foto2.jpg" style="width:100%">
                        <div class="caption">Libera la creatività con il taglio audace! La nostra maglietta, scolpita con passione e precisione, prende forma attraverso il taglio deciso di un artigiano determinato a creare un capo unico e sorprendente.</div>
                    </div>

                    <div class="mySlides fade">
                        <img src="imgs/foto3.jpg" style="width:100%">
                        <div class="caption">Alleanza di stile: presentiamo il prototipo del futuro, un jeans eccezionale nato dalla collaborazione con una rinomata casa di moda. Un'icona di eleganza e innovazione, realizzato con passione e dedizione.</div>
                    </div>

                </div>
                </td>
            </tr>
        </table>
    </div>
    
    <br><br><br>

    <div class="bottom">
        <p>SEGUICI SUI SOCIAL</p>
        <a href="https://www.instagram.com" target="_blank"><img src="imgs/instagram.png"></a>
        <a href="https://www.facebook.com" target="_blank"><img src="imgs/facebook.png"></a>
        <a href="https://www.twitter.com" target="_blank"><img src="imgs/twitter.png"></a>
    </div>
</body>

</html>