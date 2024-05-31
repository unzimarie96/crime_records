<?php

	
	$conn = mysqli_connect("localhost","root","","crime_system");

	// Check if connection is done
	if ($conn == TRUE) {
		session_start();
		date_default_timezone_set("Africa/Kigali");
	}else{
		echo "Connection well!";
	}

?>
<link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">