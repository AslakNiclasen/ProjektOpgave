<?php
	$conn = new mysqli("sql3.freemysqlhosting.net","sql335520","bH8%xW3*","sql335520");

	if($conn->connect_error){
		die("Connect error: ". $conn->connect_error);
	}
?>