<?php
#class that will get user table details joined with guide, to see if user x is a guide or not, and based
#on that we see which user page they see. maybe'll  need 2 join guide with user_trip la each guide yshuf min
#li aando bel trip.


session_start();

if(isset($_SESSION['user_id'])){
    #print_r($_SESSION['user_id']); //working
} 

$mysqli = require __DIR__ . "/dbconnect.php"; 

$sql = "SELECT users.*, guide.* 
FROM users
LEFT JOIN guide on USERS.userID = GUIDE.userID
WHERE USERS.userID = {$_SESSION["user_id"]}";

$result = $mysqli->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    print_r($row);
    if($row['guideID'] == null){
        print_r("This user is a regular user and should be redirected to the user profile page");
    } else {
        print_r("This user is a guide and should be redirected to the guide profile page");
    }
} else {
    print_r("Error: " . mysqli_error($mysqli));
}

