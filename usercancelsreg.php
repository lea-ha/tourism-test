<?php
session_start();

$mysqli = require __DIR__ . "/dbconnect.php"; 

if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $sql = "DELETE * FROM user_trip WHERE userID = $id";
    $mysqli->query($sql);
    print_r($id);
}
else {
    // Handle error
    echo "Error in prepared statement: " . $mysqli->error;
}
header("location: index.php");
exit;
?>