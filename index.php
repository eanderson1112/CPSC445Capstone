<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>
        Department Of Creative Services
    </title>
</head>
<body>
<div class="welcome"><h1>WELCOME TO THE INTERNAL MANAGEMENT SYSTEM</h1></div>
    <p>A couple of things you can do here
    <ul>
        <li>View available gear</li>
        <li>Check out items to use</li>
        <li>Check in items</li>
    </ul>
<div class="right"><h2>LET'S GET STARTED</h2>
    <h4>Please enter your username and password</h4>
    <form class = "form-signin" role = "form"
          action="index.php" method = "post">
        <label>
            <input type = "text" class = "form-control"
                   name = "username" placeholder = "Username"
                   required autofocus>
        </label>
        <label>
            <input type = "password" class = "form-control"
                   name = "password" placeholder = "Password" required autofocus>
        </label>
        <br><br>
        <button type="submit"
                name="login">Login</button>
        <button type="reset"
                name="clear">Clear</button>
    </form>
</body>
</html>

<?php

