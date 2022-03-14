<?php

// Initialze Session Variables
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    // Redirects user if no user is logged in
    echo "<script>window.location = 'http://localhost:63342/CPSC445Capstone/index.php';</script>";
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

<?php
//Set the barcode_value with value of the POST variable
$barcode_value = $_POST['barcode'];

// Testing purposes
echo("Barcode Value: " . $barcode_value);

// Includes the database connection file to initialize connection with MySQL database
include("database_connection.php");

// Checks to see if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensures that form is not empty and has data
    if ($_POST['barcode'] != NULL) {
        // Performs SQL query to retrieve all needed information from Inventory table
        $sql = "SELECT * FROM Inventory WHERE itemID = $barcode_value";
        /** @var $conn */ //Initialized under database_connection.php
        $result = mysqli_query($conn, $sql);
        // Goes through the rows and pulls data from each column
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $itemID_result = $row['itemID'];
                $productName_result = $row['productName'];
                $availability_result = $row['availability'];
            }
        }

        // Calls the session variable of "username" to determine the user to lookup in "Users" table
        $username = $_SESSION['username'];
        // Performs SQL query
        $sql_query = "SELECT * FROM Users WHERE userName = $username";
        $result2 = mysqli_query($conn, $sql_query);

        // Assigns variables to values pulled from Users Table
        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $fName = $row['fName'];
                echo("fName: " . $fName);
                $lName = $row['lName'];
                echo("lName: " . $lName);
                $email = $row['email'];
                echo("email: " . $email);
                $phone = $row['phone'];
                echo("phone: " . $phone);
                echo("Values Linked");
            }
        }

        // Verifies that count of Inventory is not 0
        if ($availability_result <= 0) {
            echo "<script> alert('This item is currently unavailable')</script>";
            echo "<script>window.location = 'http://localhost:63342/CPSC445Capstone/check_out.php'</script>";
        } else {
            // Inserts values into "Logs" table
            $sql = "INSERT INTO Log VALUES(NULL, $itemID_result, '$productName_result', current_date, '$username', '$fName', '$lName', '$email', '$phone')";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                // Error checking
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            //If values is added, then count is subtracted by 1
            $availability_result -= 1;
            echo("Current Count: " . $availability_result);
            $update_count = "UPDATE Inventory SET availability = $availability_result WHERE itemID = $barcode_value";
            mysqli_query($conn, $update_count);

        }

    } else {
        // Error message if no such value in "Inventory" table exists
        echo("<script>alert('No Item Exists')</script>");
    }
} else {
//    echo "<script> window.location ='check_out.php'; </script>";
    exit();
}
mysqli_close($conn);