<?php


$conn=mysqli_connect("localhost","root","","DB_prenotapanino");


if(!$conn){


    print"errore nella connessione";
    exit();
}


$user=$_POST["user"];
$psw=$_POST["psw"];
$query= "INSERT INTO users(user,psw)
         VALUES('$user','$psw')";
$result=mysqli_query($conn,$query);


if(!$result){
    print "errore nell'inserimento , user già presente";
}
else{
    echo '<script type="text/javascript">
       window.onload = function () { alert("Registrazione avvunta con successo"); }
    </script>';
    header("Refresh:0.1, url=InserisciLogin.php");
}
mysqli_close($conn);

?>