var a = 0;
var b = 0;
var c = 0;





let slideIndex = 0;


function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        // Nasconde tutte le slide impostando il display su "none"
        slides[i].style.display = "none";  
    }
    slideIndex++;
    
    if (slideIndex > slides.length) {
        slideIndex = 1
    } 
    // Mostra la slide corrente impostando il display su "block"   
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 5000); // Change image every 2 seconds
}

/*------------------
-----CONTROLLI------
---REGISTRAZIONE----
------------------*/

function validaNome(nome) {
    var nomeRegex = /^[a-zA-Z]+$/;
    return nomeRegex.test(nome);
}

function validaCognome(cognome) {
    var cognomeRegex = /^[a-zA-Z]+$/;
    return cognomeRegex.test(cognome);
}

function validaCitta(citta) {
    var cittaRegex = /^[a-zA-Z]+$/;
    return cittaRegex.test(citta);
}

function validaCodicePostale(cod_postale) {
    var codPostaleRegex = /^\d{5}$/;
    return codPostaleRegex.test(cod_postale);
}

function validaPassword(pw, conf_pw) {
    return pw === conf_pw;
}

function validaTelefono(tel) {
    var telRegex = /^\d{10}$/;
    return telRegex.test(tel);
}

function validaRegistrazione() {
    var username = document.getElementById("username").value;
    var nome = document.getElementById("nome").value;
    var cognome = document.getElementById("cognome").value;
    var pw = document.getElementById("pw").value;
    var conf_pw = document.getElementById("conf_pw").value;
    var citta = document.getElementById("citta").value;
    var cod_postale = document.getElementById("cod_postale").value;
    var tel = document.getElementById("tel").value;

    if (!validaNome(nome)) {
        alert("Il nome deve contenere solo lettere.");
        return false;
    }

    if (!validaCognome(cognome)) {
        alert("Il cognome deve contenere solo lettere.");
        return false;
    }

    if (!validaCognome(citta)) {
        alert("La città deve contenere solo lettere.");
        return false;
    }

    if (!validaCodicePostale(cod_postale)) {
        alert("Il codice postale deve contenere esattamente 5 cifre numeriche.");
        return false;
    }

    if (!validaPassword(pw, conf_pw)) {
        alert("Le password non corrispondono.");
        return false;
    }

    if (!validaTelefono(tel)) {
        alert("Il numero di telefono deve contenere esattamente 10 cifre numeriche.");
        return false;
    }

    return true;
}


/*------------------
-----CONTROLLI------
-----PAGAMENTO------
------------------*/
function validaNumeroCarta() {
    var numcartaInput = document.getElementById("numcarta");
    var numcartaValue = numcartaInput.value.replace(/\s/g, '');

    if (/^\d{16}$/.test(numcartaValue) && !isNaN(numcartaValue)) {
        // Il numero della carta è valido
        return true;
    } else {
        // Il numero della carta non è valido
        alert("Numero carta non valido!");
        return false;
    }
}
function validaCVV() {
    var cvvInput = document.getElementById("cvv");
    var cvvValue = cvvInput.value;

    if (/^\d{3}$/.test(cvvValue) && !isNaN(cvvValue)) {
        // Il CVV è valido
        return true;
    } else {
        // Il CVV non è valido
        alert("CVV non valido!");
        return false;
    }
}

function validaScadenza() {
    var scadenzaInput = document.getElementById("scadenza");
    var scadenzaVal = scadenzaInput.value;

    // Rimuove eventuali caratteri non numerici
    var numeriScadenza = scadenzaVal.replace(/\D/g, '');

    // Verifica se la lunghezza è maggiore di 2 e aggiunge uno slash dopo il secondo numero
    if (numeriScadenza.length > 2) {
        numeriScadenza = numeriScadenza.substring(0, 2) + '/' + numeriScadenza.substring(2);
    }

    // Aggiorna il valore dell'input con i numeri formattati
    scadenzaInput.value = numeriScadenza;

    // Verifica se la data di scadenza è valida (lunghezza deve essere 5)
    if (numeriScadenza.length !== 5) {
        alert("La data di scadenza deve essere nel formato MM/YY");
        return false;
    }
    return true;
}


function controllaInput() {
    return validaNumeroCarta() && validaCVV() && validaScadenza();
}


/*------------------
-----CONTROLLI------
------CARRELLO------
------------------*/

