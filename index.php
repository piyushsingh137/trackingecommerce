<?php
// Include config file
require_once 'config.php';
 session_start();
// Define variables and initialize with empty values
$err="";
if ($_SERVER['REQUEST_METHOD']=='POST'){
$name = $_POST['username'];
$pwd = $_POST['pass'];
$sql= "SELECT * FROM users WHERE username = '$name' AND password = '$pwd' ";
$result = mysqli_query($link,$sql);
$check = mysqli_fetch_array($result);
if(isset($check)){
	$_SESSION["username"]=$name;
 header("location: welcome.php");
 
}else{
$err = 'Invalid login credential.';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
html { 
    background: url(images/ecomm.jpeg) no-repeat center center fixed #000; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
</style>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body >
<br>
<br>
		<center>
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="POST">
					
					<span class="login100-form-avatar">
						<img src="images/avatar-01.jpg" alt="AVATAR">
					</span>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					 <span class="help-block"><?php echo $err; ?></span>
				</form>
			</div>
		</center>
</body>
</html>