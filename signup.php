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
	<title>Create Account on CRIME System</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>
	<div class="card">
		<div class="card-header">
			<h3>Create an account</h3>
		</div>
		<form method="POST" class="card-body">
			<div class="form-group">
				<label>Names:</label>
				<input type="text" name="names" class="form-control" maxlength="255" minlength="1" required>
			</div>
			<div class="form-group">
				<label>Username:</label>
				<input type="text" name="username" class="form-control" maxlength="255" minlength="1" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
				<input type="password" name="password" class="form-control" maxlength="255" minlength="8" required>
			</div>
			<div class="form-group">
				<label>Date of birth:</label>
				<input type="date" name="birthday" class="form-control" required>
			</div>
			<button class="btn btn-primary form-control" type="submit" name="signup">Signup</button>
		</form>
		<div class="card-footer">
			<?php

				// When the button is clicked
				if (isset($_POST['signup'])) {
					// Creating variables
					$names = $_POST['names'];
					$username = $_POST['username'];
					$password = md5($_POST['password']);
					$dob = $_POST['birthday'];

					// Check if username exist
					$check_existance = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$username'");

					// Number the rows affected
					if (mysqli_num_rows($check_existance) > 0) {
			?>
			<div class="alert alert-danger"><?php echo "a User with this <b>".$username."</b> already exist."; ?></div>
			<?php
					}else{
						// Insert the new account
						$query = mysqli_query($conn,"INSERT INTO accounts(id,names,username,password,birthday) VALUES(NOT NULL,'$names','$username','$password','$dob')");

						// Check if the user account is created
						if ($query == TRUE) {
			?>
			<div class="alert alert-success"><?php echo "An account created succesful,<br>Try to login in account"; ?></div>
			<?php
						}else{
			?>
			<div class="alert alert-danger"><?php echo "failed to create account!"; ?></div>
			<?php
						}
					}

				}


			?>
		</div><br>
		<p>Have an account?<a href="login.php">Login Here</a></p>
	</div>
<script src="assets/scripts/main.js"></script>
<script src="assets/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>