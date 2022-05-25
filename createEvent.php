<?php
session_start();
include('connection.php');
error_reporting(0);
$ID = $_SESSION['ID'];

if (isset($_POST['submit'])) {
    $msg = "";
    $eventName = $_POST['eventName'];
    $eventSDate = $_POST['eventSDate'];
    $eventEDate = $_POST['eventEDate'];
    $desc = $_POST['desc'];
    $regSDate = $_POST['eventRegSDate'];
    $regEDate = $_POST['eventRegEDate'];
    $fee = $_POST['fee'];
    $earlyFee = $_POST['earlyFee'];
    $contactNumEvent = $_POST['contactNumEvent'];
    $accNumber = $_POST['accNumber'];
    $accBankName = $_POST['accBankName'];

    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $eventImg = "imageWeb/" . $filename;

    if (!$filename) {
        echo "<script>alert('PLEASE UPLOAD PICTURE!')</script>";
    } else {
        $sql = "INSERT INTO event (orgID,eventName, eventStartDate, EventEndDate, eventDesc, eventImg, status, registerStartDate, registerEndDate,fee,earlyFee,contactNumEvent,bankName,accNumber) VALUES ('$ID','$eventName','$eventSDate','$eventEDate','$desc','$eventImg','ongoing','$regSDate','$regEDate','$fee','$earlyFee','$contactNumEvent','$accBankName','$accNumber')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            if (move_uploaded_file($tempname, $eventImg)) {
                $msg = "Event Created Succesfully!";
                echo "<script>alert('$msg')</script>";
                // echo "<script>window.location.href='view-event-org.php';</script>";
                echo "<script>window.location.href='myEvent.php';</script>";
            } else {
                $msg = "Something went wrong! Please try again!";
                echo "<script>alert('$msg')</script>";
            }
        } else {
            // echo mysqli_error($con);
            echo "<script>alert('Something went wrong! Please try again!!')</script>";
            
            
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
        <div class="text-center">
            <div style="background: url(img/bannerVFRMS2.png); background-repeat:no-repeat;  background-size:cover; background-position: 50% 100%;" class="bg-cover py-5"></div>

        </div>

        <div class="site-section">
            <div class="container rounded bg-white mt-5">
                
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
                                    <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $_POST['eventEDate'] ?>" name="eventEDate" required></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="eventRegSDate">Event Register Start Date: </label></div>
                                    <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $_POST['eventRegSDate'] ?>" name="eventRegSDate" required></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="eventRegEDate">Event Register End Date: </label></div>
                                    <div class="col-md-10"><input type="date" class="form-control" value="<?php echo $_POST['eventRegEDate'] ?>" name="eventRegEDate" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="desc">Event Description: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Event Description" value="<?php echo $_POST['desc']; ?>" name="desc"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="fee">Fee: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="RM .." value="<?php echo $_POST['fee']; ?>" name="fee" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="earlyFee">Early Bird Fee: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="RM ..(Same as Fee if none)" value="<?php echo $_POST['earlyFee']; ?>" name="earlyFee" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="accBankName">Bank Name: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="" value="<?php echo $_POST['accBankName']; ?>" name="accBankName" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="accNumber">Account Number: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="" value="<?php echo $_POST['accNumber']; ?>" name="accNumber" required></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="contactNumEvent">Contact Number: </label></div>
                                    <div class="col-md-10"><input type="tel" class="form-control" placeholder="Phone Number" value="<?php echo $_POST['contactNumEvent']; ?>" name="contactNumEvent" required></div>
                                </div>
                                
                                <div class="row mt-3 text-left">
                                    <label for="uploadfile">Upload Picture for Event Icon <br></label>
                                    <input type="file" name="uploadfile" value="" class="ml-2"/>  
                                </div>

                                <div class="mt-5 text-right"><button name='submit' class="btn btn-primary profile-button">Create</button></div>
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