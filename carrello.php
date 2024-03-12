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
        <a href="Index.php">Home</a>
        <a class="active" href="shop.php">Shop</a>
        <a href="informazioni.php">Informazioni</a>
        <?php
        // Avvia o riprende la sessione
        session_start();

        // Controlla se l'utente è loggato
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // L'utente è loggato, mostra il suo nome utente
            $username = $_SESSION['username']; // Ottieni il nome utente dalla sessione
            echo "<p>Benvenuto, $username! <a href='?logout=true'>Logout</a></p>"; // Link per il logout
            $disabilitabottoni = false;
        } else {
            // L'utente non è loggato, mostra il link per accedere
            echo "<a class='login' href='Login_Registrazione/InserisciLogin.php'>Login/Registrazione</a>";
            $disabilitabottoni = true;
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

$totale = 0;

        if (isset($_COOKIE['Maglietta'])) {
            $Maglietta = $_COOKIE['Maglietta'];
            $totale += 299*$Maglietta;
        } else {
            $Maglietta = 0;
        }

        if (isset($_COOKIE['Braghe'])) {
            $Braghe = $_COOKIE['Braghe'];
            $totale += 499*$Braghe;
        } else {
            $Braghe = 0;
        }

        if (isset($_COOKIE['Felpa'])) {
            $Felpa = $_COOKIE['Felpa'];
            $totale += 999*$Felpa;
        } else {
            $Felpa = 0;
        }

        setcookie('totale', $totale, time() + (86400 * 2), '/');
        
        ?>
      </div>
    <br><br>

    <div class="logo">
        <img src="imgs/INTERLOGO.png" alt="Immagine">
        <p style="font-size: 24px;">INTERPERFECT</p>
    </div>
    
    <div class="carrello">
    <img src="imgs/carrello.png" alt="Immagine">
    <h1>CARRELLO</h1>
    <br><br><br>
        <table >
            <tr>
                <th>Articolo</th>
                <th>Prezzo</th>
            </tr>
            <tr>
                <td>Maglietta (<?php echo $Maglietta ?>)</td>
                <td><?php 
                    $tot = 299*$Maglietta;
                    echo $tot ."€"
                    ?></td>
            </tr>
            <tr>
                <td>Felpa (<?php echo $Felpa ?>)</td>
                <td><?php 
                    $tot = 999*$Felpa;
                    echo $tot ."€"
                    ?></td>
            </tr>
            <tr>
                <td>Braghe (<?php echo $Braghe ?>)</td>
                <td>
                    <?php 
                    $tot = 499*$Braghe;
                    echo $tot ."€"
                    ?>
                </td>
            </tr>
            <tr>
                <td><strong>TOTALE</strong> (<?php echo $Braghe+$Felpa+$Maglietta ?>) </td>
                <td><strong><?php 
                    $tot = $Braghe*499+$Felpa*999+$Maglietta*299;
                    echo $tot ."€"
                    ?></strong></td>
            </tr>
        </table>
        <a href="pagamento.php"><button class="btn_accedi"  id="btn_paga" name="btn_paga">Vai al pagamento</button></a>
    </div>
</body>
</html>
