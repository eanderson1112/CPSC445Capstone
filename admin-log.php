<?php
//Calls required file to display table for admin view
include("display_log_admin.php");

//Ensures session has started
if(!isset($_SESSION))
{
    session_start();
}

//Identifies the user who is logged in, and confirms their permissions level
if (isset($_SESSION["username"]) && $_SESSION['authentication'] == "Admin") {
    $username = $_SESSION["username"];
} else {
    //If user is not logged in, redirect to login page
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
    //Calls navigation file to display for a specific user type
    include("navigation.php");
    ?>
</head>
<body class="background">
<div class="wrapper3">
    <div class="center3">
        <div class="container2">
            <table>
                <thead>
                <th class="width1">Item ID</th>
                <th class="width5">Product Name</th>
                <th class="width5">Check Out Date</th>
                <th class="width5">Check In Date</th>
                <th class="width4">First Name</th>
                <th class="width4">Last Name</th>
                <th class="width5">Email</th>
                <th class="width4">Phone</th>
                </thead>
                <tbody>
                <?php
                //Fetches data from the table created in the display_admin_log.php file, and extracts the data from the array
                /** @var $fetchData */
                if (is_array($fetchData)){
                    $itemID = 1;
                    foreach ($fetchData as $data) {
                        date_default_timezone_set("America/New_York")
                        ?>
                        <tr>
                            <td><?php echo $data['itemID']; ?></td>
                            <td><?php echo $data['productName']; ?></td>
                            <td><?php echo date_format(date_create($data['checkOutDateTime']), "d-M, Y g:i:s A"); ?></td>
                            <td><?php if ($data['checkInDateTime'] == NULL) {
                                    echo "<i style='color: red'>Checked Out</i>";
                                } else {
                                    echo date_format(date_create($data['checkInDateTime']), "d-M, Y g:i:s A");
                                } ?></td>
                            <td><?php echo $data['fName']; ?></td>
                            <td><?php echo $data['lName']; ?></td>
                            <td><a href="mailto:<?php echo $data['email']; ?>"><?php echo $data['email']; ?></a></td>
                            <td><a href="tel:<?php echo $data['phone']; ?>"><?php echo $data['phone']; ?></a></td>
                        </tr>
                        <?php
                        $itemID++;
                    }
                }else{ ?>
                <tr>
                    <td colspan="9">
                        <?php echo $fetchData; ?>
                    </td>
                <tr>
                    <?php
                    } ?>
                </tbody>
                <br>
            </table>
            <br>
        </div>
    </div>
</div>
</body>

</html>