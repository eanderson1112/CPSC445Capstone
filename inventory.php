<?php
include("display_inventory.php");
?>

<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>
        Department Of Creative Services
    </title>
    <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>
    <div class="topnav">
        <a href=check_out.php>Home</a><a href=check_out.php>Check Out</a><a href=check_in.php>Check In</a><a
                class="active" href=inventory.php>Inventory</a>
    </div>
</head>

<body class="background">
<div class="wrapper2">
    <div class="center2">
        <div class="row">
            <div class="container2">
                <table class="table table-bordered">
                    <thead>
                    <th>Item ID</th>
                    <th>Product Name</th>
                    <th>Availability</th>
                    </thead>
                    <tbody>
                    <?php
                    if (is_array($fetchData)){
                        $itemID = 1;
                        foreach ($fetchData as $data) {
                            ?>
                            <tr>
                                <td><?php echo $itemID; ?></td>
                                <td><?php echo $data['productName']; ?></td>
                            </tr>
                            <?php
                            $itemID++;
                        }
                    }else{ ?>
                    <tr>
                        <td colspan="2">
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
</div>
</body>

</html>