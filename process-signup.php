<?php

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid email address is required");
}

if(strlen($_POST["password"]) <8 ){
    die("Password must be at least 8 characters");
}

if(! preg_match("/[a-z]/i", $_POST["password"])){
    die("Password must contain at least 1 letter");
}

if(! preg_match("/[0-9]/i", $_POST["password"])){
    die("Password must contain at least 1 number");
}

if($_POST["password"] !== $_POST["password-re"]){
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/dbconnect.php";

$sql = "INSERT INTO users (email, password_hash) VALUES (?,?) ";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)){
    die("SQL error" . $mysqli->error);
}

$stmt->bind_param("ss", $_POST["email"], $password_hash);

if($stmt->execute()){
    header("Location: signup-success.html");
    exit;
    
} else {
    if($mysqli->errno === 1062){
        die("Email entry already exists");
    }
    die($mysqli->error . " " . $mysqli->errno);
}



