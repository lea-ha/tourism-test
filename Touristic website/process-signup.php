<?php
#$_POST is an object that contains key value pairs that come from the form when 
#it was submitted. The keys are the name attributes defined in the
#html file, and the values are the one the user submitted.
#To view $_POST array, use #print_r($_POST);

if(empty($_POST["first_name"])){
    die("First Name is required");
}

if(empty($_POST["last_name"])){
    die("Last Name is required");
}

if(empty($_POST["phone_number"])){
    die("Phone Number is required");
}


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

$sql = "INSERT INTO users (first_name, last_name, phone_number, email, password) VALUES (?,?,?,?,?) ";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)){
    die("SQL error" . $mysqli->error); #can use errno to know the number and do more specific error handlings
}

#ssiss refers to string string integer string string, the order in which these were written in the sql sttmt
$stmt->bind_param("ssiss", $_POST["first_name"], $_POST["last_name"],$_POST["phone_number"], $_POST["email"], $password_hash); 

if($stmt->execute()){
    #echo "signup success";
    header("Location: signup-success.html"); #header sends a location for addr of file
    exit;
    
} else {
    if($mysqli->errno === 1062){
        die("Email entry already exists");
    }
    die($mysqli->error . " " . $mysqli->errno);
}



