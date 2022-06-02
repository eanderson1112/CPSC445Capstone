<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>navigation</title>
</head>
</html>
<?php

// Connects to the database
include("database_connection.php");
//echo($_SESSION['username']);
//echo("Authentication Status".$_SESSION['authentication']);
$auth_status = $_SESSION['authentication'];
// Initialize Session
if(!isset($_SESSION))
{
    session_start();
}
$loginst = NULL;

////Checks to see if a username that is logged in the $_SESSION['username'] is in the database
if (isset($_SESSION["username"])) {
    if ($auth_status == 'Standard' ) {
        $loginst = 1;
//        echo "loginst = ".$loginst;
    }
    else if ($auth_status == 'Admin') {
        $loginst = 2;
//        echo "loginst = ".$loginst;
    }
    else {
        $loginst = 0;
//        echo "loginst = ".$loginst;
        echo "<script>window.location = 'index.php';</script>";
        die();
    }
}

// Determines the corresponding look to give to a certain user
if ($loginst == 1) { ?>
    <div class="topnav">
        <a href="check_out.php">Check Out</a>
        <a href="check_in.php">Check In</a>
        <a href="standard-log.php">Log</a>
        <a href="inventory.php">Inventory</a>
        <a href="logout.php">Sign Out</a>
    </div>
    <?php
}
else if ($loginst == 2) { ?>
    <div class="topnav">
        <a href="check_out.php">Check Out</a>
        <a href="check_in.php">Check In</a>
        <a href="admin-log.php">Log</a>
        <a href="inventory.php">Inventory</a>
        <a href="add_item.php">Add Item</a>
        <a href="remove_item.php">Remove Item</a>
        <a href="logout.php">Sign Out</a>
    </div>
    <?php
} else {
    // This is the look for users who are not logged in
    ?>
<!--    <div class="topnav">-->
<!--        <a href="mailto:me@elijahanderson.info">Email</a>-->
<!--    </div>-->
<?php } ?>