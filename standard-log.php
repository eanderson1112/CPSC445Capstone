<?php
include("display_log_standard.php");

if(!isset($_SESSION))
{
    session_start();
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    echo ("Entered If Statement \n Session ID set");
} else {
    echo ("Entered else statement");
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
<div class="wrapper3">
    <div class="center3">
        <div class="container2">
            <table>
                <thead>
                <th class="width5">Item ID</th>
                <th class="width5">Product Name</th>
                <th class="width5">Check Out Date</th>
                <th class="width5">Check In Date</th>
                </thead>
                <tbody>
                <?php
                /** @var $fetchData */
                if (is_array($fetchData)){
                    $itemID = 1;
                    foreach ($fetchData as $data) {
                        date_default_timezone_set("America/New_York")
                        ?>
                        <tr>
                            <td><?php echo $data['itemID']; ?></td>
                            <td><?php echo $data['productName']; ?></td>
                            <td><?php echo date_format(date_create($data['checkOutDate']),"d-M, Y g:i A"); ?></td>
                            <td><?php if ($data['checkInDateTime'] == NULL) {
                                    echo "<i style='color: red'>Checked Out</i>";
                                } else {
                                    echo date_format(date_create($data['checkInDateTime']), "d-M, Y g:i:s A");
                                } ?></td>
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