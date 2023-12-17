<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css/hide.css">
    <script src="js/DisplayData.js" defer></script>
    <script src ="js/SearchBar.js" defer></script>
    <script src ="js/activityfetch.js" defer></script>
    <link rel="stylesheet" href="css/places.css">
</head>
<body>
    
<?php if(isset($_SESSION['user_id'])) : ?>
    <div class="heading">
      <h1>
        Lebanon's Activities:<br />
        Where you can Ski and go to the beach on the same day!
      </h1>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br />
    <div class="place-container">
        <select name="district" id="district">
            <option value="All">All</option>
            <option value="Matn">Matn</option>
            <option value="Keserwan">Keserwan</option>
            <option value="Beirut">Beirut</option>
            <option value="Chouf">Chouf</option>
          </select>
        <input type = "search" id="search">
        <div class="place-container">
            
        </div>
    </div>
    <?php else: ?>
        <p>Please log in or sign up to continue</p>
        <p><a href="login.php">Log in</a> or <a href="signup.html">Sign Up</a></p>
    <?php endif; ?>
</body>
</html>
