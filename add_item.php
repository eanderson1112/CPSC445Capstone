<?php
// Initialize Session Variables
session_start();

if (isset($_SESSION["username"]) && $_SESSION['authentication'] == "Admin") {
    $username = $_SESSION["username"];
}
else {
    // Redirects user if no user is logged in\
    echo '<script>alert("You are not authorized to access this page\n\nRedirecting you now...")</script>';
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
    <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>

    <?php
    // Retrieves the top nav bar layout and links from navigation.php
    include("navigation.php");
    ?>
    <!--    <div class="topnav">-->
<!--        <a href=index.php>Home</a><a href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a href=inventory.php>Inventory</a>-->
<!--    </div>-->
</head>
<body class="background">
    <div class="wrapper2">
        <div class="center2">
            <h3>Let's add an item</h3>
            <form action="add_item.php" method="post">
            <label>
                <input type="text" placeholder="Product Name" name="itemName">
            </label>
                <label>
                <input type="number" id="amount" name="amount" value="amount" placeholder="Count">
                </label>
                    <br><br>
                <p>Is this product under warranty?</p>
                <input type="radio" id="yes" name="warrantyStatus" value="yes">
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="warrantyStatus" value="no">
                <label for="no">No</label><br>
                <br>
                <br><br>
                <input type="submit" class="button" value="Submit" name="Add Item">
                <input type="reset" class="button3" value="Clear" name="Clear Fields">
            </form>
        </div>
    </div>
</body>
</html>

<?php

$productName = $_POST['itemName'];
$productCout = $_POST['amount'];
$warrantyStatus = $_POST['warrantyStatus'];

if ($warrantyStatus = "yes"){
    $warrantyStatus = TRUE;
}
else {
    $warrantyStatus = FALSE;
}

include("database_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    $sql = "INSERT INTO Inventory VALUES (itemID, '$productName', $warrantyStatus, $productCout)";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Item Added To Database')</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}