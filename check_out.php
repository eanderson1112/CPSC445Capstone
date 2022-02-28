<?php
session_start();
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
    <!--    <div class="topnav">-->
<!--        <a href=index.php>Home</a><a class="active" href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a href=inventory.php>Inventory</a>-->
<!--    </div>-->
</head>

<body class="background">

</body>
<div class="wrapper2">
    <div class="center2">
        <h3>Please scan the barcode attached to the item you are trying to check out. </h3>
        <form action="check_out.php" method="post">
            <label>
                <input type="text"
                       name="barcode" placeholder="Please Scan Item"></label><label>
                <input type="submit" class="button2" value="Submit" name="login">
            </label>
            <br><br>
    </div>
</div>
</html>

<?php
$barcode_value = $_POST['barcode'];

//echo(session_id());

include("database_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "SELECT itemID, productName FROM Inventory";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtain value of each column
        while ($row = $result->fetch_assoc()) {
            $itemID = $row["itemID"];
            $productName = $row["productName"];
        }
    } else {
        echo "0 results";
    }

    if ($barcode_value == $productName) {
        $sql = "INSERT INTO Log VALUES(NULL, $itemID, '$productName', current_date, 'username', 'fname', 'lname', 'email', 'phone')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else {
        echo "<script> location.href='https://gocoastal.org'; </script>";
        exit();
    }
}
mysqli_close($conn);