<?php 
    $_db_host = "localhost";
    $_db_database = ""; 
    $_db_username = ""; 
    $_db_password = ""; 

    SESSION_START();

    # Connect to Database
    $con = mysqli_connect($_db_host, $_db_username, $_db_password);

    # Connection Successful ?
    if (mysqli_connect_errno())

        {
            echo "MySQLi Connection was not established: " . mysqli_connect_error();
        }
        
    # Connect to the Right Database 
    $database = mysqli_select_db($con, $_db_database); 

    if (!$database) 
        { 
        echo "Cant use the Database: " . mysqli_error(); 
        mysql_close($con);        # Close Database
        exit;                     # Exit Programm
        } 

##################################################################

    # Check $_POST
    if(isset($_POST["submit"]))
        {
        $_username = mysql_real_escape_string($_POST["username"]); 
        $_passwort = mysql_real_escape_string($_POST["passwort"]); 

        $sel_user = "SELECT * FROM login_usernamen WHERE
                        username='$_username' AND
                        passwort='$_passwort' AND
                        user_geloescht=0
                    LIMIT 1";

        # Check if User exists in Database
        $run_user = mysqli_query($con, $sel_user);
        $check_user = mysqli_num_rows($run_user);


        if($check_user > 0)
        {
        ?> 
        <script>alert("Login Successful");</script> 
        <?php

        $_SESSION[‘username’]=$_username;

        # Save in Session that User is logged in !
        $_SESSION["login"] = 1;

        # Save User Session !
        $_SESSION["user"] = mysqli_fetch_array($run_user, MYSQLI_ASSOC);

        # Set Login Date in Database !
        $sel_user = "UPDATE login_usernamen SET letzter_login=NOW()
                    WHERE id=".$_SESSION["user"]["id"];
                    mysql_query($sel_user);
                    }
                else
                    {
                    ?> 
                    <script>alert("Wrong Login Credentials!");</script> 
                    <?php
                    }
                } 
        # User Logged in ???
        if ($_SESSION["login"] == 0)
            {
            # Not Logged in, close the database
            # and exit the programm
            include("index.html");
            mysql_close($con);
            exit;
            }

            # If the User is Logged in
            # Show this Code
            ?> 
            <script>alert("You did it!");</script> 
            <?php

##################################################################

            # Close the Database again
            mysql_close($con);
?>