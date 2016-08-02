<?php 
    $_db_host = "localhost";
    $_db_datenbank = ""; 
    $_db_username = ""; 
    $_db_passwort = ""; 

    SESSION_START(); 

    $link = mysql_connect($_db_host, $_db_username, $_db_passwort); 

    if (!$link) 
        { 
        die("Keine Datenbankverbindung möglich: " . mysql_error()); 
        } 

    $datenbank = mysql_select_db($_db_datenbank, $link); 

    if (!$datenbank) 
        { 
        echo "Kann die Datenbank nicht benutzen: " . mysql_error(); 
        mysql_close($link);
        exit;
        } 

    if (!empty($_POST["submit"])) 
        { 

        $_username = mysql_real_escape_string($_POST["username"]); 
        $_passwort = mysql_real_escape_string($_POST["passwort"]); 

        $_sql = "SELECT * FROM login_usernamen WHERE 
                    username='$_username' AND 
                    passwort='$_passwort' AND 
                    user_geloescht=0 
                LIMIT 1"; 

        $_res = mysql_query($_sql, $link); 
        $_anzahl = @mysql_num_rows($_res); 

        if ($_anzahl > 0) 
            { 
            echo "Der Login war erfolgreich.<br>"; 

            $_SESSION["login"] = 1; 

            $_SESSION["user"] = mysql_fetch_array($_res, MYSQL_ASSOC); 

            $_sql = "UPDATE login_usernamen SET letzter_login=NOW() 
                     WHERE id=".$_SESSION["user"]["id"]; 
            mysql_query($_sql); 
            } 
        else 
            { 
            echo "Die Logindaten sind nicht korrekt.<br>"; 
            } 
        } 

    if ($_SESSION["login"] == 0) 
        { 
        include("index.html"); 
        mysql_close($link); 
        exit; 
        } 

    echo "Hallo, Sie sind erfolgreich eingeloggt !<br>"; 

    mysql_close($link); 
?>