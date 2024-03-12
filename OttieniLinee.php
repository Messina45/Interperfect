<?php
// Connessione al database
$conn = mysqli_connect("localhost", "root", "", "interperfect");

// Verifica la connessione
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Ottenere l'ID dell'elemento
$Num_Linea = $_GET['linea'];
$Linea = "L" .$Num_Linea;

// Query per selezionare i dati dalla tabella
$sql = "SELECT * FROM linea_produzione WHERE Linea_Prod = '$Linea';";

// Esegui la query
$result = mysqli_query($conn, $sql);

// Verifica se ci sono risultati
if (mysqli_num_rows($result) > 0) {
    // Prendi il primo risultato (presumibilmente c'è solo uno)
    $row = mysqli_fetch_assoc($result);
    // Converti i dati in formato JSON e restituisci
    echo json_encode($row);
} else {
    // Se non ci sono risultati, restituisci un oggetto vuoto
    echo json_encode(array());
}

// Chiudi la connessione al database
mysqli_close($conn);
?>