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
    session_start();
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    } else {
        echo "<script>window.location = 'http://localhost:63342/CPSC445Capstone/index.php';</script>";
        die();
    }
    ?>

    <!--    <div class="topnav">-->
<!--        <a href=index.php>Home</a><a href=check_out.php>Check Out</a><a class="active" href=check_in.php>Check In</a><a href=inventory.php>Inventory</a>-->
<!--    </div>-->
</head>

<body class="background">

</body>

</html>

<?php
