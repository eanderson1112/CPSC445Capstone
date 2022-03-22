<?php
// Initialize Session Variables
session_start();

if (isset($_SESSION["username"]) && $_SESSION['authentication'] == "Admin") {
    $username = $_SESSION["username"];
}
else {
    // Redirects user if no user is logged in
    echo "<script>alert('You are not authorized to access this page'+\r\n+'Redirecting you now...')</script>";
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

    <div class="welcome">
        <h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1>
    </div>

    <?php
    // Retrieves the top nav bar layout and links from navigation.php
    include("navigation.php");
    include("database_connection.php");

    $query = "SELECT productName FROM Inventory";
    $result = mysqli_query($conn, $query);
    ?>

</head>
<body class="background">
<div class="wrapper2">
    <div class="center2">
        <h3>Please choose an item you would like to remove. </h3>
        <form action="" method="POST">
            <label>
                <select name="productName">
                    <?php
                    while ($final_result = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $final_result["productName"];
                    // The value we usually set is the primary key
                    ?>">
                        <?php echo $final_result["productName"];
                        // To show the product name name to the user
                        ?>
                    </option>
                    <?php
                    endwhile;
                    // While loop must be terminated
                    ?>
                </select>

            </label>
            <label>
                <input type="number" id="amount" name="amount" value="amount" placeholder="Count">
            </label>
            <br><br>
            <label>
                <input class="button3" type="submit" value="Remove Selected" name="RemoveSelected">
            </label>
            <label>
                <input class="button4" type="submit" value="Remove All" name="RemoveAll">
            </label>
            <br><br>
        </form>
    </div>
</div>
</body>
</html>

<?php
include("database_connection.php");
//echo $productNameValue;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['RemoveSelected'])) {

        $productNameValue = $_POST['productName'];
        $removeAmount = $_POST['amount'];
        $updatedCount = Null;
//        echo("Remove Selected Option Selected");
        $query1 = "SELECT * FROM Inventory WHERE productName = '" . $productNameValue . "'";
        $result1 = mysqli_query($conn, $query1);
        if (mysqli_num_rows($result1) > 0) {
//            echo("Entered IF");
            while ($row = mysqli_fetch_assoc($result1)) {
                $updatedCount = $row['availability'] - $removeAmount;
//                echo("Updated Count: " . $updatedCount);
            }
//            echo("Updated Count: " . $updatedCount);
//    echo($newCount);

            $query2 = "UPDATE Inventory SET availability = $updatedCount WHERE productName = '" . $productNameValue . "'";
//    echo ($query2);
            $result2 = mysqli_query($conn, $query2);
//    echo ($result2);
//    echo '<script>alert("Item has been deleted successfully\n\nRedirecting you inventory list")</script>';
//    echo '<script>window.location = "inventory.php"</script>';
        }
    }
    else if(isset($_POST['RemoveAll'])){

        $productNameValue = $_POST['productName'];
        $removeAmount = $_POST['amount'];

//        echo("Remove All Button Selected");
        $delete_query = "DELETE FROM Inventory WHERE productName = '" . $productNameValue . "'";
//        echo("\nDelete Query: ".$delete_query);
        $result3 = mysqli_query($conn, $delete_query);
//        echo("\nResult3: ".mysqli_num_rows($result3));
    }
}