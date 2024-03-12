<?php


$conn=mysqli_connect("localhost","root","","interperfect");


if(!$conn){


    print"errore nella connessione";
    exit();
}

session_start();
$username = $_SESSION['username'];
echo $username;

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

//QUERY SELECT - Prezzo prodotti 
$Query_PrezzoFelpa ="SELECT Prezzo FROM prodotto WHERE Cod_Prodotto = 1;";
$PrezzoFelpa = mysqli_query($conn, $Query_PrezzoFelpa);
if ($PrezzoFelpa) {
    // Estrai il risultato come array associativo
    $row = mysqli_fetch_assoc($PrezzoFelpa);
    
    // Se il risultato non è vuoto, assegna il prezzo alla variabile
    if ($row) {
        $PrezzoFelpa = (float) $row['Prezzo'];
    } else {
        // Se il risultato è vuoto, gestisci l'errore
        echo "Nessun risultato trovato.";
    }
} else {
    // Se c'è stato un errore nella query, gestisci l'errore
    echo "Errore nella query: " . mysqli_error($conn);
}

$Query_PrezzoBraghe ="SELECT Prezzo FROM prodotto WHERE Cod_Prodotto = 2;";
$PrezzoBraghe = mysqli_query($conn, $Query_PrezzoBraghe);
if ($PrezzoBraghe) {
    // Estrai il risultato come array associativo
    $row = mysqli_fetch_assoc($PrezzoBraghe);
    
    // Se il risultato non è vuoto, assegna il prezzo alla variabile
    if ($row) {
        $PrezzoBraghe = (float) $row['Prezzo'];
    } else {
        // Se il risultato è vuoto, gestisci l'errore
        echo "Nessun risultato trovato.";
    }
} else {
    // Se c'è stato un errore nella query, gestisci l'errore
    echo "Errore nella query: " . mysqli_error($conn);
}

$Query_PrezzoMaglietta ="SELECT Prezzo FROM prodotto WHERE Cod_Prodotto = 3;";
$PrezzoMaglietta = mysqli_query($conn, $Query_PrezzoMaglietta);
if ($PrezzoMaglietta) {
    // Estrai il risultato come array associativo
    $row = mysqli_fetch_assoc($PrezzoMaglietta);
    
    // Se il risultato non è vuoto, assegna il prezzo alla variabile
    if ($row) {
        $PrezzoMaglietta = (float) $row['Prezzo'];
    } else {
        // Se il risultato è vuoto, gestisci l'errore
        echo "Nessun risultato trovato.";
    }
} else {
    // Se c'è stato un errore nella query, gestisci l'errore
    echo "Errore nella query: " . mysqli_error($conn);
}

if(!$PrezzoFelpa){
    print "errore nel trovare PrezzoFelpa";
}
else{

}

if(!$PrezzoBraghe){
    print "errore nel trovare Prezzobraghe";
}
else{

}

if(!$PrezzoMaglietta){
    print "errore nel trovare Prezzomaglietta";
}
else{

}

if(!$ID_Utente){
    print "errore nel trovare l'ID";
}
else{

}

//GESTIONE DATE
$dataOraCorrenti = new DateTime();
$DataSpedizione = clone $dataOraCorrenti;
$DataSpedizione->modify('+7 days');
$dataformattata = $dataOraCorrenti->format('Y-m-d H:i:s');
$DataSpedizione = $DataSpedizione->format('Y-m-d H:i:s');

//TOTALE
if (isset($_COOKIE['totale'])) {
    // Accedi al valore del cookie "totale"
    $valore_totale = $_COOKIE['totale'];
} else {
    echo "ERRORE NEL TOTALE";
}

//GESTIONE QUANTITA PRODOTTI ORDINATI
if (isset($_COOKIE['Maglietta'])) {
    $Maglietta = $_COOKIE['Maglietta'];
} else {
    $Maglietta = 0;
}

