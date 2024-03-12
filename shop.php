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
      ?>
    </div>

    <br><br>

    <div class="topalin">
      <div class="logo">
        <img src="imgs/INTERLOGO.png" alt="Immagine">
        <p style="font-size: 24px;">INTERPERFECT</p>
      </div>

      

      <div class="precarrello">
        <button onclick="window.location.href='carrello.php'" <?php if($disabilitabottoni){echo ' disabled ';}else{echo ' enabled ';}?> >
          <img src="imgs/carrello.png" alt="carrello">
        </button>
      </div>
    </div>

    <br><br>

    <div class="frontshop">
      <table>
        <tr>
          <td>
            <button id="button1" onmouseover="changeImage('button1', 'imgs/magliaretro.jpg')" onmouseout="changeImage('button1', 'imgs/magliafront.jpg')">
              <a href="#1">
                <img src="imgs/magliafront.jpg" alt="Prodotto 1">
              </a>
            </button>
            <br><br><br>
            <button onclick="AggiungiCarrello(1)" <?php if($disabilitabottoni){echo ' disabled ';}else{echo ' enabled ';}?> data-product-id="111">
                  <span>ADD</span>
                  <span>299.99€</span>
            </button>
            <br>
            <p>Magliette nel carrello: <span id="ctr_magliette">0</span></p>
          </td>
          <td>
            <button id="button2" onmouseover="changeImage('button2', 'imgs/felparetro.jpg')" onmouseout="changeImage('button2', 'imgs/felpafront.jpg')">
              <a href="#2">
                <img src="imgs/felpafront.jpg" alt="Prodotto 2">
              </a>
            </button>
            <br><br><br>
            <button onclick="AggiungiCarrello(2)" <?php if($disabilitabottoni){echo ' disabled ';}else{echo ' enabled ';}?> data-product-id="222">
                  <span>ADD</span>
                  <span>999.99€</span>
            </button> 
            <br>
            <p>Felpe nel carrello: <span id="ctr_felpe">0</span></p>
          </td>
          <td>
            <button id="button3" onmouseover="changeImage('button3', 'imgs/jeansretro.jpg')" onmouseout="changeImage('button3', 'imgs/jeansfront.jpg')">
              <a href="#3">
                <img src="imgs/jeansfront.jpg" alt="Prodotto 3">
              </a>
            </button>
            <br><br><br>
            <button onclick="AggiungiCarrello(3)" <?php if($disabilitabottoni){echo ' disabled ';}else{echo ' enabled ';}?> id="btn_shop1" data-product-id="333">
                <span>ADD</span>
                <span>499.99€</span>
            </button>
            <br>
            <p>Braghe nel carrello: <span id="ctr_braghe">0</span></p>
          </td>
        </tr>
      </table>
    </div>
    
</body>
</html>