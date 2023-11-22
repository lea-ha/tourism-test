<?php

session_start();

if (isset($_GET['tripID'])) {
    // Retrieve the tripID from the URL
    $tripID = $_GET['tripID'];
    $userID = $_SESSION['user_id'];

    // Perform actions based on the tripID
    //echo "Actions performed for tripID: $tripID and for userID: $userID";

    
    $mysqli = require __DIR__ . "/dbconnect.php";

    $checkQuery = "SELECT * FROM USER_TRIP WHERE userID = ? AND tripID = ?";
    $checkStatement = $mysqli->prepare($checkQuery);
    
    if (!$checkStatement) {
        die('Error: ' . $mysqli->error); // Output the error message
    }

    $checkStatement->bind_param("ii", $userID, $tripID);
    $checkStatement->execute();
    $checkStatement->store_result();

    if ($checkStatement->num_rows == 0) {
        // meaning that user didnt register for that trip
        $insertQuery = "INSERT INTO USER_TRIP (userID, tripID) VALUES (?, ?)";
        $insertStatement = $mysqli->prepare($insertQuery);

        if (!$insertStatement) {
            die('Error: ' . $mysqli->error); // Output the error message
        }

        $insertStatement->bind_param("ii", $userID, $tripID);

        if ($insertStatement->execute()) {
            $alert = "Booking successful!";
            echo $alert;
        } else {
            $alert = "Unable to book the trip. Try again later";
            echo $alert;
        }

        $insertStatement->close();
    } else {
        $alert =  "You have already booked this trip.";
        echo $alert;
    }

    $checkStatement->close();
    $mysqli->close();

} else {
    echo "Error: tripID is not set in the URL";
}
?>
