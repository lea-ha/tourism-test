<?php

$mysqli = require __DIR__ . "/dbconnect.php";

$sql = sprintf("SELECT * FROM users WHERE email = '%s'", $mysqli->real_escape_string($_GET["email"]));

$result = $mysqli->query($sql);

$is_available = $result->num_rows === 0;

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);

//syntax to check : http://localhost/PROJECTS/food-test/validate-email.php?email=themail