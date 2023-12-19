<?php
session_start();

$mysqli = require __DIR__ . "/dbconnect.php";

$tripname ="";
$tripdate ="";
$triparea="";
$tripdescription="";
$tripcost="";

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

do{
    if(empty($tripname) || empty($tripdate) || empty($triparea) || empty($tripdescription) || empty($tripcost)){
        $errorM = "All fields are required";
        break;
    }

    //ADD client to db
    $myquery = "INSERT INTO trip(trip_name, area, cost, description, date, guideID) VALUES('$tripname', '$triparea', '$tripcost', '$tripdescription', '$tripdate', '$guideID')";
    $myresult = $mysqli->query($myquery);

    if(!$myresult){
        $errorM = $mysqli->error;
    }

    $tripname ="";
    $tripdate ="";
    $triparea="";
    $tripdescription="";
    $tripcost="";

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

            <label class="col-sm-3 col-form-label">Description</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                <textarea class="form-control" name="tripdescription" value="<?php echo"$tripdescription"?>"></textarea>
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