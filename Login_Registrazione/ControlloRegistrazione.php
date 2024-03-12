<?php


$conn=mysqli_connect("localhost","root","","interperfect");


if(!$conn){


    print"errore nella connessione";
    exit();
}


$user=$_POST["username"];
$psw=$_POST["conf_pw"];
$nome=$_POST["nome"];
$cognome=$_POST["cognome"];
$citta=$_POST["citta"];
$via=$_POST["via"];
$cod_postale=$_POST["cod_postale"];
$tel=$_POST["tel"];

if(isset($user)){
    // Query per controllare se $user è presente nel database
    $sql = "SELECT Username FROM utente WHERE Username = '$user'";
    $result = $conn->query($sql);

    // Verifica se ci sono righe restituite
    if ($result->num_rows > 0) {
        echo '<script type="text/javascript"> window.onload = function () { alert("Username già utilizzato!");}    </script>';
        header("Refresh:0.1, url=InserisciRegistrazione.php");
    } else {
        // Preparare la query con un prepared statement
        $query = "INSERT INTO utente (Username, PW, Nome, Cognome, Citta, Via, Cod_Postale, Telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        // Associare i valori ai parametri
        mysqli_stmt_bind_param($stmt, "ssssssss", $user, $psw, $nome, $cognome, $citta, $via, $cod_postale, $tel);

        // Eseguire la query
        $result = mysqli_stmt_execute($stmt);


        if(!$result){
            print "errore nell'inserimento";
        }
        else{
            echo '<script type="text/javascript">
            window.onload = function () { alert("Registrazione avvunta con successo"); }
            </script>';
            header("Refresh:0.1, url=InserisciLogin.php");
        }
    }
}



mysqli_close($conn);

?>