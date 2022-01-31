<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>
        Department Of Creative Services
    </title>
    <div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>
    <div class="topnav">
        <a class="active" href=index.php>Home</a>
        <a href=check_out.php>Check Out</a>
        <a href=check_in.php>Check In</a>
        <a href=inventory.php>Inventory</a>
    </div>
</head>
<div class="box_shadow"><body>
<div class="left">
    <h2>A couple of things you can do here</h2>
    <h3><ul>
        <li>View available gear</li>
        <li>Check out items to use</li>
        <li>Check in items</li>
        </ul></h3>
</div>
<body>
<div class="right"><h2>LET'S GET STARTED</h2>
    <h4>Please enter your username and password</h4>
        <form action="index.php" method="post">

    <label>
            <input type = "text"
                   name = "username" placeholder = "Username"
                   required autofocus>
        </label>
        <br>
        <label>
            <input type = "password"
                   name = "password" placeholder = "Password" required autofocus>
        </label>
        <br><br>
        <input type="submit" class="button"
               name="login"></div>
    </body>
</html>

<?php

