<?php

session_start();

$activityID = '';
$restaurantID = '';
$cultureID = '';
$tablename = '';

if(isset($_GET['activityID'])){
    $activityID = $_GET['activityID'];
    $tablename = 'activity';
    //print_r($activityID);
}

if(isset($_GET['cultureID'])){
    $cultureID = $_GET['cultureID'];
    $tablename = 'culture';
}

if(isset($_GET['restaurantID'])){
    $restaurantID = $_GET['restaurantID'];
    $tablename = 'restaurant';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css/places.css">

    <title>Document</title>
</head>
<body>
    <?php

    $mysqli = require __DIR__ . "/dbconnect.php"; 
    if(isset($_GET['activityID'])){
        $query = "SELECT * FROM activity WHERE activityID=$_GET[activityID]";
        $result = $mysqli->query($query);
        $place = $result->fetch_assoc();

        $activityID = $place['activityID'];
        $name = $place['name'];
        $cost = $place['average_cost'];
        $location = $place['location'];
        $district = $place['district'];
        $picture = $place['picture'];
        $desc = $place['description'];

        echo"<div class='container'>
        <div class='place'>
        <img src='$picture'></img>
        <h2>$name</h2>
        <p>cost : $cost$</p>
        <p>location : $location</p>
        <p>district : $district</p>
        <p>$desc</p>
        <label for='myTextarea'>Insert a comment:</label>
        <textarea id='myTextarea'></textarea>
        <button >Submit</button>
        <style>#myTextarea {
            width: 50%; 
            height: 50%; 
            box-sizing: border-box; 
          }</style>
          <h2>View other's comments:</h2>
          
        </div>
        </div>";
    }


    if(isset($_GET['cultureID'])){
        $query = "SELECT * FROM culture WHERE cultureID=$_GET[cultureID]";
        $result = $mysqli->query($query);
        $place = $result->fetch_assoc();

        $cultureID = $place['cultureID'];
        $name = $place['name'];
        $cost = $place['average_cost'];
        $location = $place['location'];
        $district = $place['district'];
        $picture = $place['picture'];
        $desc = $place['description'];

        echo"<div class='container'>
        <div class='place'>
        <img src='$picture'></img>
        <h2>$name</h2>
        <p>cost : $cost$</p>
        <p>location : $location</p>
        <p>district : $district</p>
        <p>$desc</p>
        <label for='myTextarea'>Insert a comment:</label>
        <textarea id='myTextarea'></textarea>
        <button>Submit</button>
        <style>#myTextarea {
            width: 50%; 
            height: 50%; 
            box-sizing: border-box; 
          }</style>
          <h2>View other's comments:</h2>
        </div>
        </div>";
    }

    if(isset($_GET['restaurantID'])){
        $query = "SELECT * FROM restaurant WHERE restaurantID=$_GET[restaurantID]";
        $result = $mysqli->query($query);
        $place = $result->fetch_assoc();

        //print_r($place);

        $restaurantID = $place['restaurantID'];
        $name = $place['name'];
        $cost = $place['average_cost'];
        $location = $place['location'];
        $district = $place['district'];
        $picture = $place['picture'];
        $desc = $place['description'];

        echo"<div class='container'>
        <div class='place'>
        <img src='$picture'></img>
        <h2>$name</h2>
        <p>cost : $cost$</p>
        <p>location : $location</p>
        <p>district : $district</p>
        <p>$desc</p>
        <label for='myTextarea'>Insert a comment:</label>
        <textarea id='myTextarea'></textarea>
        <button>Submit</button>
        <style>#myTextarea {
            width: 50%; 
            height: 50%; 
            box-sizing: border-box; 
          }</style>
          <h2>View other's comments:</h2>
        </div>
        </div>";
    }

    
    ?>
    
</body>
</html>