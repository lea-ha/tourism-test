<?php

session_start();

$mysqli = require __DIR__ . "/dbconnect.php"; 

#print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <?php if(isset($_SESSION["user_id"])) :
        $userID = $_SESSION["user_id"] ?>
        <p> you are logged in </p>
       <?php $myquery = "SELECT email FROM users WHERE id = $userID";
             $res = $mysqli->query($myquery); //will be an object representing the query result If the query was successful but didn't return any data (such as an INSERT, UPDATE, or DELETE query), $result will be true.
             $user = $res->fetch_assoc(); //returns an array containing all the user's properties
             $email = $user['email'];
             echo "<p>email : $email </p>";
       ?>
       
       <a href="recipe-search.php"><button><i class="fa-solid fa-magnifying-glass"></i>         Recipe Search</button></a>
       <a><button> <i class="fa-solid fa-heart"></i>           My Favorites</button></a>

       <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>Please log in or sign up to continue</p>
        <p><a href="login.php">Log in</a> or <a href="signup.html">Sign Up</a></p>
    <?php endif; ?>
    <script src="https://kit.fontawesome.com/32c48c7151.js" crossorigin="anonymous"></script>

</body>
</html>