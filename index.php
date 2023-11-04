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
        <p> Hello <?= htmlspecialchars($user["first_name"])?></p>
      
       
       <a><button><i class="fa-solid fa-magnifying-glass"></i>         Search for Places</button></a>
       <a><button> <i class="fa-solid fa-heart"></i>           My Favorites</button></a>

       <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>Please log in or sign up to continue</p>
        <p><a href="login.php">Log in</a> or <a href="signup.html">Sign Up</a></p>
    <?php endif; ?>
    <script src="https://kit.fontawesome.com/32c48c7151.js" crossorigin="anonymous"></script>

</body>
</html>