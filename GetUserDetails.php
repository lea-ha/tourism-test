<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/userguide.css">


    <title>Document</title>
</head>
<body>

<?php
#class that will get user table details joined with guide, to see if user x is a guide or not, and based
#on that we see which user page they see. maybe'll  need 2 join guide with user_trip la each guide yshuf min
#li aando bel trip.


session_start();
$ID_of_guide = null;

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
    #print_r($row);
    if($row['guideID'] != null){
        $ID_of_guide = $row['guideID'];
    }
    if($row['guideID'] == null){
        ?>
        <div class = "container my-5">
        <h1>Welcome to the Regular User Profile Page</h1>
        </br>
        <img src='pics/caf.jpg'></img>
        </br></br></br></br></br></br>
        <h2>Your Favorites</h2>
        <?php
        $qActivity = "SELECT * FROM user_favActivity, activity WHERE userID=$_SESSION[user_id] AND user_favActivity.activityID = activity.activityID";
        $qCulture = "SELECT * FROM user_favCulture, culture WHERE userID=$_SESSION[user_id] AND user_favCulture.cultureID = culture.cultureID";
        $qResto = "SELECT * FROM user_favRestaurant, restaurant WHERE userID=$_SESSION[user_id] AND user_favRestaurant.restaurantID = restaurant.restaurantID";
        $resA = $mysqli->query($qActivity);
        $resC = $mysqli->query($qCulture);
        $resR = $mysqli->query($qResto);
        echo"<div class='place-container'>";
        while($row = $resA->fetch_assoc()){
            echo"<div class='place'>
            <h2>{$row['name']}
            <img src='{$row['picture']}' alt='{$row['name']}'>
            </h2>
            </div>
            ";
        }
        while($row = $resR->fetch_assoc()){
            echo"<div class='place'>
            <h2>{$row['name']}
            <img src='{$row['picture']}' alt='{$row['name']}'>
            </h2>
            </div>
            ";
        }
        while($row = $resC->fetch_assoc()){
            echo"<div class='place'>
            <h2>{$row['name']}
            <img src='{$row['picture']}' alt='{$row['name']}'>
            </h2>
            </div>
            ";
        }
        echo"</div>";
        ?>
        <h2>The trips you are registered to are</h2>
        <table class="table">
                    <thead>
                    <tr>
                        <th>Trip</th>
                        <th>Guide Name</th>
                        <th>Guide Phone Number</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $mysqli = require __DIR__ . "/dbconnect.php"; 
                    $sql = "SELECT DISTINCT trip.tripID, trip_name, guideID, first_name, last_name, phone_number FROM user_trip, trip, users WHERE users.userID = user_trip.userID AND users.userID = trip.guideID";
                        $res = $mysqli->query($sql);

                        if(!$res){
                            die("error : " . $mysqli->error);
                        }
                        while($row = $res->fetch_assoc()){
                            echo "
                            <tr>
                                <td>$row[trip_name]</td>
                               <td>$row[first_name] $row[last_name]</td>
                               <td>$row[phone_number]</td>
                               <td>
                                    <a class = 'btn btn-danger btn-sm' href='usercancelsreg.php?tripID=$row[tripID]'>Cancel Registration</a>
                               </td>

                            </tr>";
                        }

                     ?>
                    </tbody>
        </table>
        </div>
            
        
        
        <?php 
    } else {
        ?>
        <div>
            <div class = "container my-5">
            <h1>Welcome to the Guide Profile Page</h1>
            </br>
            <img src='pics/caf.jpg'></img>
            </br></br></br></br></br></br>
            <?php
            echo"<a class='btn btn-primary' href='guideAddTrip.php?guideID=$ID_of_guide'>Add a trip</a>";
            ?>
                <!--<a class="btn btn-primary" href="guideAddTrip.php?">Add a trip</a>-->
                <a class="btn btn-primary" href="editProfile.php">Edit Profile</a>
                <br>
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Trip Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mysqli = require __DIR__ . "/dbconnect.php"; 
                        $sql = "SELECT DISTINCT trip_name,tripID FROM trip WHERE guideID = $ID_of_guide;";
                        $res = $mysqli->query($sql);

                        if(!$res){
                            die("error : " . $mysqli->error);
                        }
                        
                        while($row = $res->fetch_assoc()){
                            echo "
                            <tr>
                               <td>$row[trip_name] </td>
                               <td>
                                <a class = 'btn btn-primary btn-sm' href='guideEditTrip.php?tripID=$row[tripID]'>Edit Trip</a>
                                <a class = 'btn btn-danger btn-sm'>Delete Trip</a>
                               </td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                </table>
                <br>
                <h2>List of registered users for each trip</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Trip</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mysqli = require __DIR__ . "/dbconnect.php"; 
                        $sql = "SELECT users.userID, users.first_name, users.last_name, users.phone_number, users.email, trip_name FROM users, user_trip, trip WHERE users.userID = user_trip.userID AND trip.guideID = $ID_of_guide";
                        $res = $mysqli->query($sql);

                        if(!$res){
                            die("error : " . $mysqli->error);
                        }
                        
                        while($row = $res->fetch_assoc()){
                            echo "
                            <tr>
                               <td>$row[first_name] $row[last_name]</td>
                               <td>$row[email]</td>
                               <td>$row[phone_number]</td>
                               <td>$row[trip_name]</td>

                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div><!-- hayda lezim ysir dynamic-->
            
        </div>
        <?php 
    }
} else {
    print_r("Error: " . mysqli_error($mysqli));
}
?>
</body>
</html>

