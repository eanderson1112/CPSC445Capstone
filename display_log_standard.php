<?php
session_start();
include("database_connection.php");
/** @var $conn */
$db = $conn;
$tableName = "Log";
$columns = ['checkOutID', 'itemID', 'productName', 'checkOutDateTime', 'checkInDateTime'];
$fetchData = fetch_data($db, $tableName, $columns);

function fetch_data($db, $tableName, $columns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $email = $_SESSION['email'];
        $columnName = implode(", ", $columns);
        $query = "SELECT * FROM Log WHERE email = '".$email."' ORDER BY checkOutID DESC";
        $result = $db->query($query);
        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $msg = $row;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = mysqli_error($db);
        }
    }
    return $msg;
}

