<?php
$servername = "gocoastal.org";
$database = "dbbp4diqsg4wen";
$username = "upwmg2keig6pn";
$password = "G0C0astal101";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";