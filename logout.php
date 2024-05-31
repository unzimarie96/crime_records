<?php

    // Including Connection
	include 'dbconn.php';

    // Updating Status
    if (!empty($_SESSION['userid'])) {
        // Create variable
        $id = $_SESSION['userid'];
        $status = "OFFLINE";

        // Make a query
        $query = mysqli_query($conn,"UPDATE accounts SET status = '$status' WHERE id = '$id'");

        // Check if is done
        if ($query == TRUE) {
            // Unset all sessions
            session_destroy();

            // Delete a cookie
            setcookie("userid", "", time() - 3600);

            // Redirect to login with error n:2
            header("location: login.php?error-txt=2");
        }else {
            // Redirect to login with error n:1
            header("location: login.php?error-txt=1");
        }
    }else{
        // Redirect to login with error n:3
        header("location: login.php?error-txt=3");
    }


?>