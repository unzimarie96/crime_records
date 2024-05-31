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
    <title>Officers Panel | CRIME System</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>
    <div class="header">
        <a href="#" class="logo">CRIMeSystem</a>
        <div class="header-right">
            <a href="index.php">Home</a>
            <a class="active" href="access-officers.php">Officers <span class="badge badge-light"><?php echo $off_count;?></span></a>
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
                        $off_query = mysqli_query($conn,"SELECT * FROM officers WHERE id = '$act_id'");
                        $offData = mysqli_fetch_assoc($off_query);
    ?>
    <!-- Form with data of officer to update -->
    <div class="form-conatiner">
        <div class="update-form">
            <a href="access-officers.php" class="btn btn-danger">Close</a>
            <h1>Update officer</h1>
            <p>By changing this information you're genuine confrimed that real data changed:</p>
            <form method="post">
                <div class="br-border">
                    <div class="form-group">
                        <label for="">Names:</label>
                        <input type="text" name="names" value="<?php echo $offData['names']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Gender:</label>
                        <input type="text" name="gender" value="<?php echo $offData['gender']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" name="email" value="<?php echo $offData['email']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Address:</label>
                        <input type="text" name="address" value="<?php echo $offData['address']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Birthday:</label>
                        <input type="date" name="dob" value="<?php echo $offData['dob']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Rank:</label>
                        <input type="text" name="rank" value="<?php echo $offData['rank']; ?>" class="form-control" required>
                    </div>
                </div>
                <button class="btn btn-primary form-control m" type="submit" name="update-officer">Update Information</button>
            </form>
        </div>
    </div>
    <?php
                        break;

                    case 'delete':
                        // Officer data selection
                        $off_query = mysqli_query($conn,"SELECT * FROM officers WHERE id = '$act_id'");
                        $offData = mysqli_fetch_assoc($off_query);
    ?>
    <!-- Form with data of officer to update -->
    <div class="form-conatiner">
        <div class="delete-form">
            <h1>Delete an officer</h1>
            <p>By clicking on <b>Delete an officer</b>, the crimes that are linked on also will be deleted: </p>
            <form method="post">
                <input type="text" name="off_id" class="form-control text-dark" value="<?php echo $offData['names']; ?>" readonly requiered>
                <div class="btn-group-horizontal">
                    <button class="btn btn-danger form-control mt-1" type="submit" name="delete-officer">Delete an officer</button>
                    <a href="access-officers.php" class="btn btn-primary form-control mt-1">Cancel</a>
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
            <br><h2>Officers Data</h2>
            <p>All the information found in these table are not genuine so that they are used in system:</p><br>
            <div class="table-responsive-sm">          
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>Names</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Birthday</th>
                            <th>Rank</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    
        // Selecting Officers data
        $off_data = mysqli_query($conn,"SELECT * FROM officers");

        // Checking rows found
        if (mysqli_num_rows($off_data) > 0) {
            while ($data = mysqli_fetch_assoc($off_data)) {
    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['names']; ?></td>
                            <td><?php echo $data['gender']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['address']; ?></td>
                            <td><?php echo $data['dob']; ?></td>
                            <td><?php echo $data['rank']; ?></td>
                            <td>
                                <a href="access-officers.php?action=update&act_id=<?php echo $data['id']; ?>" class="btn btn-success">Update</a>
                                <a href="access-officers.php?action=delete&act_id=<?php echo $data['id']; ?>" class="btn btn-danger mt-1">Delete</a>
                            </td>
                        </tr>
    <?php
            }
        }else{
    ?>
                        <tr>
                            <td colspan="8" class="text-center">No officers in system!</td>
                        </tr>
    <?php
        }
    
    ?>
                        <form method="post">
                            <tr>
                                <td><i>NOT NULL</i></td>
                                <td><input type="text" name="names" placeholder="Names:" class="form-control" required></td>
                                <td><input type="text" name="gender" placeholder="Gender:" class="form-control" required></td>
                                <td><input type="email" name="email" placeholder="Email:" class="form-control" required></td>
                                <td><input type="text" name="address" placeholder="Address:" class="form-control" required></td>
                                <td><input type="date" name="dob" class="form-control" required></td>
                                <td><input type="text" name="rank" placeholder="Rank:" class="form-control" required></td>
                                <td><button type="submit" name="add-officer" class="btn btn-primary">Add</button></td>
                            </tr>
                        </form>
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