if (isset($_COOKIE['Braghe'])) {
    $Braghe = $_COOKIE['Braghe'];
} else {
    $Braghe = 0;
}

if (isset($_COOKIE['Felpa'])) {
    $Felpa = $_COOKIE['Felpa'];
} else {
    $Felpa = 0;
}


//CONVERSIONE IN STRING
$str_valore_totale = (string) $valore_totale;
$str_data = (string) $dataformattata;

$str_DataSpedizione = (string) $DataSpedizione;


$query= "INSERT INTO pagamenti(Data_Pagamento, Totale, ID_Utente) VALUES('$str_data','$str_valore_totale', '$ID_Utente')";
$resultPagamento=mysqli_query($conn,$query);

$queryordine= "INSERT INTO ordine(Data_Ordine, Data_Spedizione, Note, ID_Utente) VALUES('$str_data','$str_DataSpedizione', '/', '$ID_Utente')";
$resultOrdine=mysqli_query($conn,$queryordine);

//QUERY SELECT PER TROVARE L'ID DELL'ULTIMO ORDINE FATTO
$TrovaNumOrdine ="SELECT Num_Ordine FROM ordine ORDER BY Num_Ordine DESC LIMIT 1;";
$NumOrdine= mysqli_query($conn, $TrovaNumOrdine);
if ($NumOrdine) {
    // Estrai il risultato come array associativo
    $row = mysqli_fetch_assoc($NumOrdine);
    
    // Se il risultato non è vuoto, assegna il prezzo alla variabile
    if ($row) {
        $NumOrdine = (int) $row['Num_Ordine'];
    } else {
        // Se il risultato è vuoto, gestisci l'errore
        echo "Nessun risultato trovato.";
    }
} else {
    // Se c'è stato un errore nella query, gestisci l'errore
    echo "Errore nella query: " . mysqli_error($conn);
}

if(!$NumOrdine){
    print "errore nel trovare Numero ORdine";
}
else{

}

if($Maglietta > 0){
    $queryDettagliOrdine_Magliette= "INSERT INTO dettagli_ordine(Num_Ordine, Cod_Prodotto, Quantità, PrezzoProdotti) VALUES($NumOrdine, 3, $Maglietta,  $PrezzoMaglietta)";
    $resultOrdine_Magliete=mysqli_query($conn,$queryDettagliOrdine_Magliette);

    if(!$resultOrdine_Magliete){
        print "errore nell'inserimento del resultOrdine_Magliete. RITENTA da CAPO";
    }
    else{

    }
}


if($Braghe > 0){
    $queryDettagliOrdine_Braghe= "INSERT INTO dettagli_ordine(Num_Ordine, Cod_Prodotto, Quantità, PrezzoProdotti) VALUES($NumOrdine, 2, $Braghe, $PrezzoBraghe)";
    $resultOrdine_Braghe=mysqli_query($conn,$queryDettagliOrdine_Braghe);
    
    if(!$resultOrdine_Braghe){
        print "errore nell'inserimento del resultOrdine_Braghe. RITENTA da CAPO";
    }
    else{

    }
}


if($Felpa > 0){
    $queryDettagliOrdine_Felpa= "INSERT INTO dettagli_ordine(Num_Ordine, Cod_Prodotto, Quantità, PrezzoProdotti) VALUES($NumOrdine, 1, $Felpa, $PrezzoFelpa)";
    $resultOrdine_Felpa=mysqli_query($conn,$queryDettagliOrdine_Felpa);
    
    if(!$queryDettagliOrdine_Felpa){
        print "errore nell'inserimento del queryDettagliOrdine_Felpa. RITENTA da CAPO";
    }
    else{
    }
}


if(!$resultPagamento){
    print "errore nell'inserimento del pagamento. RITENTA da CAPO";
}
else{
    echo '
    <script type="text/javascript">
       alert("Pagamento avvenuto con successo");
    </script>';
    header("Refresh:0.1, url=PagamentoConfermato.php");
}
mysqli_close($conn);

?>