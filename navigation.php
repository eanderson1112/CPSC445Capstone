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
echo($_SESSION['username']);

// Initialize Session
session_start();

//Checks to see if a username that is logged in the $_SESSION['username'] is in the database
$loginst = 0;

if ($_SESSION['username']) {
    $user_check = $_SESSION['username'];
    $ses_sql = mysqli_query($database, "SELECT userName FROM Users WHERE userName='$user_check'");
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
    ?>
    <br>
        <?php
    $raw_sql="SELECT userName FROM Users WHERE userName='$user_check'";
    echo $raw_sql;
    ?>
    <br>
        <?php
    echo ("Username: ".$_SESSION['username']);
    $login_user = $row['username'];

    if (!empty($login_user)) {
        $loginst = 1;
    }

}

// Determines the corresponding look to give to a certain user
if ($loginst == 1) { ?>
<!--    <link rel="stylesheet" href="style.css">-->
    <div id="topnav">
        <a href="check_out.php">Check Out</a>
        <a href="check_in.php">Check In</a>
        <a href="inventory.php">Inventory</a>
        <a href="logout.php">Sign Out</a>
    </div>

<?php } else {
    // This is the look for users who are not logged in
//    echo($_SESSION['username'])}
    ?>
    <div id="topnav">
        <a href="index.php">Login</a>
        <a href="signup.php">Sign Up</a>
    </div>
<?php } ?>