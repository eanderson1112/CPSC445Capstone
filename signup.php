<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>
        Department Of Creative Services
    </title>
    <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>
    <div class="topnav">
        <a href=index.php>Home</a>
        <a href=check_out.php>Check Out</a>
        <a href=check_in.php>Check In</a>
        <a href=inventory.php>Inventory</a>
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

<script>
    const myInput = document.getElementById("psw");
    const letter = document.getElementById("letter");
    const capital = document.getElementById("capital");
    const number = document.getElementById("number");
    const length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function () {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function () {
        document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function () {
// Validate lowercase letters
        const lowerCaseLetters = /[a-z]/g;
        if (myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

// Validate capital letters
        const upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

// Validate numbers
        const numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

// Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
</script>

<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$uname = $_POST['username'];
$pswd = $_POST['password'];

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

echo "Connected successfully";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    $sql = "INSERT INTO Users VALUES ('$uname','$fname', '$lname', '$email', '$pswd', '$phone')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
mysqli_close($conn);
?>

