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
        ?>
        <h1>Welcome to the Regular User Profile Page</h1>
        <h2>The trips you are registered to are</h2>
            <?php #write code to see which trips user with id in session is registered to ?>
        
        
        <?php 
    } else {
        ?>
        <div>
            <h1>Welcome to the Guide Profile Page</h1>
            <h2>The users registered for trip Chouf tour are : </h2> <!-- hayda lezim ysir dynamic-->
            
        </div>
        <?php 
    }
} else {
    print_r("Error: " . mysqli_error($mysqli));
}

