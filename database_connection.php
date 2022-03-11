<?php
$servername = "localhost:3306";
$database = "Inventory";
$username = "root";
$password = "Beagle26!";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

