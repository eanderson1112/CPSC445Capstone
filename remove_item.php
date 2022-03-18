<?php
// Initialize Session Variables
session_start();

if (isset($_SESSION["username"]) && $_SESSION['authentication'] == "Admin") {
    $username = $_SESSION["username"];
}
else {
    // Redirects user if no user is logged in
    echo "<script>alert('You are not authorized to access this page'+\r\n+'Redirecting you now...')</script>";
    echo "<script>window.location = 'check_out.php';</script>";
    die();
}
// All the HTML Form elements
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

    <title>
        Department Of Creative Services
    </title>

    <div class="welcome">
        <h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1>
    </div>

    <?php
    // Retrieves the top nav bar layout and links from navigation.php
    include("navigation.php");
    ?>

</head>
<body class="background">
<div class="wrapper2">
    <div class="center2">
        <h3>Please scan the barcode attached to the item you are trying to check out. </h3>
        <form action="" method="POST">
            <label>
                <input type="text"
                       name="barcode" placeholder="Please Scan Item">
            </label>
            <label>
                <input type="submit" class="button2" value="Submit" name="Check_Out">
            </label>
        </form>
    </div>
</div>
</body>
</html>

