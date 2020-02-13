<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "oxy";
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	function sanitize($conn, $str){
		return mysqli_real_escape_string($conn, $str);
	}
?>