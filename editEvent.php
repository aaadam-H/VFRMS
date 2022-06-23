<?php
session_start();
include('connection.php');

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
        $eventRegSDate = $row['registerStartDate'];
        $eventRegEDate = $row['registerEndDate'];
        $fee = $row['fee'];
        $earlyFee = $row['earlyFee'];
        $contactNumEvent = $row['contactNumEvent'];
        $bankName = $row['bankName'];
        $accNumber = $row['accNumber'];
        $earlyFeeQt = $row['earlyFeeQt'];
    }
}


if (isset($_POST['submit'])) {
    $eventName = $_POST['eventName'];
    $eventSDate = $_POST['eventSDate'];
    $eventEDate = $_POST['eventEDate'];
    $eventDesc = $_POST['desc'];
    $eventRegSDate = $_POST['eventRegSDate'];
    $eventRegEDate = $_POST['eventRegEDate'];
    $fee = $_POST['fee'];
    $earlyFee = $_POST['earlyFee'];
    $contactNumEvent = $_POST['contactNumEvent'];
    $bankName = $_POST['accBankName'];
    $accNumber = $_POST['accNumber'];
    $earlyFeeQt = $_POST['earlyFeeQt'];;
    $eventID = $_GET['eventID'];

    $sql = "UPDATE event set eventName='$eventName', eventStartDate='$eventSDate', eventEndDate='$eventEDate', eventDesc='$eventDesc', registerStartDate='$eventRegSDate', registerEndDate='$eventRegEDate', fee='$fee', earlyFee='$earlyFee', contactNumEvent='$contactNumEvent', bankName='$bankName', accNumber='$accNumber', earlyFeeQt='$earlyFeeQt' WHERE eventID='$eventID'";
    $result = mysqli_query($con,$sql);
    $resultSql = mysqli_error($con);
    if ($result){
        $_SESSION['eventID']=null;
        echo "<script>alert('Event Updated!'); window.location.href='eventDetail.php?eventID=$eventID';</script>";
    } else {
        die("ERROR".mysqli_error($con));
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

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/styleCss.css">
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

    <title>Create Event - VFRMS</title>
</head>

<body>


    <aside class="sidebar">
        <div class="toggle">
            <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
                <span></span>
            </a>
        </div>
        <div class="side-inner">

            <div class="profile">
                <img src="<?php echo $_SESSION['profilePicDir'] ?>" alt="Image" class="img-fluid">
                <h3 class="name"><?php echo $_SESSION['username'] ?></h3>
                <h3 class="name"><?php echo $_SESSION['email'] ?></h3>
                <span class="country"><?php echo $_SESSION['accType'] ?></span><br>
                <span class="name" style="font-size: 12px;">
                    <?php
                    echo date('l');
                    echo (", ");
                    echo date("d-m-Y");
                    echo (", ");
                    echo date("h:i:sa");
                    ?>
                </span>
            </div>

            <div class="nav-menu">

                <ul>
                    <li><a href="home.php"><span class="icon-home mr-3"></span>Home</a></li>
                    <li><a href="profile.php"><span class="icon-person mr-3"></span>Profile</a></li>
                    <li><a href="myEvent.php"><span class="icon-calendar mr-3"></span>My Event</a></li>
                    <?php
                    if ($_SESSION['accType'] == 'organizer') {
                        echo "<li class='active'><a href='createEvent.php'><span class='icon-location-arrow mr-3'></span>Create Event</a></li>";
                    }
                    ?>

                    <li><a href="stats.php"><span class="icon-pie-chart mr-3"></span>Stats</a></li>
                    <li><a href="logout.php"><span class="icon-sign-out mr-3"></span>Sign out</a></li>
                </ul>
            </div>
        </div>

    </aside>

    <main>
        <?php
    include('header.php');
    ?>

        <div class="site-section">
            <div class="container rounded bg-white mt-5">
                
                <div class="row">
                    <div class="col-md-4 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded mt-5 w-100" src="<?php echo $eventImg ?>"></div>
                        <div class="row mt-3 text-left">
                            <label for="uploadfile">Upload Picture for Event Icon <br></label>
                            <input type="file" name="uploadfile" value="" class="ml-2"/>  
                            <button type="submit" name="upload" class="btn btn-primary profile-button m-2">UPLOAD</button>
                        </div>
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
                                    <div class="col-md-2"><label for="eventRegSDate">Event Register Start Date: </label></div>
                                    <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $eventRegSDate ?>" name="eventRegSDate" required></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="eventRegEDate">Event Register End Date: </label></div>
                                    <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $eventRegEDate ?>" name="eventRegEDate" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="desc">Event Description: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Event Description" value="<?php echo $eventDesc ?>" name="desc"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="fee">Fee: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="RM .." value="<?php echo $fee ?>" name="fee" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="earlyFee">Early Bird Fee: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="RM ..(Same as Fee if none)" value="<?php echo $earlyFee ?>" name="earlyFee" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="earlyFeeQt">Early Bird Capacity: </label></div>
                                    <div class="col-md-10"><input type="number" class="form-control" placeholder="50" value="<?php echo $earlyFeeQt ?>" name="earlyFeeQt" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="accBankName">Bank Name: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="" value="<?php echo $bankName; ?>" name="accBankName" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="accNumber">Account Number: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="" value="<?php echo $accNumber; ?>" name="accNumber" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="contactNumEvent">Contact Number: </label></div>
                                    <div class="col-md-10"><input type="tel" class="form-control" placeholder="Phone Number" value="<?php echo $contactNumEvent; ?>" name="contactNumEvent" required></div>
                                </div>
                                
                                

                                <div class="mt-5 text-right"><button name='submit' class="btn btn-primary profile-button">Edit</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php
include('footer.html');
?>
    </main>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>