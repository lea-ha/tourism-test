<?php

$is_invalid = false; 

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $mysqli = require __DIR__ . "/dbconnect.php"; 

    $sql = sprintf("SELECT * FROM users WHERE email='%s'", $mysqli->real_escape_string($_POST["email"])); #real_escape is to avoid sql injections by escaping what is coming from the form, but the code works without it, // %s is a string placeholder that will be replaced with the escaped user input

    $result =  $mysqli->query($sql);

    $user = $result->fetch_assoc(); #returns the record as an associative array

    if($user){
        if(password_verify($_POST["password"], $user["password"])){
            session_start(); #sessions r used 2 rmbmr values btw browser requests, it stores a sessionID
           # die("login success");
            session_regenerate_id(); #2 avoid session fixation attack

            $_SESSION["user_id"] = $user["userID"];

            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href = "css/loginsignup.css">

</head>
<body>
    <div class="container">
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <form method="post">
            <h3>Login Here</h3>
    
            <label for="username">Email</label>
            <input type="email" placeholder="Email" id="username" name="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?> "> <!-- htmlspecialchars to escape -->
    
            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" name="password">

            <?php if($is_invalid): ?> 
            <em><br>Invalid log in</em>
            <?php endif; ?>
    
            <button>Log In</button>
            <!--
            <div class="social">
              <div class="go"><i class="fab fa-google"></i>  Google</div>
              <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
            </div>
            -->
            
            <div class="redirect-link">
                Don't have an account? <a href="signup.html">Sign up</a>
              </div>
        </form>    
    </div>

    <script src="https://kit.fontawesome.com/32c48c7151.js" crossorigin="anonymous"></script>
</body>
</html>