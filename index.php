<?php
// Initializes session
session_start();
// All the HTML stuff
?>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
        <title>
            Department Of Creative Services
        </title>
        <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>

        <?php
        // Pulls the Navigation top nav layout
        include("navigation.php");
        ?>
        <!--    <div class="topnav">-->
        <!--        <a class="active" href=index.php>Home</a><a href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a-->
        <!--                href=inventory.php>Inventory</a><a href="logout.php">Log Out</a>-->
        <!--    </div>-->
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
            <form action="" method="POST">
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
// Requests the connection to the MySQL database
include("database_connection.php");

// Assigns the username and passwords to variables for later use
$uname = $_POST['username'];
$pswd = $_POST['password'];

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// If form has been submitted, perform action
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /** @var $conn */

    // Cleans the inputs
    $username = mysqli_real_escape_string($conn, $uname);
    $password = mysqli_real_escape_string($conn, $pswd);

    //Performs SQL query
    $query = "SELECT * FROM Users WHERE userName = '$username'";
    $result = mysqli_query($conn, $query);

    // Goes column by column in the Users table to request values.
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION["authentication"] = $row['auth'];
            // Password verification
            if (password_verify($password, $row["pswd"])) {
                // Perform SQL query to determine the level of authentication a user has
                $query2 = "SELECT auth FROM Users WHERE userName = '$username'";
                $authLevel = mysqli_query($conn, $query2);
                // Assigns session variables with username and authentication level.
                $_SESSION["username"] = $username;
                // Redirects user to the check_out page once authentication has been performed
                echo "<script>window.location = 'http://localhost:63342/CPSC445Capstone/check_out.php';</script>";
                exit();
            } else {
                // Warns user of incorrect field entry
                echo '<script>alert("Wrong password")</script>';
            }
        }
    } else {
        // If username does not exist, user login warning will appear.
        echo '<script>alert("User Does Not Exist")</script>';
    }
}