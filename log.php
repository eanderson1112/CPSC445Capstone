<?php
include("display_log.php");

session_start();

if (isset($_SESSION["username"]) && $_SESSION['authentication'] == "Admin") {
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
    <!--    <div class="topnav">-->
    <!--        <a href=check_out.php>Home</a><a href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a-->
    <!--                class="active" href=inventory.php>Inventory</a>-->
    <!--    </div>-->
</head>

<body class="background">
<div class="wrapper3">
    <div class="center3">
        <div class="container2">
            <table>
                <thead>
                <th class="width1">Item ID</th>
                <th class="width2">Product Name</th>
                <th class="width5">Check Out Date</th>
                <th class="width5">Check In Date</th>
                <th class="width5">First Name</th>
                <th class="width5">Last Name</th>
                <th class="width5">Email</th>
                <th class="width3">Phone</th>
                </thead>
                <tbody>
                <?php
                /** @var $fetchData */
                if (is_array($fetchData)){
                    $itemID = 1;
                    foreach ($fetchData as $data) {
                        ?>
                        <tr>
                            <td><?php echo $itemID; ?></td>
                            <td><?php echo $data['productName']; ?></td>
                            <td><?php echo $data['checkOutDate']; ?></td>
                            <td><?php echo $data['checkInDate']; ?></td>
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
</body>

</html>