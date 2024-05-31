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
    <title>Users of the System | CRIME System</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>
    <div class="header">
        <a href="#" class="logo">CRIMeSystem</a>
        <div class="header-right">
            <a href="index.php">Home</a>
            <a href="access-officers.php">Officers <span class="badge badge-primary"><?php echo $off_count;?></span></a>
            <a href="access-crime.php">Crimes <span class="badge badge-primary"><?php echo $crime_count;?></span></a>
            <?php 

                // Check if the user is Admin
                if ($values['type'] == "ADMIN") {
            ?>
            <a class="active" href="access-users.php">Users <span class="badge badge-light"><?php echo $users_count;?></span></a>
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
    <?php
    
        // Checking if act_id is not empty
        if (!empty($_GET['act_id'])) {
            
            // Check if the action is setted 
            if (!empty($_GET['action'])) {
                // Create variables
                $act_id = $_GET['act_id'];

                // Switch actions to be performed
                switch ($_GET['action']) {
                    case 'update':
                        // Officer data selection
                        $us_query = mysqli_query($conn,"SELECT * FROM accounts WHERE id = '$act_id'");
                        $usData = mysqli_fetch_assoc($us_query);
    ?>
    <!-- Form with data of user to update -->
    <div class="form-conatiner">
        <div class="delete-form">
            <a href="access-users.php" class="btn btn-danger">Close</a>
            <h1>Update an user</h1>
            <p>You can only change the user <b>"category"</b> based on security options:</p>
            <form method="post">
                    <div class="form-group">
                        <label for="">Category:</label>
                        <select name="type" class="form-control" required>
                            <option value="" hidden>Category</option>
                            <option value="USER"
                                <?php
                                
                                    // Check if the previous type is
                                    if ($usData['type'] == "USER") {
                                        echo "selected";
                                    }

                                ?>
                            >User</option>
                            <option value="ADMIN"
                                <?php
                                
                                    // Check if the previous type is
                                    if ($usData['type'] == "ADMIN") {
                                        echo "selected";
                                    }

                                ?>
                            >Admin</option>
                        </select>
                    </div>
                <div class="btn-group-horizontal">
                    <button class="btn btn-primary form-control mt-1" type="submit" name="update-user">Update type of user</button>
                </div>
            </form>
        </div>
    </div>
    <?php
                        break;

                    case 'delete':
                        // Officer data selection
                        $us_query = mysqli_query($conn,"SELECT * FROM accounts WHERE id = '$act_id'");
                        $usData = mysqli_fetch_assoc($us_query);
    ?>
    <!-- Form with data of user to delete -->
    <div class="form-conatiner">
        <div class="delete-form">
            <h1>Delete an user</h1>
            <p>By clicking on delete a user data will be non-backuped, so make sure it's right:</p>
            <form method="post">
                <input type="text" name="names" class="form-control" value="<?php echo $usData['names']; ?>" readonly requiered>
                <div class="btn-group-horizontal">
                    <button class="btn btn-danger form-control mt-1" type="submit" name="delete-user">Delete an user</button>
                    <a href="access-users.php" class="btn btn-primary form-control mt-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php
                        break;
                    
                    default:
                        echo "";
                        break;
                }
            }else{
                // Redirect to access officers with error n:6
                header("location: access-officers.php?error-txt=6");
            }
        }


    ?>
    <div class="tb-elements">
        <div class="container">
            <br><h2>Users Data</h2>
            <p>This section is only for <b>"admin"</b> users can access it for security option:</p><br>
            <div class="table-responsive-sm">          
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>Names</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Birthday</th>
                            <th>Acc. Type</th>
                            <th>Staus</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    
        // Selecting Officers data
        $off_data = mysqli_query($conn,"SELECT * FROM accounts");

        // Checking rows found
        if (mysqli_num_rows($off_data) > 1) {
            while ($data = mysqli_fetch_assoc($off_data)) {
                if ($data['id'] == $id) {
                    echo "";
                }else{
    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['names']; ?></td>
                            <td><?php echo $data['username']; ?></td>
                            <td><?php echo "*** Secured"; ?></td>
                            <td><?php echo $data['birthday']; ?></td>
                            <td><?php echo $data['type']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td>
                                <a href="access-users.php?action=update&act_id=<?php echo $data['id']; ?>" class="btn btn-success">Update</a>
                                <a href="access-users.php?action=delete&act_id=<?php echo $data['id']; ?>" class="btn btn-danger mt-1">Delete</a>
                            </td>
                        </tr>
    <?php
            }
        }
        }else{
    ?>
                        <tr>
                            <td colspan="8" class="text-center">No Users in accounts of the system!</td>
                        </tr>
    <?php
        }
    
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="a-toast">
        Want to logout? <a href="logout.php">Click here</a>
    </div>
<script src="assets/scripts/main.js"></script>
<script src="assets/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>