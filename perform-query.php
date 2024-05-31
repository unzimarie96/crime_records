<?php

    // This file is for check whether there is an button issetted


    // When the button is clicked for updating officer information
    if (isset($_POST['update-officer'])) {
        // Creating variables
        $names = $_POST['names'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $birthday = $_POST['dob'];
        $rank = $_POST['rank'];

        // Check whether there is GET for id
        if (!empty($_GET['act_id'])) {
            // Assign id as a variable
            $perform_id = $_GET['act_id'];

            // Perform a query to update
            $update_query = mysqli_query($conn,"UPDATE officers SET names = '$names', gender = '$gender', email = '$email', address = '$address', dob = '$birthday', rank = '$rank' WHERE id = '$perform_id'");

            // Check if it happened
            if ($update_query == TRUE) {
                // Redirect to officers page with erron n:9
                header("location: access-officers.php?error-txt=9");
            }else{
                // Redirect to officers page with erron n:10
                header("location: access-officers.php?error-txt=10");
            }
        }else{
            // Do nothing
        }

    }

    // When the button is clicked for deleting an officer
    if (isset($_POST['delete-officer'])) {

        // Check if the act_id is not empty
        if (!empty($_GET['act_id'])) {
            // Assign it to variable
            $act_id = $_GET['act_id'];
            
            // Delete an officer from table
            $off_trash = mysqli_query($conn,"DELETE FROM officers WHERE id = '$act_id'");

            // Check if the officer removed
            if ($off_trash == TRUE) {
                // Redirect to officer page with error n:8
                header("location: access-officers.php?error-txt=8");
            }else{
                // Redirect to officer page with error n:7
                header("location: access-officers.php?error-txt=7");
            }
        }
    }

    // When the button is clicked for deleting an users
    if (isset($_POST['delete-user'])) {

        // Check if the act_id is not empty
        if (!empty($_GET['act_id'])) {
            // Assign it to variable
            $us_id = $_GET['act_id'];
            
            // Delete an users from table
            $us_trash = mysqli_query($conn,"DELETE FROM accounts WHERE id = '$us_id'");

            // Check if the users removed
            if ($us_trash == TRUE) {
                // Redirect to users page with error n:13
                header("location: access-users.php?error-txt=13");
            }else{
                // Redirect to users page with error n:14
                header("location: access-users.php?error-txt=14");
            }
        }
    }

    // When the button is clicked for deleting an users
    if (isset($_POST['update-user'])) {

        // Check if the act_id is not empty
        if (!empty($_GET['act_id'])) {
            // Assign it to variable
            $us_id = $_GET['act_id'];
            $type = $_POST['type'];
            
            // Delete an users from table
            $us_trash = mysqli_query($conn,"UPDATE accounts SET type = '$type' WHERE id = '$us_id'");

            // Check if the users removed
            if ($us_trash == TRUE) {
                // Redirect to users page with error n:15
                header("location: access-users.php?error-txt=15");
            }else{
                // Redirect to users page with error n:16
                header("location: access-users.php?error-txt=16");
            }
        }
    }

    // When the button is clicked for adding officer information
    if (isset($_POST['add-officer'])) {
        // Creating variables
        $names = $_POST['names'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $birthday = $_POST['dob'];
        $rank = $_POST['rank'];

        // Perform a query to update
        $update_query = mysqli_query($conn,"INSERT INTO officers(id,names,gender,email,address,dob,rank) VALUES(NOT NULL,'$names','$gender','$email','$address','$birthday','$rank')");

        // Check if it happened
        if ($update_query == TRUE) {
            // Redirect to officers page with erron n:11
            header("location: access-officers.php?error-txt=11");
        }else{
            // Redirect to officers page with erron n:12
            header("location: access-officers.php?error-txt=12");
        }

    }

    // When the button is clicked for adding crime information
    if (isset($_POST['add-crime'])) {
        // Creating variables
        $title = $_POST['title'];
        $officer_id = $_POST['officer_id'];
        $description = $_POST['description'];
        $evidence_img = NULL;

        // Perform a query to update
        $add_query = mysqli_query($conn,"INSERT INTO crimes(idCrime,title,description,officer_id,date_added,evidence_img) VALUES(NOT NULL,'$title','$description','$officer_id',current_timestamp(),'$evidence_img')");

        // Check if it happened
        if ($add_query == TRUE) {
            // Redirect to officers page with erron n:11
            header("location: access-crime.php?error-txt=19");
        }else{
            // Redirect to officers page with erron n:12
            header("location: access-crime.php?error-txt=18");
        }

    }

    // When the button is clicked for deleting an crime
    if (isset($_POST['delete-crime'])) {

        // Check if the act_id is not empty
        if (!empty($_GET['act_id'])) {
            // Assign it to variable
            $crime_id = $_GET['act_id'];
            
            // Delete an users from table
            $crime_trash = mysqli_query($conn,"DELETE FROM crimes WHERE idCrime = '$crime_id'");

            // Check if the users removed
            if ($crime_trash == TRUE) {
                // Redirect to users page with error n:13
                header("location: access-crime.php?error-txt=21");
            }else{
                // Redirect to users page with error n:14
                header("location: access-crime.php?error-txt=20");
            }
        }
    }
    // When the button is clicked for updating officer information
    if (isset($_POST['update-crime'])) {
        // Creating variables
        $title = $_POST['title'];
        $officer_id = $_POST['officer_id'];
        $description = $_POST['description'];
        $evidence_img = NULL;

        // Check whether there is GET for id
        if (!empty($_GET['act_id'])) {
            // Assign id as a variable
            $perform_id = $_GET['act_id'];

            // Perform a query to update
            $update_query = mysqli_query($conn,"UPDATE crimes SET title = '$title', officer_id = '$officer_id', description = '$description' WHERE idCrime = '$perform_id'");

            // Check if it happened
            if ($update_query == TRUE) {
                // Redirect to officers page with erron n:23
                header("location: access-crime.php?error-txt=23");
            }else{
                // Redirect to officers page with erron n:22
                header("location: access-crime.php?error-txt=22");
            }
        }else{
            // Do nothing
        }

    }

?>