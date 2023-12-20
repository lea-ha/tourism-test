<?php
session_start();

$mysqli = require __DIR__ . "/dbconnect.php";

$guideID = '';
$firstName ="";
$lastName ="";
$phone ="";
$email = "";

$errorM = "";
$successM = "";

if(isset($_GET['guideID'])){
    $guideID = $_GET['guideID'];
}

if(isset($_GET['userID'])){
    $userID = $_GET['userID'];
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['userID'])){
        $myquery = "SELECT * FROM users WHERE userID=$userID";
        $preparemQ = $mysqli->prepare($myquery);
        if(!$preparemQ){
            die('Error: ' . $mysqli->error);
        }

        $myres = $mysqli->query($myquery);
        if ($myres !== false) {
            if ($myres->num_rows > 0) {
                $row = $myres->fetch_assoc();
                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $phone = $row['phone_number'];
                $email = $row['email'];
            } else {
                echo "No rows found for userID: $userID";
            }
        } else {
            echo "Query failed: " . $mysqli->error;
        } 
    }

} elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    do {
        if(empty($firstName) || empty($lastName) || empty($phone) || empty($email)){
            $errorM = "All fields are required";
            break;
        }

        $myquery = "UPDATE users SET first_name = ?, last_name = ?, phone_number = ?, email = ? WHERE userID = ?";
        $prepareQ = $mysqli->prepare($myquery);
        if (!$prepareQ) {
            die('Error: ' . $mysqli->error);
        }

        $prepareQ->bind_param("ssssi", $firstName, $lastName, $phone, $email, $userID);
        $myresult = $prepareQ->execute();

        if(!$myresult){
            $errorM = $mysqli->error;
        }

        $successM = "User information successfully updated";

    } while(false);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css/tripform.css">
</head>
<body>
    <h2>Edit User Information</h2>
    <div class="container my-5">
        <form method="POST">
            <?php
            if(!empty($errorM)){
                echo "<div class='row-mb-3'>
                      <div class='offset-sm-3 col-sm-6'>
                      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                      <strong>$errorM</strong>
                      <button type='button' class='btn btn-close' data-bs-dismiss='alert'></button>
                      </div></div></div>";
            }
            ?>

            <label class="col-sm-3 col-form-label">First Name</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstName" value="<?php echo $firstName ?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Last Name</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastName" value="<?php echo $lastName ?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                </div>
            </div>

            <label class="col-sm-3 col-form-label">Email</label>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>

            <?php
            if(!empty($successM)){
                echo "<div class='row-mb-3'>
                      <div class='offset-sm-3 col-sm-6'>
                      <div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <strong>$successM</strong>
                      <button type='button' class='btn btn-close' data-bs-dismiss='alert'></button>
                      </div></div></div>";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
