<?php

	// Including Connection
	include 'dbconn.php';
    
    // Including Error Check file
	include 'error.php';

    // Including perform query
    include 'perform-query.php';


    // Check if the session are setted
    if (!empty($_SESSION['userid'])) {
        // Create a storage variable
        $id = $_SESSION['userid'];

        
        // Select data based on Identification
        $id_query = mysqli_query($conn,"SELECT * FROM accounts WHERE id = '$id'");
        // Assign data to an array
        $values = mysqli_fetch_assoc($id_query);

        // Create usage variables
        $icon = substr($values['names'], 0, 1);
        $full = $values['names'];

        // Count all tables records

        // Officers Count
        $off_query = mysqli_query($conn,"SELECT * FROM officers");
        $off_count = mysqli_num_rows($off_query);

        // Crimes Count
        $crime_query = mysqli_query($conn,"SELECT * FROM crimes");
        $crime_count = mysqli_num_rows($crime_query);

        // Users Count
        $users_query = mysqli_query($conn,"SELECT * FROM accounts");
        $users_count = mysqli_num_rows($users_query);

    }elseif (!empty($_COOKIE['userid'])) {
        // Create a session
        $_SESSION['userid'] = $_COOKIE['userid'];

        // Create a variable for same link
        $url = $_SERVER['PHP_SELF'];

        // Redirect at same page
        header("location: $url");
    }else{
        header("location: login.php?error-txt=3");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CRIME System</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>
    <div class="header">
        <a href="#" class="logo">CRIMeSystem</a>
        <div class="header-right">
            <a class="active" href="index.php">Home</a>
            <a href="access-officers.php">Officers <span class="badge badge-primary"><?php echo $off_count;?></span></a>
            <a href="access-crime.php">Crimes <span class="badge badge-primary"><?php echo $crime_count;?></span></a>
            <?php 

                // Check if the user is Admin
                if ($values['type'] == "ADMIN") {
            ?>
            <a href="access-users.php">Users <span class="badge badge-primary"><?php echo $users_count;?></span></a>
            <?php
                }else{
                    echo "";
                }

            ?>
            <a href="view-profile.php">
                <span class="short-letter"><?php echo $icon;?></span>
                <span class="full-name"><?php echo $full; ?></span>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="greet">
            <h1 class="greet-txt">WELCOME MR/MRS <?php echo $full; ?>.</h1>
            <p class="greet-paragraph">This system helps you to manage record of crime that occured in the session refered based on the governament cases, try to navigate your work from starting here.</p>
        </div>
    </div>
    <div class="a-toast">
        Want to logout? <a href="logout.php">Click here</a>
    </div>
<script src="assets/scripts/main.js"></script>
<script src="assets/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>