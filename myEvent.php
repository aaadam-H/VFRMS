<?php
session_start();
include('connection.php');
$ID = $_SESSION['ID'];
$accType = $_SESSION['accType'];
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>My Event - VFRMS</title>

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
                    <li class="active"><a href="myEvent.php"><span class="icon-calendar mr-3"></span>My Event</a></li>
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
        <?php
    include('header.php');
    ?>

        <div class="site-section">
            <div class="container rounded bg-white mt-5">

                <div class="row">
                    <div class="row">&nbsp;</div>

                    <div class="col-lg-6" style="float:none;margin:auto;">
                    </div>
                </div>

                <div class="row">
                    <table class="table " border="2">
                        <thead class="thead-dark">
                            <tr class="">
                                <th class=""></th>
                                <th class="">Event Name</th>
                                <th class="">Start Date</th>
                                <th class="">End Date</th>
                                <th class="">Status</th>
                                <th class=" border-0"></th>
                                <th class=" border-0"></th>
                                <th class=" border-0"></th>

                            </tr>
                        </thead>
                        <?php
                        include("connection.php");
                        if ($accType == 'user') {
                            $query = "SELECT * FROM joinedevent AS J, event as E where J.eventID=E.eventID and userID='$ID' ORDER BY e.status DESC";
                        } else {
                            $query = "SELECT * FROM event where orgID='$ID' ORDER BY status DESC";
                        }

                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            //output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                $eventName = $row["eventName"];
                                $eventDesc = $row["eventDesc"];
                                $eventSDate = $row["eventStartDate"];
                                $eventEDate = $row["eventEndDate"];
                                $eventStatus = $row["status"];
                                $eventID = $row['eventID'];
                                $eventImg = $row['eventImg'];
                                $status = $row['status'];


                        ?>
                                <tbody>
                                    <tr class="table-body-row">
                                        <td class="" style="text-align: center;"><img src="<?php echo $eventImg ?>" alt="" width="160" height="90" style="object-fit: contain; "></td>
                                        <td class=""><a href="eventDetail.php?eventID=<?php echo $eventID ?>" style="text-decoration:none; color:black;"><?php echo $eventName ?></a></td>

                                        <td class=""><?php echo $eventSDate ?></td>
                                        <td class=""><?php echo $eventEDate ?></td>
                                        <td class=""><strong><?php echo $status ?></strong> </td>



                                        <?php
                                        if ($accType == 'user') {
                                        ?>
                                            <td class="border-0"><button type="" class="btn btn-info"><a class="btn" href="eventDetail.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' title='Check Event Detail'>CHECK</a></button< /td>
                                                    <?php
                                                    if ($status == 'ongoing') {
                                                    ?>
                                            <td class="border-0"><button type="" class="btn btn-danger"><a class='btn' onClick="javascript: return confirm('Are you sure to deregister event <?php echo $eventName ?>');" href="deregisterEvent.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' title="DEREGISTER"> DEREGISTER</a></button>
                                            <td class="border-0"><button type="" class="btn btn-success"><a class='btn' href="proof.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' title="Manage Event Proof"> PROOF</a></button>
                                            <?php
                                                    } else {
                                            ?>
                                            <td class="border-0"><button type="" class="btn btn-danger" disabled><a class="btn disabled" onClick="javascript: return confirm('Are you sure to deregister event <?php echo $eventName ?>');" href="deregisterEvent.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' title='DEREGISTER'>DEREGISTER</a></button>
                                            <td class="border-0"><button type="" class="btn btn-success" disabled><a class="btn disabled" href="proof.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' title='Manage event proof'>PROOF</a></button>
                                            <?php
                                                    }
                                            ?>

                                        <?php
                                        } else { //org
                                        ?>
                                            <td class="border-0"><button type="" class="btn btn-info"><a class="btn" href="viewParticipant.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>View Participant</a></button< /td>
                                                    <?php
                                                    if ($status == 'completed') { //disabled
                                                    ?>
                                            <td class="border-0"><button type="" class="btn btn-warning" disabled><a class="btn disabled" href="editEvent.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>Edit Event</a></button< /td>
                                            <td class="border-0"><button type="" class="btn btn-danger" disabled><a class="btn disabled" onClick="javascript: return confirm('Are you sure to end event <?php echo $eventName ?>');" href="eventEnd.php?eventID=<?php echo $eventID ?>&status=<?php echo $status ?>" style='color: black; text-decoration:none;'>End Event</a></button></td>

                                        <?php
                                                    } else {
                                        ?>
                                            <td class="border-0"><button type="" class="btn btn-warning"><a class="btn" href="editEvent.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>Edit Event</a></button< /td>
                                            <td class="border-0"><button type="" class="btn btn-danger"><a class="btn" onClick="javascript: return confirm('Are you sure to end event <?php echo $eventName ?>');" href="eventEnd.php?eventID=<?php echo $eventID ?>&status=<?php echo $status ?>" style='color: black; text-decoration:none;'>End Event</a></button></td>

                                        <?php
                                                    }
                                        ?>


                                    <?php
                                        }
                                    ?>

                                    </td>


                                    </tr>

                                </tbody>

                            <?php

                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan='7' class="text-center">0 results</td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
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