<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
    <form action="esm el folder.php" method="post" enctype="multipart/form-data">
        <label for="image">Select Image:</label>
        <input type="file" name="image" accept="image/*">
        <input type="submit" value="Upload">
    </form>
</body>
</html>



<?php
include('database.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

// syntax deyman the same bas ntbhe image is the name of the input fo2

        $escapedImageData = mysqli_real_escape_string($conn, $imageData);

        $sql = "INSERT INTO esm _el_table (image) VALUES ('$escapedImageData')";
        mysqli_query($conn, $sql);

        
    }
}
/* feke t7ote hek shi to check eza image was uploaded
 if (mysqli_affected_rows($conn) > 0) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error uploading image to the database.";
        }
    }
*/
?>
