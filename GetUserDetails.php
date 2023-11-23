<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>

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
    #print_r($row);
    
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
            <div class = "container my-5">
                <h2>List of registered users</h2>
                <a class="btn btn-primary" href="" role="button">New User</a>
                <a class="btn btn-primary" href="guideAddTrip.php">Add a trip</a>
                <a class="btn btn-primary" href="editProfile.php">Edit Profile</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mysqli = require __DIR__ . "/dbconnect.php"; 
                        $sql = "SELECT * FROM users";
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

