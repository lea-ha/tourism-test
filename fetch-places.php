<?php

function fetchTableData($tableName) {
    // PHP script (e.g., path_to_your_php_script.php)
    header('Content-Type: application/json');

    $places = [];
    $mysqli = require __DIR__ . "/dbconnect.php"; 
    $sql = "SELECT * FROM $tableName";
    $result = $mysqli->query($sql);
    
    while ($place = $result->fetch_assoc()) {
        #print_r prints in a way that is readable to humans
        $places[] = $place;
    }

    $jsonPlaces = json_encode($places); #AJAX request
    echo $jsonPlaces;
}