<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    echo "<script>window.location = 'http://localhost:63342/CPSC445Capstone/index.php';</script>";
}
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
$barcode_value = $_POST['barcode'];
echo("Barcode Value: " . $barcode_value);
//echo(session_id());

include("database_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['barcode'] != NULL) {
        $sql = "SELECT * FROM Inventory WHERE itemID = $barcode_value";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $itemID_result = $row['itemID'];
                $productName_result = $row['productName'];
                $availability_result = $row['availability'];
                echo "id: " . $row["itemID"] . " - Product Name: " . $row["productName"] . " Product Availability: " . $row["availability"] . "<br>";
            }
        } else {
            echo "0 results";
        }

//        $itemID_result = mysqli_query($conn, $itemID_query);
//        $productName_query = "SELECT productName FROM Inventory WHERE itemID = $barcode_value";
//        $productName_result = mysqli_query($conn, $productName_query);

        if ($barcode_value == $itemID_result) {
            $username = $_SESSION['username'];
            $sql_query = "SELECT * FROM Users WHERE userName = $username";
            $result2 = mysqli_query($conn, $sql_query);
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
        } else {
            echo "0 results";
        }

        $sql = "INSERT INTO Log VALUES(NULL, $itemID_result, '$productName_result', current_date, '$username', '$fName', '$lName', '$email', '$phone')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        if ($availability_result <= 0) {
            echo "<script> alert('This item is currently unavailable')</script>";
        } else {
            $availability_result -= 1;
            echo("Current Count: " . $availability_result);
            $update_count = "UPDATE Inventory SET availability = $availability_result WHERE itemID = $barcode_value";
            mysqli_query($conn, $update_count);
        }
    } else {
        echo "<script> location.href='check_out.php'; </script>";
        exit();
    }
}
mysqli_close($conn);