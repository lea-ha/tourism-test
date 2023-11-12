<?php

#use $mysqli->error on !$result to know what error msg u r getting
#if(!$result){ die("query failed" . $mysqli->error); }
session_start(); #once session started we can store values in the $_session (session superglobal)


if (isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/dbconnect.php"; 
    $sql = "SELECT first_name FROM users WHERE userID = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

}
#print_r($_SESSION);
#print_r($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Home</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <script src="js/DisplayData.js" defer></script>
    <script src ="js/tripsfetch.js" defer></script>

</head>
<body>
    <h1>Home</h1>
    <?php if(isset($user)) : ?>

        <!-- Navigation bar, feel free to edit it completely, classes are from fontawesome, used for displaying icons -->

        <a><button><i class="fa-solid fa-map"></i>       Book a Trip</button></a>
        <a><button><i class="fa-solid fa-user"></i>         My Profile</button></a>
        <p> Hello <?= htmlspecialchars($user["first_name"])?></p>

        <h1>Explore our trips</h1>
        <p>Upcoming trips</p>

        <div class="container" id="container-trip">
            <!-- Related content for trips should be added here, similar to the one for places -->
            
        </div>




        <div class="container" id="container-place">
            <h1>Explore New Places</h1>
            
            <div class="main-places" style="display : flex; gap: 10px;">
                <!-- Testing with sample data without the db, this sample data will be later deleted and content 
                will be rendered using php js mysql... -->
                <a href="culture.html">
                <div class="place" id = "culture">
                    <h3>Heritage & Culture</h3>
                    <img src="pics/baalback-temple.png" style="width: 250px; height: 200px;">
                </div>
                </a>
                <a href="activity.html">
                <div class="place" id = "activity">
                    <h3>Activity</h3>
                    <img src="pics/paragliding.png" style="width: 250px; height: 200px;">
                </div>
                </a>
                <a href="restaurant.html"> <!--area of code under testing -->
                <div class="place" id = "restaurant">
                    <h3>Eat & Drink</h3>
                    <img src="pics/hvillage.jpeg" style="width: 250px; height: 200px;">
                </div>
                </a>
            </div>
            <!-- If we want 2 separate and add more details, remove the comments down below, and copy paste 
            another for activity-->
            <!-- <div class="restaurant"> -->
                <!--Same layout applied to culture should be applied here, for reference : bamleb website-->
            <!-- </div> --> 
        </div>


       <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>Please log in or sign up to continue</p>
        <p><a href="login.php">Log in</a> or <a href="signup.html">Sign Up</a></p>
    <?php endif; ?>
    <script src="https://kit.fontawesome.com/32c48c7151.js" crossorigin="anonymous"></script>

</body>
</html>