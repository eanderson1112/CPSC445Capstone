<?php
$servername = "imscapstone.mysql.database.azure.com";
$database = "Inventory";
$username = "CPSC445Student@imscapstone";
$password = "Troop7gator!";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";