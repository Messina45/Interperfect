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

    <br><br>
    
    <div class="CentroLogin">
        <img src="../imgs/user.png" alt="Immagine">
        <h1>LOGIN</h1>
        <br>
        <form method='POST' action="ControlloLogin.php">
            <input type="text" id="user" name="user" placeholder="USERNAME" required>
            <br>
            <input type="password" id="psw" name="psw" placeholder="PW" required>
            <br>
            <button type="submit" id="btn_accedi" name="btn_accedi">ACCEDI</button>
        </form>
        <br>
        <br style="padding-top: 30px;">
    </div>
    <br><br>
    <footer class="footer">
        <p>Non sei registrato? Registrati cliccando <a href="InserisciRegistrazione.php">qui</a> </p>
    </footer>
    </body>
</html>
