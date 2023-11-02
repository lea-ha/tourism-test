<?php

$host = "localhost";
$dbname = "tourismtest";
$username ="root";
$password = ""; #if not localhost better have a pwd

$mysqli = new mysqli(hostname : $host, username:  $username, password :  $password, database:  $dbname);

if ($mysqli->connect_errno){
    die("Connection error: " . $mysqli->connect_error);
}
else { 
    die("Success");
}

return $mysqli;