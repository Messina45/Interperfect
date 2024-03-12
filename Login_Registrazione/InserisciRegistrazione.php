<!DOCTYPE html>
<html lang="IT-it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InterPerfect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
</head>
<body>
    <div class="topnav">
        <a href="../Index.php">Home</a>
        <a href="../shop.php">Shop</a>
        <a href="../informazioni.php">Informazioni</a>
        <a class="login" class="active" href="InserisciLogin.php">Login/Registrazione</a>
    </div>
    <br><br>

    <div class="logo">
        <img src="../imgs/INTERLOGO.png" alt="Immagine">
        <p style="font-size: 24px;">INTERPERFECT</p>
    </div>
    
    <div class="CentroLogin">
        <img src="../imgs/user.png" alt="Immagine">
        <h1>REGISTRAZIONE</h1>
        <br>
        <form method='POST' action="ControlloRegistrazione.php" onsubmit="return validaRegistrazione();">
            <input type="text" id="username" name="username" placeholder="USERNAME" required>
            <br>
            <input type="text" id="nome" name="nome" placeholder="NOME" required>
            <input type="text" id="cognome" name="cognome" placeholder="COGNOME" required>
            <br>
            <input type="password" id="pw" name="pw" placeholder="PW" required>
            <input type="password" id="conf_pw" name="conf_pw" placeholder="CONFERMA PW" required>
            <br>
            <input type="text" id="citta" name="citta" placeholder="CITTA" required>
            <input type="text" id="via" name="via" placeholder="VIA" required>
            <br>
            <input type="text" id="cod_postale" name="cod_postale" placeholder="CODICE POSTALE" required>
            <input type="text" id="tel" name="tel" placeholder="TELEFONO" required>
            <br>
            <button type="submit" id="btn_accedi" name="btn_accedi">REGISTRATI</button>
        </form>
        <br>
        <br style="padding-top: 30px;">
    </div>
    <br><br>
    <footer class="footer">
        <p>Hai già un account? Accedi cliccando <a href="InserisciLogin.php">qui</a> </p>
    </footer>

    </body>
</html>