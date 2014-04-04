<?php
	
	require_once("include/session.php");
	require_once("include/connect.php");

	$email = $_POST["email"];
	$password = $_POST["password"];

	if($email || $password) {

		$sql = "SELECT email, password FROM admins WHERE email = '". $email ."' AND password = '". $password ."'";


		if($admins = $conn->query($sql)) {
			if($admins->num_rows >= 1) {
				$_SESSION["login"] = true;
				header("location: blocked.php");
			} else {
				echo "Wrong combination of email and password";
			}
		} else {
			echo "SQL error";
		}
	}

	print_r($admins); 
?>

<!DOCTYPE html>
<html>
	<head>

		<!-- CSS -->
    	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    	<link href="assets/css/main.css" rel="stylesheet" type="text/css">

	</head>
	<body>
		<br>
		<br>
		<div class="full-page-wrapper page-login text-center">
	 		<div class="login-box center-block">
            	<form method="post" action="login.php">
                	<div class="input-group">
                    	<input type="text" placeholder="email" name="email" class="form-control">
	                    <span class="input-group-addon"><i class="fa fa-user"></i>
	                    </span>
	                </div>
	                <div class="input-group">
	                    <input type="password" placeholder="password" name="password" class="form-control">
	                    <span class="input-group-addon"><i class="fa fa-lock"></i>
	                    </span>
	                </div>
	                <input type="submit" value="Login" class="btn btn-primary btn-lg btn-block btn-login">
	            </form>
	    	</div>
		</div>
	</body>
</html>
