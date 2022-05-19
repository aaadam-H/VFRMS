<?php
session_start();
include('connection.php');
include('header.php');
error_reporting(0);
$ID=$_SESSION['ID'];


// $sql = "SELECT * from event WHERE orgID='$ID' and status='ongoing'";
// $result=mysqli_query($con,$sql);
// if (mysqli_num_rows($result)>0){
//     echo "<script>alert('You already have an ongoing event currently!'); window.location.href='index.php';</script>";
// }

if (isset($_POST['submit'])) {
    $msg = "";
    $eventName = $_POST['eventName'];
    $eventSDate = $_POST['eventSDate'];
    $eventEDate = $_POST['eventEDate'];
    $desc = $_POST['desc'];
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $eventImg = "imageWeb/" . $filename;

    if (!$filename){
        echo "<script>alert('PLEASE UPLOAD PICTURE!')</script>";
    } else {
        $sql = "INSERT INTO event (orgID,eventName, eventStartDate, EventEndDate, eventDesc, eventImg, status) VALUES ('$ID','$eventName','$eventSDate','$eventEDate','$desc','$eventImg','ongoing')";
        $result = mysqli_query($con,$sql);
        if ($result){
            if (move_uploaded_file($tempname, $eventImg)) {
                $msg = "Event Created Succesfully!";
                echo "<script>alert('$msg')</script>";
                echo "<script>window.location.href='view-event-org.php';</script>";
            } else {
                $msg = "Something went wrong! Please try again!";
                echo "<script>alert('$msg')</script>";
            }

        } else {
            echo "<script>alert('Something went wrong! Please try again!!')</script>";
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
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded mt-5" src="img/edit-tools.png"></div>
        </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mt-2">
                            <div class="col-md-2"><label for="eventName">Event Name: </label></div>
                            <div class="col-md-10"><input type="text" class="form-control" placeholder="Event Name" name="eventName" value="<?php echo $_POST['eventName']; ?>" required></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="eventSDate">Event Start Date: </label></div>
                            <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $_POST['eventSDate'] ?>" name="eventSDate" required></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="eventEDate">Event End Date: </label></div>
                            <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $_POST['eventSDate'] ?>" name="eventEDate" required></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2"><label for="desc">Event Description: </label></div>
                            <div class="col-md-10"><input type="text" class="form-control" placeholder="Event Description" value="<?php echo $_POST['desc']; ?>" name="desc"></div>

                        </div>
                        <div class="row mt-3 text-left">
                                <label for="uploadfile">Upload Picture for Event Icon </label>
                                <input type="file" name="uploadfile" value=""/>
                                <!-- <div class="mt-5 text-center"><button type="submit" name="upload" class="btn btn-primary profile-button">UPLOAD</button></div> -->
                        </div>
                       
                        <div class="mt-5 text-right"><button name='submit' class="btn btn-primary profile-button">Create</button></div>
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