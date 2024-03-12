<?php
// Connessione al database
$conn = mysqli_connect("localhost", "root", "", "interperfect");

// Verifica la connessione
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Verifica se sono state inviate le richieste GET
if(isset($_GET['linea_acquisto']) && isset($_GET['linea_assemblaggio']) && isset($_GET['linea_imballaggio'])) {
    // Ottieni i valori delle linee di produzione
    $linea_acquisto = mysqli_real_escape_string($conn, $_GET['linea_acquisto']);
    $linea_assemblaggio = mysqli_real_escape_string($conn, $_GET['linea_assemblaggio']);
    $linea_imballaggio = mysqli_real_escape_string($conn, $_GET['linea_imballaggio']);

    // Query per aggiornare i codici prodotto
    $sql_acquisto = "UPDATE linea_produzione SET Cod_Prodotto = '$linea_acquisto' WHERE Linea_Prod = 'L1'";
    $sql_assemblaggio = "UPDATE linea_produzione SET Cod_Prodotto = '$linea_assemblaggio' WHERE Linea_Prod = 'L2'";
    $sql_imballaggio = "UPDATE linea_produzione SET Cod_Prodotto = '$linea_imballaggio' WHERE Linea_Prod = 'L3'";

    // Esegui le query
    if(mysqli_query($conn, $sql_acquisto) && mysqli_query($conn, $sql_assemblaggio) && mysqli_query($conn, $sql_imballaggio)) {
        echo "<script>alert('Modifica avvenuta con successo');</script>";
        echo "<script>window.location = 'GestioneLinee.php';</script>";
    } else {
        echo "Errore durante l'aggiornamento: " . mysqli_error($conn);
    }
} else {
    echo "Tutte le linee di produzione devono essere specificate.";
}

// Chiudi la connessione al database
mysqli_close($conn);
?>
