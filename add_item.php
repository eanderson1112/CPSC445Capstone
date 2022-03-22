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
                <input type="submit" class="button" value="Submit" name="AddItem">
                <input type="reset" class="button3" value="Clear" name="ClearFields">
            </form>
        </div>
    </div>
</body>
</html>

<?php

include("database_connection.php");

if (isset($_POST['AddItem'])){
    $productName = $_POST['itemName'];
    $productCount = $_POST['amount'];
    $warrantyStatus = $_POST['warrantyStatus'];

    if ($warrantyStatus = "yes"){
        $warrantyStatus = TRUE;
    }
    else {
        $warrantyStatus = FALSE;
    }

//    echo("Submit Button Selected");

    $query = "SELECT * FROM Inventory WHERE productName = '".$productName."'";
    /** @var $conn */
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $updatedAvailability = null;
        while ($row = mysqli_fetch_assoc($result)) {
            $updatedAvailability = $row['availability'] + $productCount;
//            echo("Updated Availability: ".$updatedAvailability);
        }
//        echo("Updated Availability: ".$updatedAvailability);
        $query2 = "UPDATE Inventory SET availability = $updatedAvailability WHERE productName = '".$productName."'";
        $result2 = mysqli_query($conn, $query2);

    }
    else {
        $sql = "INSERT INTO Inventory VALUES (itemID, '$productName', $warrantyStatus, $productCount)";
        $result3 = mysqli_query($conn, $sql);
//        echo("Result3: ".$result3);
        echo "<script>alert('Item Added To Database')</script>";
    }
}
//else {
//    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//}