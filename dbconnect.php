<?php

$host = "localhost";   #Check for ur conditions and update that piece of code
$dbname = "tourismtest";
$username ="root";
$password = ""; #if not localhost better have a pwd

$mysqli = new mysqli(hostname : $host, username:  $username, password :  $password, database:  $dbname);

if ($mysqli->connect_errno){
    die("Connection error: " . $mysqli->connect_error);
}
else{
    #print("success");
}

return $mysqli;