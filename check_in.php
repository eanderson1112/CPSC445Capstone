<?php
session_start();
if (isset($_SESSION["username"])) {
$username = $_SESSION["username"];
} else {
echo "<script>window.location = 'index.php';</script>";
die();
}
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
    include("navigation.php");
    ?>

</head>

<body class="background">
<div class="wrapper2">
    <div class="center2">
        <h3>Please scan the barcode attached to the item you are trying to check in. </h3>
        <form action="" method="POST">
            <label>
                <input type="text"
                       name="barcode" placeholder="Please Scan Item">
            </label>
            <label>
                <input type="submit" class="button2" value="Submit" name="Check_In">
            </label>
        </form>
    </div>
</div>
</body>

</html>

<?php

//Set the barcode_value with value of the POST variable
$barcode_value = NULL;
$email = NULL;
$updatedCount = NULL;

if(isset($_POST['Check_In'])) {
    $barcode_value = $_POST['barcode'];
}

$userCheck = $_SESSION["username"];
$authenticationLevel = $_SESSION['authentication'];

// Testing purposes
//echo("\nUsername: ".$userCheck);
//echo("\nBarcode Value: " . $barcode_value);

// Includes the database connection file to initialize connection with MySQL database
include("database_connection.php");

$query = "SELECT * FROM Users WHERE userName = '".$userCheck."'";
/** @var $conn */
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row2 = mysqli_fetch_assoc($result)) {
        $email = $row2['email'];
    }
}

// Checks to see if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ensures that form is not empty and has data
    if ($_POST['barcode'] != NULL) {

        $query2 = "SELECT * FROM Log WHERE itemID = $barcode_value AND email = '".$email."' ORDER BY checkOutDateTime DESC LIMIT 1";
        $result2 = mysqli_query($conn, $query2);

        $checkInDateExists = NULL;

        if (mysqli_num_rows($result2) > 0) {
            while ($row3 = mysqli_fetch_assoc($result2)){
                $checkInDateExists = $row3['checkInDateTime'];
                $productName = $row3['productName'];
                break;
            }
        }
        if (mysqli_num_rows($result2) > 0) {

            $query4 = "SELECT * FROM Inventory WHERE itemID = $barcode_value";
            $result4 = mysqli_query($conn, $query4);

            if (mysqli_num_rows($result4) > 0) {
                if($checkInDateExists == NULL) {

                    $query3 = "UPDATE Log SET checkInDateTime = NOW() WHERE itemID = $barcode_value AND email = '".$email."'";
                    mysqli_query($conn, $query3);

                    while ($row3 = mysqli_fetch_assoc($result4)) {
                        $updatedCount = $row3['availability'] + 1;
                        $query5 = "UPDATE Inventory SET availability = $updatedCount WHERE itemID = $barcode_value";
                        mysqli_query($conn, $query5);
                        echo '<script>alert("Thank you for returning the")</script>';
                    }
                }
                else {
                    echo "Check out date already exists";
                    echo '<script>alert("This item has already been returned")</script>';
                    echo '<script>window.location = "check_in.php"</script>';
                }
            }
        }
        else{
            echo '<script>alert("No record exists for this item/user combination")</script>';
        }
    } else {
        echo '<script>alert("Please scan a barcode or enter a valid value")</script>';
        exit();
    }
}
mysqli_close($conn);
