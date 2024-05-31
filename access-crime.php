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
    <title>Crimes Panel | CRIME System</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>
    <div class="header">
        <a href="#" class="logo">CRIMeSystem</a>
        <div class="header-right">
            <a href="index.php">Home</a>
            <a href="access-officers.php">Officers <span class="badge badge-primary"><?php echo $off_count;?></span></a>
            <a class="active" href="access-crime.php">Crimes <span class="badge badge-light"><?php echo $crime_count;?></span></a>
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
    <!-- Switch action values -->
    <?php
    
        // Check if the action is not empty
        if (!empty($_GET['action'])) {
            // Assign varibale
            $get_action = $_GET['action'];

            // Switch values
            switch ($get_action) {
                case 'add':
    ?>
    <!-- Adding a crime form -->
    <div class="form-conatiner">
        <div class="update-form">
            <a href="access-crime.php" class="btn btn-danger">Close</a>
            <h1>Add a crime</h1>
            <p>By adding a crime you have to specify the officer investigated it:</p>
            <form method="post">
                <div class="br-border">
                    <div class="form-group">
                        <label for="">Title:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Officer:</label>
                        <select name="officer_id" required class="form-control">
                            <option value="" hidden>Select an officer</option>
    <?php
    
        // Selecting all officers
        $officer_query = mysqli_query($conn,"SELECT * FROM officers");
        $officer_rows = mysqli_num_rows($officer_query);

        // Check the rows founded
        if ($officer_rows > 0) {
            while ($officerData = mysqli_fetch_assoc($officer_query)) {
   ?>
                       <option value="<?php echo $officerData['id']; ?>"><?php echo $officerData['names']; ?></option> 
   <?php
            }
        }else{
    ?>
                        <option value="">No Officer found</option>
    <?php
        }

    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date added:</label>
                        <input type="text" name="date_added" class="form-control" value="Current Time Stamp" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="">Description:</label>
                        <textarea name="description" class="form-control no-resize" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Evidence Img:</label>
                        <input type="text" name="evidence_img" class="form-control" value="No image can be selected based on security option." readonly required>
                    </div>
                </div>
                <button class="btn btn-success form-control m" type="submit" name="add-crime">Add Crime</button>
            </form>
        </div>
    </div>
    <?php
                    break;
                case 'update':
                    // Assign variable
                    $get_id = $_GET['act_id'];
                    // Officer data selection
                    $cr_query = mysqli_query($conn,"SELECT * FROM crimes WHERE idCrime = '$get_id'");
                    $crData = mysqli_fetch_assoc($cr_query);
    ?>
    <!-- Adding a crime form -->
    <div class="form-conatiner">
        <div class="update-form">
            <a href="access-crime.php" class="btn btn-danger">Close</a>
            <h1>Update crime info</h1>
            <p>By changing case info, you're genuine informed that you have case changed:</p>
            <form method="post">
                <div class="br-border">
                    <div class="form-group">
                        <label for="">Title:</label>
                        <input type="text" name="title" value="<?php echo $crData['title']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Officer:</label>
                        <select name="officer_id" required class="form-control">
                            <option value="" hidden>Select an officer</option>
    <?php
    
        // Selecting all officers
        $officer_query = mysqli_query($conn,"SELECT * FROM officers");
        $officer_rows = mysqli_num_rows($officer_query);

        // Check the rows founded
        if ($officer_rows > 0) {
            while ($officerData = mysqli_fetch_assoc($officer_query)) {
    ?>
                        <option value="<?php echo $officerData['id']; ?>" 
                        
                        <?php
                        
                            if ($crData['officer_id'] == $officerData['id']) {
                                echo "selected";
                            }else{
                                echo "";
                            }

                        ?>
                        
                        ><?php echo $officerData['names']; ?></option> 
    <?php
            }
        }else{
    ?>
                        <option value="">No Officer found</option>
    <?php
        }

    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date added:</label>
                        <input type="text" name="date_added" class="form-control" value="Old date setted will be used" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="">Description:</label>
                        <textarea name="description" class="form-control no-resize" rows="5"><?php echo $crData['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Evidence Img:</label>
                        <input type="text" name="evidence_img" class="form-control" value="You can't edit evidence image." readonly required>
                    </div>
                </div>
                <button class="btn btn-success form-control m" type="submit" name="update-crime">Update Crime/case</button>
            </form>
        </div>
    </div>
    <?php
                    break;
                case 'delete':
                    // Assign variable
                    $get_id = $_GET['act_id'];

                    // Officer data selection
                    $cr_query = mysqli_query($conn,"SELECT * FROM crimes WHERE idCrime = '$get_id'");
                    $crData = mysqli_fetch_assoc($cr_query);
    ?>
    <!-- Form with data of crime to delete -->
    <div class="form-conatiner">
        <div class="delete-form">
            <h1>Delete an crime</h1>
            <p>By clicking on <b>Delete an crime</b>, you are surely that a crime case has been closed: </p>
            <form method="post">
                <input type="text" name="title" class="form-control text-dark mt-1" value="<?php echo $crData['title']; ?>" readonly requiered>
                <div class="btn-group-horizontal">
                    <button class="btn btn-danger form-control mt-1" type="submit" name="delete-crime">Close a crime case</button>
                    <a href="access-crime.php" class="btn btn-primary form-control mt-1">Cancel</a>
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
        }
    
    
    ?>
    <div class="crime-box">
        <h2>Crimes Recorded:</h2>
        <a href="access-crime.php?action=add" class="btn btn-success b-toast">Add New Crime</a>
        <p>All crimes recorded in system are added by an user-accounts and are genuine:</p>
        <?php
        
                // Select all crimes in the system
                $cm_query = mysqli_query($conn,"SELECT * FROM crimes");
                $cm_rows = mysqli_num_rows($cm_query);

                // Check rows fetched
                if ($cm_rows > 0) {
        ?>
        <div class="grid-items">
        <?php
                    while ($cmData = mysqli_fetch_assoc($cm_query)) {
                        $off_id = $cmData['officer_id'];
                        // Select all crimes in the system
                        $off_query = mysqli_query($conn,"SELECT * FROM officers WHERE id = '$off_id'");
                        $offData = mysqli_fetch_assoc($off_query);
        ?>
            <div class="item">
                <p>
                    <p><b>#:</b> <?php echo $cmData['idCrime']; ?></p>
                    <p><b>Title:</b> <?php echo $cmData['title']; ?></p>
                    <p><b>Description</b> <?php echo $cmData['description']; ?></p>
                    <p><b>By Officer:</b> <?php echo $offData['names']; ?></p>
                    <p><b>Date added:</b> <?php echo $cmData['date_added']; ?></p>
                    <p>
                        <b>Evidence Img:</b>
                        <?php

                            if ($cmData['evidence_img'] != "") {
                        ?>
                        <a href="view-evidence.php?id=<?php echo $cmData['idCrime']; ?>" class="btn btn-link">view evidence (img)</a>
                        <?php
                            }else{
                                echo "No evidence assigned.";   
                            }
                        
                        ?>
                    </p>
                    <P>
                        <a href="access-crime.php?action=update&act_id=<?php echo $cmData['idCrime']; ?>" class="btn btn-primary">Update</a>
                        <a href="access-crime.php?action=delete&act_id=<?php echo $cmData['idCrime']; ?>" class="btn btn-danger">Delete</a>
                    </P>
                </p>
            </div>
        <?php
                    }
        ?>
        </div>
        <?php
                }else{
        ?>
        <h1 class="text-center">No Crimes in the system.</h1>
        <?php
                }
        
        ?>
    </div>
    <div class="a-toast">
        Want to logout? <a href="logout.php">Click here</a>
    </div>
<script src="assets/scripts/main.js"></script>
<script src="assets/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>