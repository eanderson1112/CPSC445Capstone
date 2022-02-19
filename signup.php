<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>
        Department Of Creative Services
    </title>
    <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>
    <div class="topnav">
        <a href=index.php>Home</a><a href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a href=inventory.php>Inventory</a>
    </div>
</head>
<body class="background">
<div class="wrapper2">
    <div class="center2"><h2>Sign Up</h2>
        <h4>Please enter all the requested information</h4>
        <form action="index.php" method="post">
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
                <input type="text"
                       name="email" placeholder="Email" required>
            </label>
            <label>
                <input type="text"
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
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <br><br>
            <input type="submit" class="button" value="Submit" name="Submit">
        </form>
    </div>
</div>
</body>
</html>

<?php
$servername = "localhost:3306";
$database = "Inventory";
$username = "root";
$password = "Beagle26!";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    echo "Connected successfully";
?>
    <br>
<?php
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        echo "CRYPT_BLOWFISH is enabled!";
    }else {
        echo "CRYPT_BLOWFISH is not available";
    }

$fName = $_POST['fname'];
$lName = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$uname = $_POST['username'];
$pswd = $_POST['password'];

$hashPass = password_hash($pswd, PASSWORD_DEFAULT);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "INSERT INTO Users VALUES ('$uname','$fName', '$lName', '$email', '$hashPass', '$phone')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
