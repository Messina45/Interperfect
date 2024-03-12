<!DOCTYPE html>
<html lang="IT-it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InterPerfect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- DEFER-> serve per caricare lo script SOLO dopo che il DOM sia stato interamente caricato. (sennò non andava il form)-->
    <script src="script.js" defer></script>
    <?php 
    $conn=mysqli_connect("localhost","root","","interperfect");
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Avvia o riprende la sessione
    session_start();

    // Controlla se l'utente è loggato
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        // L'utente è loggato, mostra il suo nome utente
        $username = $_SESSION['username']; // Ottieni il nome utente dalla sessione
                
                
//QUERY SELECT - TROVARE L'ID dallo USERNAME 
    $TrovaIDUtente = "SELECT ID_Utente FROM utente WHERE Username = '$username';";
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
<body onload="OttieniLinee()">    
    <div class="topnav">
        <a href="Index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="informazioni.php">Informazioni</a>
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

        // Controlla se l'utente è dipendente
        if (isset($DIPENDENTE)) {
            if($DIPENDENTE == "CEO"){
                echo "<a class='active' href='GestioneLinee.php'>Gestione Linee</a>"; 
            }
        } else {
       }
        ?>
    </div>
    <br><br>

    <div class="logo">
        <img src="imgs/INTERLOGO.png" alt="Immagine">
        <p style="font-size: 24px;">INTERPERFECT</p>
    </div>
    <br>

    <div class="modificalinea" id="info_linee">
        <div class="toplinea">
            <h1>VIEW LINEE</h1>
            <img src="imgs/impostazioni.png" alt="Immagine">
        </div>
        <br><br>
        <table id="info_linee_table"></table>
    </div>

    <br><br><br><br>
    <form id="gestione_linee_form" action="ModificaLinee.php" method="get" >
        <div class="modificalinea"> 
            <div class="toplinea">
                <h1>MODIFICA LINEE</h1>
                <img src="imgs/modifica.png" alt="Immagine">
            </div>
            <br><br>
            <table>
                <tr>
                    <td><label for="linea_acquisto">Linea Acquisto - L1</label></td>
                    <td><input type="number" id="linea_acquisto" name="linea_acquisto" required min="1" max="3"></td>
                </tr>
                <tr>
                    <td><label for="linea_assemblaggio">Linea Assemblaggio/Produzione - L2</label></td>
                    <td><input type="number" id="linea_assemblaggio" name="linea_assemblaggio" required min="1" max="3"></td>
                </tr>
                <tr>
                    <td><label for="linea_imballaggio">Linea Imballaggio/Spedizione - L3</label></td>
                    <td><input type="number" id="linea_imballaggio" name="linea_imballaggio" required min="1" max="3"></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Modifica">
        </div>
    </form>
</body>
</html>