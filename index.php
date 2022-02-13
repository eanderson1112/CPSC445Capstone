<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>
        Department Of Creative Services
    </title>
    <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>
    <div class="topnav">
        <a class="active" href=index.php>Home</a><a href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a href=inventory.php>Inventory</a>
    </div>
</head>
<body class="background">
<div class="wrapper">
    <div class="left">
        <h2>A couple of things you can do here</h2>
        <h4>
            <ul>
                <li>View available gear</li>
                <li>Check out items to use</li>
                <li>Check in items</li>
                <li>Check on item status</li>
            </ul>
        </h4>
    </div>
    <div class="right"><h2>LET'S GET STARTED</h2>
        <h4>Please enter your username and password</h4>
        <form action="index.php" method="post">
            <label>
                <input type="text"
                       name="username" placeholder="Username">
            </label>
            <br><br>
            <label>
                <input type="password"
                       name="password" placeholder="Password">
            </label>
            <br><br>
            <input type="submit" class="button" value="Submit" name="login">
        </form>
        <div class="link"><a style="text-decoration:none" href="signup.php">Sign Up!</a></div>
        <br></div>
</div>
</body>
</html>

<?php

$uname = $_POST['username'];
$pswd = $_POST['password'];

$servername = "localhost:3306";
$username = "root";
$password = "Beagle26!";

//// Define variables and initialize with empty values
//$username = $password = $confirm_password = "";
//$username_err = $password_err = $confirm_password_err = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//if ($_SERVER['REQUEST_METHOD'] == 'POST')




