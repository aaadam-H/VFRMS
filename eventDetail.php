<?php
session_start();
include('connection.php');
$accType = $_SESSION['accType'];
$eventID = $_GET['eventID'];
$sql = "SELECT * FROM event,organizer where event.orgID=organizer.orgID AND eventID='$eventID'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $eventName = $row['eventName'];
        $eventDesc = $row['eventDesc'];
        $eventStatus = $row['status'];
        $eventSDate = $row['eventStartDate'];
        $eventEDate = $row['eventEndDate'];
        $orgName = $row['username'];
        $eventImg = $row['eventImg'];
        $fee = $row['fee'];
        $feeEarly = $row['earlyFee'];
        $eventRegSDate = $row['registerStartDate'];
        $eventRegEDate = $row['registerEndDate'];
        $contactNumEvent = $row['contactNumEvent'];
    }
}

$sql1 = "SELECT COUNT(participantID) as TOTAL from joinedevent WHERE eventID='$eventID'";
$result1 = mysqli_query($con, $sql1);
if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $totalParticipant = $row['TOTAL'];
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
        .carousel-item {
            height: 45rem;
            background: #777;
            color: white;
            position: relative;

        }

        .containerCarousel {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding-bottom: 50px;
            padding-left: 55px;
        }

        .overlay-image {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            background-position: center;
            background-size: cover;
            opacity: 0.5;
        }

        .headline {
            position: absolute;
            left: 0;
            right: 0;
            z-index: 9999;
        }

        .containerCarousel>h1>a {
            text-decoration: none;
            color: white;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>

    <title>Event Detail - VFRMS</title>
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
                        echo "<li><a href='createEvent.php'><span class='icon-location-arrow mr-3'></span>Create Event</a></li>";
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
            <div class="container rounded bg-black mt-5 pb-5">
               
                <div class="row">
                    <div class="col-lg-6" style="float: none; margin:auto;">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-3"><img class="rounded mt-5" src="<?php echo $eventImg ?>" width="320"></div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Event Name: </strong></div>
                            <div class="col-md-8"><?php echo $eventName ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Event Description: </strong></div>
                            <div class="col-md-8"><?php echo $eventDesc ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Status: </strong></div>
                            <div class="col-md-8"><?php echo $eventStatus ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Event Register Start Date: </strong></div>
                            <div class="col-md-8"><?php echo $eventRegSDate ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Event Register End Date: </strong></div>
                            <div class="col-md-8"><?php echo $eventRegEDate ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Event Start Date: </strong></div>
                            <div class="col-md-8"><?php echo $eventSDate ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Event End Date: </strong></div>
                            <div class="col-md-8"><?php echo $eventEDate ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Organize By: </strong></div>
                            <div class="col-md-8"><?php echo $orgName ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Total Participant: </strong></div>
                            <div class="col-md-8"><?php echo $totalParticipant ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Fee: </strong></div>
                            <div class="col-md-8">RM<?php echo $fee ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Early Bird Fee: </strong></div>
                            <div class="col-md-8">RM<?php echo $feeEarly ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4"><strong>Contact Number: </strong></div>
                            <div class="col-md-8"><?php echo $contactNumEvent ?></div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center ">
                            <?php
                            if ($accType == 'user') {
                            ?>
                                <button type="" class="btn btn-success mt-3"><a onClick="javascript: return confirm('Are you sure to register for event <?php echo $eventName ?>');" href="registerEvent.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>REGISTER</a></button>
                            <?php
                            }
                            ?>

                        </div>

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