<?php
error_reporting(0);
?>
<?php
  $msg = "";
  
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "image/".$filename;
          
    $db = mysqli_connect("localhost", "root", "", "vfrms");
  
        // Get all the submitted data from the form
        $sql = "INSERT INTO image (name,img_dir) VALUES ('$filename','$folder')";
  
        // Execute query
        mysqli_query($db, $sql);
          
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
      echo $msg;
  }
  $result = mysqli_query($db, "SELECT * FROM image");
  echo $result;
?>