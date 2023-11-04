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
</head>
<body>
    <h1>Home</h1>
    <?php if(isset($user)) : ?>

        <!-- Navigation bar, feel free to edit it completely, classes are from fontawesome, used for displaying icons -->

        <a><button><i class="fa-solid fa-map"></i>       Book a Trip</button></a>
        <a><button><i class="fa-solid fa-user"></i>         My Profile</button></a>
        <p> Hello <?= htmlspecialchars($user["first_name"])?></p>

        <div class="container" id="container-trip">
            <h1>Explore our trips</h1>
            
            <!-- Related content for trips should be added here, similar to the one for places -->
        </div>




        <div class="container" id="container-place">
            <h1>Explore New Places</h1>
            <h2>Heritage & Culture</h2>
            <div class="culture" style="display : flex; gap: 10px;">
                <!-- Testing with sample data without the db, this sample data will be later deleted and content 
                will be rendered using php js mysql... -->
                <div class="place">
                    <h3>Archeological Sites</h3>
                    <img src="pics/baalback-temple.png" style="width: 200px; height: 100px;">
                </div>
                <div class="place">
                    <h3>Museums</h3>
                    <img src="pics/beirut-nat-museum.png" style="width: 200px; height: 100px;">
                </div>
            </div>
            <div class="restaurant">
                <!--Same layout applied to culture should be applied here, for reference : bamleb website-->
            </div>
            <div class="activity">
                 <!--Same layout applied to culture should be applied here, for reference : bamleb website-->
            </div>
        </div>


       <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>Please log in or sign up to continue</p>
        <p><a href="login.php">Log in</a> or <a href="signup.html">Sign Up</a></p>
    <?php endif; ?>
    <script src="https://kit.fontawesome.com/32c48c7151.js" crossorigin="anonymous"></script>

</body>
</html>