<?php

    // Assigning identification
    if (!empty($_COOKIE['userid']) && empty($_SESSION['userid'])) {
        // Create a session
        $_SESSION['userid'] = $_COOKIE['userid'];
    }elseif (!empty($_SESSION['userid']) && empty($_COOKIE['userid'])) {
        // Create a cookie
        setcookie("userid",$_SESSION['userid'],time() + (3600 * 3000));
    }else {
        header("location: login.php?error-txt=3");
    }

?>