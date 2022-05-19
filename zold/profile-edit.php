<?php
session_start();
include('connection.php');
include('header.php');
$profilePicDir = $_SESSION['profilePicDir'];


if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $password = md5($_POST['password']);
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];
    if ($accType == 'user') {
        $sql = "UPDATE user SET username='$username', uPass='$password', uEmail='$email', uContactNum='$contactNum' WHERE userID='$ID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['contactNum'] = $contactNum;
            echo "<script>alert('Profile Updated Successfully!')</script>";
            echo "<script>window.location.href='profile.php'</script>";
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    } else if($accType == 'organizer') {
        $sql = "UPDATE organizer SET username='$username', email='$email', pass='$password', contactNum='$contactNum' WHERE orgID='$ID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['contactNum'] = $contactNum;
            echo "<script>alert('Profile Updated Successfully!')</script>";
            echo "<script>window.location.href='profile.php'</script>";
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    } else{
        echo "<script>alert('Woops! Something Wrong Went1.')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

$msg = "";
  
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];
  
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "imageWeb/".$filename;
          
    
    if(!$filename){
        echo "<script>alert('PLEASE UPLOAD PICTURE!')</script>";
    } else{
        if($accType=='organizer'){
            // Get all the submitted data from the form
            $sql = "UPDATE organizer SET profilePic = '$folder' WHERE orgID='$ID'";
        } else if ($accType=='user'){
            $sql = "UPDATE user SET profilePic = '$folder' WHERE userID='$ID'";
        } else {
            echo "<script>alert('Something went wrong! Please try again!')</script>";
        }
        // Execute query
        mysqli_query($con, $sql);
        $_SESSION['profilePicDir'] = $folder;
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image changed successfully";
            echo "<script>alert('$msg')</script>";
        }else{
            $msg = "Failed to change image";
            echo "<script>alert('$msg')</script>";
      }
      echo "<script>window.location.href='profile.php';</script>";
    }
    
}

if (isset($_POST['delete'])){
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];
    
    if($accType=='organizer'){
        $sql = "UPDATE organizer SET profilePic = 'imageWeb/default.png' WHERE orgID='$ID'";
        
    } else if($accType=='user'){
        $sql = "UPDATE user SET profilePic = 'imageWeb/default.png' WHERE userID='$ID'";
       
    } else {
        echo "<script>alert('Something went wrong! Please try again!')</script>";
    }

    $result = mysqli_query($con,$sql);
    if ($result){
        $_SESSION['profilePicDir'] = 'imageWeb/default.png';
        echo "<script> alert('Profile Picture Updated!'); window.location.href='profile.php';</script>";
    } 
    
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile - VFRMS</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: #BA68C8;
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        #indexLink,
        #editProfileLink {
            text-decoration: none;
            color: black;
        }

        #editProfileLink {
            cursor: default;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5">
       
        <button onclick="history.back()" style="float: left;" class="btn btn-dark mt-3" >BACK</button>
            
        
    
        <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="<?php echo $profilePicDir ?>" width="90"><span class="font-weight-bold"><?php echo $_SESSION['username'] ?></span><span class="text-black-50"><?php echo $_SESSION['email'] ?></span><span><?php echo $_SESSION['accType'] ?></span></div>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="uploadfile">Upload New Picture to change </label>
                <input type="file" name="uploadfile" value="" />
                <button type="submit" name="upload" class="btn btn-primary profile-button">UPLOAD</button>
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    
                    <button type="submit" name="delete" class="btn btn-danger profile-button" title="DELETE CURRENT PROFILE PIC/RESET TO DEFAULT">DELETE</button>
                </div>
                
            </form>
        </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <form action="" method="POST">
                        <div class="row mt-2">
                            <div class="col-md-2"><label for="username">Username: </label></div>
                            <div class="col-md-10"><input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_SESSION['username']; ?>"></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="password">Password: </label></div>
                            <div class="col-md-10"><input type="text" class="form-control" placeholder="Re-enter current Password or New Password" name="password" required></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="contactNum">Contact Number: </label></div>
                            <div class="col-md-10"><input type="text" class="form-control" placeholder="Contact Number" value="<?php echo $_SESSION['contactNum']; ?>" name="contactNum"></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="email">Email: </label></div>
                            <div class="col-md-10"><input type="email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" name="email"></div>

                        </div>
                        <div class="mt-5 text-right"><button name='submit' class="btn btn-primary profile-button">Save Profile</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include('footer.html');
?>