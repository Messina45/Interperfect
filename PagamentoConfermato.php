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
        <a class="active" href="Index.php">Home</a>
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

        $conn=mysqli_connect("localhost","root","","interperfect");


        if(!$conn){
            print"errore nella connessione";
            exit();
        }

        //QUERY SELECT PER TROVARE L'ID DELL'ULTIMO ORDINE FATTO
        $TrovaDataSpedizione ="SELECT Data_Spedizione FROM ordine ORDER BY Num_Ordine DESC LIMIT 1;";
        $DataSpedizione= mysqli_query($conn, $TrovaDataSpedizione);
        if ($DataSpedizione) {
            // Estrai il risultato come array associativo
            $row = mysqli_fetch_assoc($DataSpedizione);
            
            // Se il risultato non è vuoto, assegna il prezzo alla variabile
            if ($row) {
                $DataSpedizione = (string) $row['Data_Spedizione'];
            } else {
                // Se il risultato è vuoto, gestisci l'errore
                echo "Nessun risultato trovato.";
            }
        } else {
            // Se c'è stato un errore nella query, gestisci l'errore
            echo "Errore nella query: " . mysqli_error($conn);
        }


        //QUERY SELECT PER TROVARE VIA,NOME, COGNOME DELL'UTENTE CHE HA EFFETTUATO L'ULTIMO ORDINE
        $TrovaInfo ="SELECT Via,Nome,Cognome FROM utente INNER JOIN ordine ON utente.ID_Utente=ordine.ID_Utente ORDER BY Num_Ordine DESC LIMIT 1;";
        $Info = mysqli_query($conn, $TrovaInfo);
        if ($Info) {
            // Estrai il risultato come array associativo
            $row = mysqli_fetch_assoc($Info);
            
            // Se il risultato non è vuoto, assegna il prezzo alla variabile
            if ($row) {
                $Indirizzo = (string) $row['Via'];
                $Nome = (string) $row['Nome'];
                $Cognome = (string) $row['Cognome'];
            } else {
                // Se il risultato è vuoto, gestisci l'errore
                echo "Nessun risultato trovato.";
            }
        } else {
            // Se c'è stato un errore nella query, gestisci l'errore
            echo "Errore nella query: " . mysqli_error($conn);
        }
        
        ?>
    </div>
    <br><br>

    <div class="logo">
        <img src="imgs/INTERLOGO.png" alt="Immagine">
        <p style="font-size: 24px;">INTERPERFECT</p>
    </div>

    
    <div class="conferma">
        <h1>PAGAMENTO CONFERMATO</h1>
        <p>Destinatario: <?php echo $Nome.' '.$Cognome?></p>
        <p>Indirizzo: <?php echo $Indirizzo?></p>
        <p>La spedizione avverrà entro il: <?php echo $DataSpedizione?></p>
        <br><br><br><br><br><br>
        <p style="font-size:19px;font-family:Garet;">Esperienze di stile senza limiti: ritrova l'eleganza, rinnova il tuo guardaroba. La moda che hai amato, pronta a stupirti di nuovo.<br> Entra nel tuo prossimo capitolo di stile con noi.</p>
        
    </div>
    
</body>
</html>