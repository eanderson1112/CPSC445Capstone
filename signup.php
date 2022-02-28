<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>
        Department Of Creative Services
    </title>
    <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>
    <div class="topnav">
        <a href=index.php>Home</a><a href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a
                href=inventory.php>Inventory</a>
    </div>
</head>
<body class="background">
<div class="wrapper2">
    <div class="center2"><h2>Sign Up</h2>
        <h4>Please enter all the requested information</h4>
        <form action="" method="POST" autocomplete="on">
            <label>
                <input type="text"
                       name="fname" placeholder="First Name" required>
            </label>
            <label>
                <input type="text"
                       name="lname" placeholder="Last Name" required>
            </label>
            <br><br>
            <label>
                <input type="email"
                       name="email" placeholder="Email" required>
            </label>
            <label>
                <input type="tel"
                       name="phone" placeholder="Phone Number" required>
            </label>
            <br><br>
            <label>
                <input type="text"
                       name="username" placeholder="Username" required>
            </label>
            <label>
                <input type="password"
                       name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                       required>
            </label>
            <br><br>
            <input type="submit" class="button" value="Submit" name="Submit">
        </form>
    </div>
</div>
</body>
</html>

<?php
$fName = $_POST['fname'];
$lName = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$uname = $_POST['username'];
$pswd = $_POST['password'];
$salt = PASSWORD_DEFAULT;
$hashPass = password_hash($pswd, $salt);

include('database_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    $sql = "INSERT INTO Users VALUES ('$uname','$fName', '$lName', '$email', '$hashPass', '$salt', '$phone')";

if (mysqli_query($conn, $sql)) {
//    echo "New record created successfully";
    echo "<script>window.location = 'http://localhost:63342/CPSC445Capstone/index.php';</script>";
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
