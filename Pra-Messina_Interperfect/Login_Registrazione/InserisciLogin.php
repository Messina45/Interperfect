<link rel="stylesheet" href="mystyle.css">
<?php
 
    print "<h1> Login </h1>";
    print "<form method='POST' action='ControlloLogin.php'>";
    print "Username: <input type='text' name='user' size='10'><br><br>";
    print "Password: <input type='text' name='psw' size='10'><br><br>";
    print "<input type='submit' value='Login'>&nbsp &nbsp";
    print "<input type='reset' value='Reset'>";
    print "</form>";
?>