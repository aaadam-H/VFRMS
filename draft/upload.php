<?php
session_start();
error_reporting(0);
$accType = $_SESSION['accType'];
$ID = $_SESSION['ID'];
?>

<?php
  $msg = "";
  
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "imageWeb/".$filename;
          
    $db = mysqli_connect("localhost", "root", "", "vfrms");
    
        if($accType=='organizer'){
            // Get all the submitted data from the form
            $sql = "UPDATE organizer SET profilePic = '$folder' WHERE orgID='$ID'";
        } else if ($accType=='user'){
            $sql = "INSERT INTO user (profilePic) VALUES ('$folder')";
        } else {
            echo "<script>alert('Something went wrong! Please try again!')</script>";
        }
        
  
        // Execute query
        mysqli_query($db, $sql);
          
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, "imageWeb/".$filename))  {
            $msg = "Image uploaded successfully";
            echo "<script>alert('$msg')</script>";
        }else{
            $msg = "Failed to upload image";
            echo "<script>alert('$msg')</script>";
      }
      echo "<script>window.location.href='profile.php';</script>";
  }
?>