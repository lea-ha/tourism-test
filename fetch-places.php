<?php

function fetchTableData($tableName) {
    
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



function addToTripDetails(&$tripDetails, $tripID, $type, $name) {
    //This method is just used for "mutlivalued" attributes 
    
    if (!in_array($type, ['cultures', 'activities', 'restaurants'])) {
        return; //Need 2 check type if valid, not necessary bc we r the ones on the db but it s more precautious
    }

    // Check if the name is not already in the array for the specified tripID and type
    $existingEntries = $tripDetails[$tripID][$type];
    $isUnique = true;

    foreach ($existingEntries as $entry) {
        if ($entry === $name) {
            $isUnique = false; //This is for "simulating" a set because php doesnt have sets
            break;
        }
    }

    // Add the name to the array for the specified tripID if it's unique
    if ($isUnique) {
        $tripDetails[$tripID][$type][] = $name;
    }
}

function getTripDetails() {
    header('Content-Type: application/json');

    $trips = [];

    // The order of elements in the objects array is as follows:
    // tripID, date, area, trip_name, name(restaurant_name), userID(the guide),
    // first_name(guide), last_name(guide), name(activity_name), name(culture_name)

    $mysqli = require __DIR__ . "/dbconnect.php";
    $myquery = "SELECT * FROM trip_details_view;";

    $result = $mysqli->query($myquery);

    

    $tripDetails = array();

    foreach ($result as $row) {
        $tripID = $row['tripID'];
        $culture_name = $row['culture_name'];
        $activity_name = $row['activity_name'];
        $restaurant_name = $row['restaurant_name'];
        $guideName = $row['first_name'] ." ". $row['last_name'];
        $date = $row['date'];
        $area = $row['area'];
        $trip_name = $row['trip_name'];

        // Check if the tripID already exists in the result array, if not, create a new entry for the tripID
        if (!isset($tripDetails[$tripID])) {
            $tripDetails[$tripID] = array(
                'tripID' => $tripID,
                'guideName' => $guideName,
                'date' => $date,
                'area' => $area,
                'trip_name' => $trip_name,
                'cultures' => array(),
                'activities' => array(),
                'restaurants' => array()
            );
        }

        
        addToTripDetails($tripDetails, $tripID, 'cultures', $culture_name);
        addToTripDetails($tripDetails, $tripID, 'activities', $activity_name);
        addToTripDetails($tripDetails, $tripID, 'restaurants', $restaurant_name);
    }

    //make it an array
    $tripsDetailsArray = array($tripDetails);
    //print_r($tripDetails);

    $jsonTrips = json_encode(array_values($tripDetails));
    echo $jsonTrips;
}

