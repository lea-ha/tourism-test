<?php
session_start();

$mysqli = require __DIR__ . "/dbconnect.php"; 

if(isset($_SESSION["user_id"])){
    $userID = $_SESSION["user_id"];
}

if(isset($_GET['activityID'])){
    $IDname = 'activityID';
    $favID = $_GET['activityID'];
    $tableName = 'user_favactivity';
    unset($_GET['activityID']);
}

if(isset($_GET['restaurantID'])){
    $IDname = 'restaurantID';
    $favID = $_GET['restaurantID'];
    $tableName = 'user_favrestaurant';
    unset($_GET['restaurantID']);
}

if(isset($_GET['cultureID'])){
    $IDname = 'cultureID';
    $favID = $_GET['cultureID'];
    $tableName = 'user_favculture';
    unset($_GET['cultureID']);
}



$mysqli = require __DIR__ . "/dbconnect.php";

    $checkQuery = "SELECT * FROM $tableName WHERE userID = ? AND $IDname = ?";
    $checkStatement = $mysqli->prepare($checkQuery);
    
    if (!$checkStatement) {
        die('Error: ' . $mysqli->error); // Output the error message
    }

    $checkStatement->bind_param("ii", $userID, $favID);
    $checkStatement->execute();
    $checkStatement->store_result();


    if ($checkStatement->num_rows == 0) {
        $alert = "Add to Favorites";
        echo $alert;
    }
