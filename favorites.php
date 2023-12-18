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
        
        $insertQuery = "INSERT INTO $tableName (userID, $IDname) VALUES (?, ?)";
        $insertStatement = $mysqli->prepare($insertQuery);

        if (!$insertStatement) {
            die('Error: ' . $mysqli->error); // Output the error message
        }

        $insertStatement->bind_param("ii", $userID, $favID);

        if ($insertStatement->execute()) {
            $alert = "Added to favorites!";
            echo $alert;
        } else {
            $alert = "Unable to add, Try again later";
            echo $alert;
        }

        $insertStatement->close();
    } else {
        $alert =  "Add to Favorites";
        echo $alert;
    }
    if($checkStatement->num_rows>0){
        $mysqli = require __DIR__ . "/dbconnect.php"; 
        $sql = "DELETE FROM $tableName WHERE userID = $userID AND $IDname = $favID";
        $mysqli->query($sql);
    }

    $checkStatement->close();
    $mysqli->close();

    //REMOVE COMMENT AFTER TESTING !!!!!!

    //header('location: index.php');
    //exit;


?>
