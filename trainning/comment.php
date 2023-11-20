<?php
include('database.php');
//include db
// this code is for the comments insisde each trip
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action='comment.php' method='post'>
commnet:<br>
<input type="text" name='com'>
<input type='submit' name='comment' value='comment'> 

    </form>
</body>
</html>


<?php
// we created a place to type the comment and a submit button
//using the cookie that i stored i the front.phpfile
//i initialize $tripID in this file
if(isset($_COOKIE['tripID'])){
    $tripID=$_COOKIE['tripID'];
    echo $tripID;
    echo "<br>";
  }
  else{
    echo "no cookies";
  }
  

  if(isset($_POST['comment'])){
    $comment=$_POST['com'];
    $noSpaces = str_replace(' ', '', $comment);

    if($noSpaces!=""){

    $sql="INSERT INTO review (comment,fk_tripID)
    values('$comment','$tripID')";
     mysqli_query($conn,$sql);
  }}
 
  $sql="SELECT reviewID,comment from review
  where fk_tripID={$tripID}";
    $result=  mysqli_query($conn,$sql);
  

  while($row=mysqli_fetch_assoc($result)){
      echo "Review ID:" . $row['reviewID'] . "<br>";
      echo  "COMMENT:" .$row['comment']. "<br>";
     echo "<br>";
  }
  

?>