function AggiungiCarrello(numbottone){    
    if(numbottone == 1){
        var cookieName = "Maglietta";
        a++;
        var cookieValue = String(a);
        // Imposta il cookie con scadenza di 7 giorni
        var expireDate = new Date();
        expireDate.setDate(expireDate.getDate() + 7);
        var cookieString = encodeURIComponent(cookieName) + "=" + encodeURIComponent(cookieValue) + "; expires=" + expireDate.toUTCString() + "; path=/";
        document.cookie = cookieString;

        // AggiornaCOUNTER
        var paragrafo = document.getElementById("ctr_magliette");
        paragrafo.innerHTML = a;

    }else if(numbottone == 2){
        var cookieName = "Felpa";
        b++;
        var cookieValue = String(b);
        // Imposta il cookie con scadenza di 7 giorni
        var expireDate = new Date();
        expireDate.setDate(expireDate.getDate() + 7);
        var cookieString = encodeURIComponent(cookieName) + "=" + encodeURIComponent(cookieValue) + "; expires=" + expireDate.toUTCString() + "; path=/";
        document.cookie = cookieString;
        
        // AggiornaCOUNTER
        var paragrafo = document.getElementById("ctr_felpe");
        paragrafo.innerHTML = b;
    }else{
        var cookieName = "Braghe";
        c++;
        var cookieValue = String(c);
        // Imposta il cookie con scadenza di 7 giorni
        var expireDate = new Date();
        expireDate.setDate(expireDate.getDate() + 7);
        var cookieString = encodeURIComponent(cookieName) + "=" + encodeURIComponent(cookieValue) + "; expires=" + expireDate.toUTCString() + "; path=/";
        document.cookie = cookieString;
        
        // AggiornaCOUNTER
        var paragrafo = document.getElementById("ctr_braghe");
        paragrafo.innerHTML = c;
    }
}



/*------------------
--------SHOP--------
------------------*/

function changeImage(buttonId, newImageUrl) {
    // Ottieni il riferimento al pulsante tramite l'ID
    var button = document.getElementById(buttonId);

    // Ottieni il riferimento all'elemento <img> all'interno del pulsante
    var image = button.querySelector('img');

    // Aggiungi la classe 'new-image' solo se non è già presente
    if (!image.classList.contains('new-image')) {
        image.classList.add('new-image');
    }

    // Cambia l'URL dell'immagine con il nuovo URL fornito
    image.src = newImageUrl;

    // Aggiungi un listener per rimuovere la classe 'new-image' al passaggio del mouse via dal pulsante
    button.addEventListener('mouseout', function() {
        image.classList.remove('new-image');
    });
}



/*------------------
-------LINEE--------
------------------*/

var NumLinea = 1;
function OttieniLinee() {
    // Richiesta AJAX per ottenere i dati del prossimo elemento
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Ricevi la risposta JSON
        var data = JSON.parse(this.responseText);
        
        // Crea una nuova riga della tabella
        var tableRow = document.createElement("tr");
  
        // Creazione delle celle della tabella
        var cell1 = document.createElement("td");
        cell1.innerHTML = "<b>Nome:</b> " + data.Linea_Prod;
        tableRow.appendChild(cell1);
  
        var cell2 = document.createElement("td");
        cell2.innerHTML = "<b>Descrizione:</b> " + data.Descrizione;
        tableRow.appendChild(cell2);
  
        var cell3 = document.createElement("td");
        cell3.innerHTML = "<b>Cod_Prodotto:</b> " + data.Cod_Prodotto;
        tableRow.appendChild(cell3);
  
        // Aggiungi la nuova riga alla tabella
        document.getElementById("info_linee_table").appendChild(tableRow);
      }
    };
  
    // Effettua la richiesta GET per ottenere il prossimo elemento
    xhttp.open("GET", "OttieniLinee.php?linea=" + NumLinea, true);
    xhttp.send();
  
    // Incrementa l'ID corrente per il prossimo elemento
    NumLinea++;
  
    // Aggiorna il prezzo visualizzato sulla pagina
    if (NumLinea < 4) {
      OttieniLinee();
    }
}


document.getElementById("gestione_linee_form").onsubmit = function() {
    var inputs = document.querySelectorAll('input[type="number"]');
    var values = [];
    for (var i = 0; i < inputs.length; i++) {
        var value = parseInt(inputs[i].value);
        if (values.includes(value)) {
            alert("I valori dei campi devono essere diversi tra loro.");
            return false; // Ferma l'invio del form se i valori non sono diversi
        }
        values.push(value);
    }
    return true; // Invia il form se tutti i valori sono diversi
};
