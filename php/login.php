<?php include "dbConfig.php";

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $name = $_GET["name"];
    $password = md5($_GET["password"]);
	 if ($name == '' || $password == '') {
        $msg = "You must enter all fields";
    } else {
        $sql = "SELECT * FROM members WHERE name = '$name' AND password = '$password'";
        $query = mysql_query($sql);

        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($query) > 0) {
         
            header('Location: YOUR_LOCATION');
            exit;
        }

        $msg = "Username and password do not match";
    }
}
?>
