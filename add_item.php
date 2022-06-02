<?php
//Initialize Session Variables
if(!isset($_SESSION))
{
    session_start();
}

//Identifies the user who is logged in, and confirms their permissions level
if (isset($_SESSION["username"]) && $_SESSION['authentication'] == "Admin") {
    $username = $_SESSION["username"];
}
else {
    //Redirects user if no user is logged in\
    echo '<script>alert("You are not authorized to access this page\n\nRedirecting you now...")</script>';
    echo "<script>window.location = 'check_out.php';</script>";
    die();
}

//All the HTML Form elements
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
    //Retrieves the top nav bar layout and links from navigation.php
    include("navigation.php");
    ?>
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
                <label>
                    <input type="text" id="serialNum" name="serialNum" value="serialID" placeholder="Serial Number">
                </label>
                <label>
                    <input type="number" id="specialCount" name="specialCount" value="specialValue" placeholder="If item falls below value: "
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

//Establishes connection to the database
include("database_connection.php");

//Checks to see if a user has specified an item within the form
if (isset($_POST['AddItem'])){

    //Adds easy to use variable names for later
    $productName = $_POST['itemName'];
    $productCount = $_POST['amount'];
    $warrantyStatus = $_POST['warrantyStatus'];

    //Sets the warranty status option as a boolean based off of user input
    if ($warrantyStatus = "yes"){
        $warrantyStatus = TRUE;
    }
    else {
        $warrantyStatus = FALSE;
    }

    //Searches for an item within the Inventory table
    $query = "SELECT * FROM Inventory WHERE productName = '".$productName."'";
    /** @var $conn */
    $result = mysqli_query($conn, $query);

    //If there are duplicates simply update the count of a product within the database
    if(mysqli_num_rows($result) > 0) {
        $updatedAvailability = null;

        //Fetches variable association so that we can add to the product count
        while ($row = mysqli_fetch_assoc($result)) {
            $updatedAvailability = $row['availability'] + $productCount;
        }

        //Triggers the table to update values
        $query2 = "UPDATE Inventory SET availability = $updatedAvailability WHERE productName = '".$productName."'";
        $result2 = mysqli_query($conn, $query2);
        echo "<script>alert('Item Added To Database')</script>";
    }
    else {
        //If this item does not exist already, it is then added to the database
        $sql = "INSERT INTO Inventory VALUES (itemID, '$productName', $warrantyStatus, $productCount)";
        $result3 = mysqli_query($conn, $sql);
        echo "<script>alert('Item Added To Database')</script>";
    }
}