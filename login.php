<?php 
    $_db_host = "localhost";
    $_db_datenbank = ""; 
    $_db_username = ""; 
    $_db_passwort = ""; 

    $con = mysqli_connect($_db_host, $_db_username, $_db_passwort);

if (mysqli_connect_errno())

{
echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// checking the user

if(isset($_POST["login"]))
    {
    $_username = mysql_real_escape_string($_POST["username"]); 
    $_passwort = mysql_real_escape_string($_POST["passwort"]); 

    $sel_user = "SELECT * FROM login_usernamen WHERE username='$_username' AND passwort='$_passwort' AND user_geloescht=0 LIMIT 1";

    $run_user = mysqli_query($con, $sel_user);

    $check_user = mysqli_num_rows($run_user);

if($check_user>0)
    {

    $_SESSION[‘username’]=$_username;

    $_SESSION["login"] = 1;

    $_SESSION["user"] = mysqli_fetch_array($run_user, MYSQLI_ASSOC);

    $sel_user = "UPDATE login_usernamen SET letzter_login=NOW()
                 WHERE id=".$_SESSION["user"]["id"];
                 mysql_query($sel_user);
                 }
             else
                 {
                 echo "Wrong Login details.<br>";
                 }
             } 

    if ($_SESSION["login"] == 0)
        {
        include("index.html");
        mysql_close($con);
        exit;
        }

   	    echo "Login Successful!<br>";

        mysql_close($con);
?>