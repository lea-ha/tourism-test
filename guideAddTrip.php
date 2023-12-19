<?php
session_start();

$mysqli = require __DIR__ . "/dbconnect.php";

$tripname ="";
$tripdate ="";
$triparea="";
$tripdescription="";
$tripcost="";
$tripactivity="";
$triprestaurant="";
$tripculture="";

$errorM = "";
$successM = "";

$guideID;

if(isset($_GET['guideID'])){
    $guideID = $_GET['guideID'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$tripname = $_POST['tripname'];
$tripdate = $_POST['tripdate'];
$triparea = $_POST['triparea'];
$tripdescription = $_POST['tripdescription'];
$tripcost= $_POST['tripcost'];
$tripactivity= $_POST['tripactivity'];
$tripculture= $_POST['tripculture'];
$triprestaurant= $_POST['triprestaurant'];

do{
    if(empty($tripname) || empty($tripdate) || empty($triparea) || empty($tripdescription) || empty($tripcost)){
        $errorM = "All these fields are required";
        break;
    }

    //ADD to db working
    $myquery = "INSERT INTO trip(trip_name, area, cost, description, date, guideID) VALUES('$tripname', '$triparea', '$tripcost', '$tripdescription', '$tripdate', '$guideID')";
    $myresult = $mysqli->query($myquery);


    if(!$myresult){
        $errorM = $mysqli->error;
    }

    //ADD to PK tables not working correctly
//     $queryActivity = "SELECT activityID FROM activity WHERE name=?";
//     $stmtActivity = $mysqli->prepare($queryActivity);
//     if (!$stmtActivity) {
//         $errorM = "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
//     } 
//     $stmtActivity->bind_param("s", $tripactivity);
//     $stmtActivity->execute();
//     $resultActivity = $stmtActivity->get_result();

//     $queryCulture = "SELECT cultureID FROM culture WHERE name = ?";
//     $stmtCulture = $mysqli->prepare($queryCulture);
//     $stmtCulture->bind_param("s", $tripculture);
//     $stmtCulture->execute();
//     $resultCulture = $stmtCulture->get_result();

//     $queryRestaurant = "SELECT restaurantID FROM restaurant WHERE name = ?";
//     $stmtRestaurant = $mysqli->prepare($queryRestaurant);
//     $stmtRestaurant->bind_param("s", $triprestaurant);
//     $stmtRestaurant->execute();
//     $resultRestaurant = $stmtRestaurant->get_result();

//     $queryGetTripID = "SELECT tripID FROM trip WHERE trip_name=?";
//     $stmtGetTripID = $mysqli->prepare($queryGetTripID);
//     $stmtGetTripID->bind_param("s", $tripname);
//     $stmtGetTripID->execute();
//     $resultGetTripID = $stmtGetTripID->get_result();
    

// $rowActivity = $resultActivity->fetch_assoc();
// $rowCulture = $resultCulture->fetch_assoc();
// $rowRestaurant = $resultRestaurant->fetch_assoc();
// $resID = $resultGetTripID->fetch_assoc();


// $insertA = $mysqli->prepare("INSERT INTO trip_activity(activityID, tripID) VALUES (?, ?)");
// $insertC = $mysqli->prepare("INSERT INTO trip_culture(cultureID, tripID) VALUES (?, ?)");
// $insertR = $mysqli->prepare("INSERT INTO trip_restaurant(restaurantID, tripID) VALUES (?, ?)");


// $insertA->bind_param("ii", $rowActivity['activityID'], $resID['tripID']);
// $insertC->bind_param("ii", $rowCulture['cultureID'], $resID['tripID']);
// $insertR->bind_param("ii", $rowRestaurant['restaurantID'], $resID['tripID']);



// //To add the picture of the activity to the trip
// $addImageQuery = "UPDATE trip SET picture = (SELECT picture FROM activity WHERE activityID = ? LIMIT 1) WHERE tripID = ?";
// $stmt = $mysqli->prepare($addImageQuery);
// $stmt->bind_param("si", $rowActivity['activityID'], $resID['tripID']);
// $stmt->execute();


    

    $tripname ="";
    $tripdate ="";
    $triparea="";
    $tripdescription="";
    $tripcost="";
    $tripactivity="";
    $tripculture="";
    $triprestaurant="";

    $successM = "Trip successfully added";



}while(false);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css/tripform.css">
</head>
<body>
    <h2>Add a new Trip</h2>
    <div class="container my-5">
        <form method="POST">
            <?php

            if(!empty($errorM)){
              echo"<div class='row-mb-3>'
              <div class='offset-sm-3 col-sm-6'>
             <div class='alert alert-warning alert-dismissible fade show' role='alert'>
             <strong>$errorM</strong>
             <button type='button' class='btn btn-close' data-bs-dismiss='alert'></button>
             </div></div></div>
             ";
            }
            
            ?>

            <label class="col-sm-3 col-form-label">Trip Name</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type = "text" class="form-control" name="tripname" value="<?php echo"$tripname"?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Date</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type = "date" class="form-control" name="tripdate" value="<?php echo"$tripdate"?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Main Area</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type = "text" class="form-control" name="triparea" value="<?php echo"$triparea"?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Cost</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type = "number" class="form-control" name="tripcost" value="<?php echo"$tripcost"?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Restaurant</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type = "text" class="form-control" name="triprestaurant" value="<?php echo"$triprestaurant"?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Culture</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type = "text" class="form-control" name="tripculture" value="<?php echo"$tripculture"?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Activity</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type = "text" class="form-control" name="tripactivity" value="<?php echo"$tripactivity"?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Description</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <input type='text' class="form-control" name="tripdescription" value="<?php echo"$tripdescription"?>">
                </div>
            </div>

            <?php
            if(!empty($successM)){
                echo"<div class='row-mb-3>'
                <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successM</strong>
                <button type='button' class='btn btn-close' data-bs-dismiss='alert'></button>
                </div></div></div>
                ";
            }
            
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

            </div>

        </form>
    </div>
    
</body>
</html>