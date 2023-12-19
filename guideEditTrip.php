<?php
session_start();

$mysqli = require __DIR__ . "/dbconnect.php";

$guideID = '';
$tripname ="";
$tripdate ="";
$triparea="";
$tripdescription="";
$tripcost="";

$errorM = "";
$successM = "";

if(isset($_GET['guideID'])){
    $guideID = $_GET['guideID'];
}

if(isset($_GET['tripID'])){
    $tripID = $_GET['tripID'];
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    //print_r($tripID);

    if(isset($_GET['tripID'])){
        $myquery = "SELECT * FROM trip WHERE tripID=$tripID";
        $preparemQ = $mysqli->prepare($myquery);
        if(!$preparemQ){
            die('Error: ' . $mysqli->error);
        }
        
        // $myres = $preparemQ->execute();
        // $myres->store_result();
        $myres = $mysqli->query($myquery);
        if ($myres !== false) {
            if ($myres->num_rows > 0) {
                $row = $myres->fetch_assoc();
                //echo "ok";
                $triparea = $row['area'];
                $tripdescription= $row['description']; //This is empty need 2 adjust
                $tripcost= $row['cost'];
                $tripname = $row['trip_name'];
                $tripdate = $row['date'];      
                
            } else {
                echo "No rows found for tripID: $tripID";
            }
        } else {
            // Handle query execution failure
            echo "Query failed: " . $mysqli->error;
        } 
    }

} if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //print_r($_POST);
    //POST 
    $triparea = $_POST['tripname'];
    $tripdescription= $_POST['tripdescription']; //This is empty 
    $tripcost= $_POST['tripcost'];
    $tripname = $_POST['tripname'];
    $tripdate = $_POST['tripdate'];     

        do{
            if(empty($tripname) || empty($tripdate) || empty($triparea) || empty($tripdescription) || empty($tripcost)){
                $errorM = "All fields are required";
                break;
            }
        
            //Update 
            $myquery = "UPDATE trip SET area = ?, description = ?, date = ?, cost = ?, trip_name = ? WHERE tripID = ?";
    
            $prepareQ = $mysqli->prepare($myquery);
            if (!$prepareQ) {
                die('Error: ' . $mysqli->error);
            }
        
            $prepareQ->bind_param("sssdsi", $triparea, $tripdescription, $tripdate, $tripcost, $tripname, $tripID);
            $myresult = $prepareQ->execute();
            
            
            if(!$myresult){
                $errorM = $mysqli->error;
            }
        
        
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
    <h2>Edit Trip</h2>
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