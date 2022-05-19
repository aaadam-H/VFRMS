<?php
session_start();
include('connection.php');
include('header.php');
error_reporting(0);
$eventID = $_GET['eventID'];
$_SESSION['eventID'] = $eventID;

$sql = "SELECT * from event WHERE eventID = '$eventID'";
$result = mysqli_query($con,$sql);

if (mysqli_num_rows($result) > 0 ){
    while ($row = mysqli_fetch_assoc($result)){
        $eventName = $row["eventName"];
        $eventDesc = $row["eventDesc"];
        $eventSDate = $row["eventStartDate"];
        $eventEDate = $row["eventEndDate"];
        $eventStatus = $row["status"];
        $eventImg = $row['eventImg'];
        $eventDesc = $row['eventDesc'];
    }
}


if (isset($_POST['submit'])) {
    $eventName = $_POST['eventName'];
    $eventSDate = $_POST['eventSDate'];
    $eventEDate = $_POST['eventEDate'];
    $eventDesc = $_POST['desc'];
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];
    $eventID = $_SESSION['eventID'];

    $sql = "UPDATE event set eventName='$eventName', eventStartDate='$eventSDate', eventEndDate='$eventEDate', eventDesc='$eventDesc' WHERE eventID='$eventID'";
    $result = mysqli_query($con,$sql);
    if ($result){
        $_SESSION['eventID']=null;
        echo "<script>alert('Event Updated!'); window.location.href='view-event-org.php';</script>";
    }
    
}

$msg = "";
  
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['orgID'];
    $eventID = $_SESSION['eventID'];
  
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "imageWeb/".$filename;
          
    
    if(!$filename){
        echo "<script>alert('PLEASE UPLOAD PICTURE!')</script>";
    } else{
        // Get all the submitted data from the form
         $sql = "UPDATE event SET eventImg = '$folder' WHERE eventID='$eventID'";
        
        // Execute query
        mysqli_query($con, $sql);
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image changed successfully";
            echo "<script>alert('$msg'); window.location.href='view-event-org.php';</script>";
        }else{
            $msg = "Failed to change image";
            echo "<script>alert('$msg')</script>";
      }
    }
    
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Event - VFRMS</title>
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
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded mt-5" src="<?php echo $eventImg ?>" width="160" ></div>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="uploadfile">Upload New Picture to change </label>
                <input type="file" name="uploadfile" value="" />
                <button type="submit" name="upload" class="btn btn-primary profile-button">UPLOAD</button>
            </form>
        </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                       
                        
                        
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mt-2">
                            <div class="col-md-2"><label for="eventName">Event Name: </label></div>
                            <div class="col-md-10"><input type="text" class="form-control" placeholder="Event Name" name="eventName" value="<?php echo $eventName ?>" required></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="eventSDate">Event Start Date: </label></div>
                            <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $eventSDate ?>" name="eventSDate" required></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="eventEDate">Event End Date: </label></div>
                            <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $eventEDate ?>" name="eventEDate" required></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="desc">Event Description: </label></div>
                            <div class="col-md-10"><input type="text" class="form-control" placeholder="Event Description" value="<?php echo $eventDesc ?>" name="desc"></div>

                        </div>
                       
                        <div class="mt-5 text-right"><button name='submit' class="btn btn-primary profile-button">EDIT</button></div>
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