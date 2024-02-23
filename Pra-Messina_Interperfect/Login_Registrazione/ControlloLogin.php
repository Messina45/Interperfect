<?php
$conn = mysqli_connect("localhost", "root", "", "DB_prenotapanino");

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
    header("Refresh:0.1, url=InserisciLogin.html");
} else {
    $query = "SELECT * FROM users WHERE user='$user' && psw='$psw'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        print "errore nel comando";
        exit();
    }

    $riga = mysqli_fetch_array($result);
    if ($riga) {
        header("Location:../PaginaIniziale.html");
    } else {
        print "usename o password errate";
        echo '<script type="text/javascript">
       window.onload = function () { alert("Reindirizzamento al login"); }
    </script>';
        header("Refresh:0.1, url=InserisciLogin.php");
    }
}

mysqli_close($conn);