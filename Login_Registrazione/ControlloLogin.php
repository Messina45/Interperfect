<?php
$conn = mysqli_connect("localhost", "root", "", "interperfect");

if (!$conn) {
    print "errore nella connessione";
    exit();
}

$user = mysqli_real_escape_string($conn, $_POST["user"]);
$psw = mysqli_real_escape_string($conn, $_POST["psw"]);

if (!isset($user) || !isset($psw)) {
    echo '<script type="text/javascript">
       window.onload = function () { alert("Campi non inseriti correttamente"); }
    </script>';
    header("Refresh:0.1, url=InserisciLogin.php");
} else {
// Preparare la query con un prepared statement
$query = "SELECT * FROM utente WHERE Username=? AND PW=?";
$stmt = mysqli_prepare($conn, $query);

// Associare i valori ai parametri
mysqli_stmt_bind_param($stmt, "ss", $user, $psw);

// Eseguire la query
mysqli_stmt_execute($stmt);

// Ottenere il risultato della query
$result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        print "errore nel comando";
        exit();
    }

    $riga = mysqli_fetch_array($result);
    if ($riga) {
        // Avvia o riprende una sessione
        session_start();
        // Imposta le variabili di sessione per l'utente
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user;
        echo $_SESSION['username'];
        header("Location:../Index.php");
    } else {
        echo '<script type="text/javascript">
       window.onload = function () { alert("CREDENZIALI INVALIDE! Reindirizzamento al login"); }
    </script>';
        header("Refresh:0.1, url=InserisciLogin.php");
    }
}

mysqli_close($conn);