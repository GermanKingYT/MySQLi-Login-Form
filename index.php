<?php
	include('login.php'); // Include Login Script

	if ((isset($_SESSION['username']) != '')) 
	{
		header('Location: home.php');
	}	
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>

<body>

<html lang="en-US">

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="icon" href="img/favicon.png">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>
	<body background="img/bgimage.jpg">
	<div class="container">
	<div id="login">
	<form method="POST" action="">
	<fieldset class="clearfix">
		<p><span class="fontawesome-user"></span><input type="text" name="username" placeholder="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
		<p><span class="fontawesome-lock"></span><input type="password" name="password" placeholder="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
		<p><input type="submit" name="submit" value="Login"></p>
	</fieldset>
	</form>
	</div> <!-- end login -->
	</div>
</body>
  
</html>
</body>
</html>