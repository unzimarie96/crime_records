<?php

	// Including Connection
	include 'dbconn.php';

	// Including Error Check file
	include 'error.php';

	// Check if the session are setted
    if (!empty($_SESSION['userid'])) {
		// Redirect user to home page
		header("location: index.php?error-txt=5");
	}else {
		// Do nothing to user
		echo "";
	}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login to CRIME System</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>
	<div class="card">
		<div class="card-header">
			<h3>Sign In to Continue</h3>
		</div>
		<form method="POST" class="card-body">
			<div class="form-group">
				<label>Username:</label>
				<input type="text" name="username" class="form-control" maxlength="255" minlength="1" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
				<input type="password" class="form-control" name="password" maxlength="255" minlength="1" required>
			</div>
			<button class="btn btn-primary form-control" type="submit" name="login">Continue</button>
		</form>
		<div class="card-footer">
			<?php

				// When the button is clicked
				if (isset($_POST['login'])) {
					// Creating variables
					$username = $_POST['username'];
					$password = md5($_POST['password']);

					// Check if the user exist
					$query = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$username' AND password = '$password'");
					$check = mysqli_fetch_array($query);

					// Check if query done
					if ($check == TRUE) {
						// Select data from user credientials
						$var_query = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$username' AND password = '$password'");
						
						// Number the records found
						if (mysqli_num_rows($var_query) > 0) {
							// Assign data to an array
							$data = mysqli_fetch_assoc($var_query);

							// Assign Variable
							$id = $data['id'];
							$status = "ONLINE";

							// Make a query
							$query = mysqli_query($conn,"UPDATE accounts SET status = '$status' WHERE id = '$id'");

							// Device insert info
							$device_id = rand(time(), 100000);
							$device_format = mktime(11, 14, 54, 8, 12, 2014);
							$device_logged_date = date("Y-m-d h:i:sa", $device_format);
							$used_id_by_user = $id;
							$device_info = $_SERVER["HTTP_SEC_CH_UA_PLATFORM"]." on ".$_SERVER["HTTP_SEC_CH_UA"];

							// Query to insert device info
							$device_query = mysqli_query($conn,"INSERT INTO logged_device(id,date_logged,user_id,device_info) VALUES('$device_id','$device_logged_date','$id','$device_info')");

							// Create session
							$_SESSION['userid'] = $data['id'];

							// Create cookie
							setcookie("userid",$_SESSION['userid'],time() + (3600 * 30));

							if (($query == TRUE) AND ($device_query == TRUE)) {
								// Redirect to home
								header("location: index.php");
							}else{
								// Redirect to login with error n:4
								header("location: login.php?error-txt=4");
							}
						}
					}else{
			?>
			<div class="alert alert-danger">Try to create account.</div>
			<?php
					}
				}


			?>
		</div><br>
		<p>Don't you have an account?<a href="signup.php">Create account Here</a></p>
	</div>
<script src="assets/scripts/main.js"></script>
<script src="assets/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>