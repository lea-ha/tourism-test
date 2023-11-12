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

function getTripDetails(){

    header('Content-Type: application/json');

    $trips = [];

    //The order of elements in the objects array is as follows : 
    // tripID, date, area, trip_name, name(restaurant_name), userID(the guide),
    // first_name(guide), last_name(guide), name(activity_name), name(culture_name) 

    $mysqli = require __DIR__ . "/dbconnect.php"; 
    $myquery = "SELECT trip.tripID, trip.date, trip.area, trip.trip_name, restaurant.name AS restaurant_name, guide.userID, users.first_name, users.last_name, activity.name AS activity_name, culture.name AS culture_name
    FROM trip
    INNER JOIN trip_restaurant ON trip.tripID = trip_restaurant.tripID
    INNER JOIN restaurant ON trip_restaurant.restaurantID = restaurant.restaurantID
    INNER JOIN guide ON trip.guideID = guide.guideID
    INNER JOIN users ON guide.userID = users.userID
    INNER JOIN trip_activity ON trip.tripID = trip_activity.tripID
    INNER JOIN activity ON trip_activity.activityID = activity.activityID
    INNER JOIN trip_culture ON trip.tripID = trip_culture.tripID
    INNER JOIN culture ON trip_culture.cultureID = culture.cultureID;";

    $result = $mysqli->query($myquery);

    while($trip = $result->fetch_assoc()){
        $trips[] = $trip;
    }

    //  A problem here is that if a trip has more than 1 activity/resto or culture, the same trip appears
    //twice . need to adjust that.
    $jsonTrips = json_encode($trips);
    echo $jsonTrips;

}