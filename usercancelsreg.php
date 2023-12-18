<?php
//header("Cache-Control: no-cache, no-store, must-revalidate");
session_start();


$mysqli = require __DIR__ . "/dbconnect.php"; 

if(isset($_GET['tripID'])){
    $tripID = $_GET['tripID'];
    unset($_GET['tripID']);
}

if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $sql = "DELETE FROM user_trip WHERE userID = $id AND tripID = $tripID"; 
    $mysqli->query($sql);
    print_r($id);
}
else {
    // Handle error
    echo "Error in prepared statement: " . $mysqli->error;
}
header("location: GetUserDetails.php");
exit;
?>