<!-- hidupkan! php takda -->
<?php
session_start();
$ID = $_SESSION['ID'];
$accType = $_SESSION['accType'];
include('connection.php');
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
    <script type="text/javascript">
        //chart
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            //total event per year
            <?php
            if ($accType == 'organizer') {
                $sql = "SELECT count(*) as total from event where YEAR(eventStartDate)=2022 and orgID='$ID'";
                $sql1 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2021 and orgID='$ID'";
                $sql2 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2020 and orgID='$ID'";
                $sql3 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2019 and orgID='$ID'";
                $sql4 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2018 and orgID='$ID'";
                $result = mysqli_query($con, $sql);
                $result1 = mysqli_query($con, $sql1);
                $result2 = mysqli_query($con, $sql2);
                $result3 = mysqli_query($con, $sql3);
                $result4 = mysqli_query($con, $sql4);
                $data18 = mysqli_fetch_assoc($result4);
                $data19 = mysqli_fetch_assoc($result3);
                $data20 = mysqli_fetch_assoc($result2);
                $data21 = mysqli_fetch_assoc($result1);
                $data22 = mysqli_fetch_assoc($result);
                if ($result && $result1 && $result2 && $result3 && $result4) {
                    $event18 = $data18['total'];
                    $event19 = $data19['total'];
                    $event20 = $data20['total'];
                    $event21 = $data21['total'];
                    $event22 = $data22['total'];
                }

                //total fee per yr
                $sqlfee =  "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2022 and orgID='$ID'";
                $sql1fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2021 and orgID='$ID'";
                $sql2fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2020 and orgID='$ID'";
                $sql3fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2019 and orgID='$ID'";
                $sql4fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2018 and orgID='$ID'";


                $resultfee = mysqli_query($con, $sqlfee);
                $result1fee = mysqli_query($con, $sql1fee);
                $result2fee = mysqli_query($con, $sql2fee);
                $result3fee = mysqli_query($con, $sql3fee);
                $result4fee = mysqli_query($con, $sql4fee);
                $data18 = mysqli_fetch_assoc($result4fee);
                $data19 = mysqli_fetch_assoc($result3fee);
                $data20 = mysqli_fetch_assoc($result2fee);
                $data21 = mysqli_fetch_assoc($result1fee);
                $data22 = mysqli_fetch_assoc($resultfee);
                if ($resultfee && $result1fee && $result2fee && $result3fee && $result4fee) {
                    if ($data18['totalFee'] == null) {
                        $data18['totalFee'] = 0;
                    } else {
                        $data18['totalFee'] = $data18['totalFee'];
                    }
                    if ($data19['totalFee'] == null) {
                        $data19['totalFee'] = 0;
                    } else {
                        $data19['totalFee'] = $data19['totalFee'];
                    }
                    if ($data20['totalFee'] == null) {
                        $data20['totalFee'] = 0;
                    } else {
                        $data20['totalFee'] = $data20['totalFee'];
                    }
                    if ($data21['totalFee'] == null) {
                        $data21['totalFee'] = 0;
                    } else {
                        $data21['totalFee'] = $data21['totalFee'];
                    }
                    if ($data22['totalFee'] == null) {
                        $data22['totalFee'] = 0;
                    } else {
                        $data22['totalFee'] = $data22['totalFee'];
                    }


                    $fee18 = $data18['totalFee'];
                    $fee19 = $data19['totalFee'];
                    $fee20 = $data20['totalFee'];
                    $fee21 = $data21['totalFee'];
                    $fee22 = $data22['totalFee'];

                    //profit
                    $income18['totalIncome'] = 0;
                    $income19['totalIncome'] = 0;
                    $income20['totalIncome'] = 0;
                    $income21['totalIncome'] = 0;
                    $income22['totalIncome'] = 0;

                    $sqlIncome  = "SELECT count(j.participantID) as totalPartcipant from joinedevent as j, event as e where j.eventID=e.eventID AND YEAR(e.eventStartDate)=2022 AND e.orgID='$ID'";
                    $sql1Income = "SELECT count(j.participantID) as totalPartcipant from joinedevent as j, event as e where j.eventID=e.eventID AND YEAR(e.eventStartDate)=2021 AND e.orgID='$ID'";
                    $sql2Income = "SELECT count(j.participantID) as totalPartcipant from joinedevent as j, event as e where j.eventID=e.eventID AND YEAR(e.eventStartDate)=2020 AND e.orgID='$ID'";
                    $sql3Income = "SELECT count(j.participantID) as totalPartcipant from joinedevent as j, event as e where j.eventID=e.eventID AND YEAR(e.eventStartDate)=2019 AND e.orgID='$ID'";
                    $sql4Income = "SELECT count(j.participantID) as totalPartcipant from joinedevent as j, event as e where j.eventID=e.eventID AND YEAR(e.eventStartDate)=2018 AND e.orgID='$ID'";


                    $resultIncome = mysqli_query($con, $sqlIncome);
                    $result1Income = mysqli_query($con, $sql1Income);
                    $result2Income = mysqli_query($con, $sql2Income);
                    $result3Income = mysqli_query($con, $sql3Income);
                    $result4Income = mysqli_query($con, $sql4Income);
                    $income18 = mysqli_fetch_assoc($result4Income);
                    $income19 = mysqli_fetch_assoc($result3Income);
                    $income20 = mysqli_fetch_assoc($result2Income);
                    $income21 = mysqli_fetch_assoc($result1Income);
                    $income22 = mysqli_fetch_assoc($resultIncome);
                    if ($resultIncome && $result1Income && $result2Income && $result3Income && $result4Income) {
                        //2018
                        if ($income18['totalPartcipant'] == null) {
                            $income18['totalPartcipant'] = 0;
                            $totalPart18 = 0;
                        } else {
                            $totalPart18 = $income18['totalPartcipant'];
                            $income18['profit'] = $income18['totalPartcipant'] * $fee18;
                        }
                        //2019
                        if ($income19['totalPartcipant'] == null) {
                            $income19['totalPartcipant'] = 0;
                            $totalPart19 = 0;
                        } else {
                            $totalPart19 = $income19['totalPartcipant'];
                            $income19['profit'] = $income19['totalPartcipant'] * $fee19;
                        }
                        //2020
                        if ($income20['totalPartcipant'] == null) {
                            $income20['totalPartcipant'] = 0;
                            $totalPart20 = 0;
                        } else {
                            $totalPart20 = $income20['totalPartcipant'];
                            $income20['profit'] = $income20['totalPartcipant'] * $fee20;
                        }
                        //2021
                        if ($income21['totalPartcipant'] == null || $income21['totalPartcipant'] = 0) {
                            $income21['profit'] = 0;
                            $totalPart21 = $income21['totalPartcipant'];
                        } else {
                            $totalPart21 = $income21['totalPartcipant'];
                            $totalParticipant21 = $income21['totalPartcipant'];
                            $income21['profit'] = $income21['totalPartcipant'] * $fee21;
                        }
                        //2022
                        if ($income22['totalPartcipant'] == null) {
                            $income22['totalPartcipant'] = 0;
                            $totalPart22 = 0;
                        } else {
                            $totalPart22 = $income22['totalPartcipant'];
                            $income22['profit'] = $income22['totalPartcipant'] * $fee22;
                        }

                        $income18 = $income18['profit'];
                        $income19 = $income19['profit'];
                        $income20 = $income20['profit'];
                        $income21 = $income21['profit'];
                        $income22 = $income22['profit'];
                    }
                }

            ?>

                var data0 = google.visualization.arrayToDataTable([
                    ['Year', 'Total Event', 'Total Participant'],
                    ['2018', <?php echo $event18 ?>, <?php echo $totalPart18 ?>],
                    ['2019', <?php echo $event19 ?>, <?php echo $totalPart19 ?>],
                    ['2020', <?php echo $event20 ?>, <?php echo $totalPart20 ?>],
                    ['2021', <?php echo $event21 ?>, <?php echo $totalPart21 ?>],
                    ['2022', <?php echo $event22 ?>, <?php echo $totalPart22 ?>],
                ]);

                var options0 = {
                    chart: {
                        title: 'Event Overview',
                        subtitle: 'Total Event, and Total Participant',
                    }
                };

                var chart0 = new google.charts.Bar(document.getElementById('columnchart_material0'));

                chart0.draw(data0, google.charts.Bar.convertOptions(options0));


                var data2 = google.visualization.arrayToDataTable([
                    ['Year', 'Total Fee'],
                    ['2018', <?php echo $income18 ?>],
                    ['2019', <?php echo $income19 ?>],
                    ['2020', <?php echo $income20 ?>],
                    ['2021', <?php echo $income21 ?>],
                    ['2022', <?php echo $income22 ?>]
                ]);
                var options2 = {
                    title: 'Total Profit (Estimation)',
                    curveType: 'linear',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart2'));
                chart2.draw(data2, options2);
            <?php
            }
            ?>


            <?php
            if ($accType == 'user') {
                $data18['totalFee'] = 0;
                $data19['totalFee'] = 0;
                $data20['totalFee'] = 0;
                $data21['totalFee'] = 0;
                $data22['totalFee'] = 0;


                $sqlfee =  "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2022";
                $sql1fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2021";
                $sql2fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2020";
                $sql3fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2019";
                $sql4fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2018";


                $resultfee = mysqli_query($con, $sqlfee);
                $result1fee = mysqli_query($con, $sql1fee);
                $result2fee = mysqli_query($con, $sql2fee);
                $result3fee = mysqli_query($con, $sql3fee);
                $result4fee = mysqli_query($con, $sql4fee);
                $data18 = mysqli_fetch_assoc($result4fee);
                $data19 = mysqli_fetch_assoc($result3fee);
                $data20 = mysqli_fetch_assoc($result2fee);
                $data21 = mysqli_fetch_assoc($result1fee);
                $data22 = mysqli_fetch_assoc($resultfee);
                if ($resultfee && $result1fee && $result2fee && $result3fee && $result4fee) {
                    if ($data18['totalFee'] == null) {
                        $data18['totalFee'] = 0;
                    } else {
                        $data18['totalFee'] = $data18['totalFee'];
                    }
                    if ($data19['totalFee'] == null) {
                        $data19['totalFee'] = 0;
                    } else {
                        $data19['totalFee'] = $data19['totalFee'];
                    }
                    if ($data20['totalFee'] == null) {
                        $data20['totalFee'] = 0;
                    } else {
                        $data20['totalFee'] = $data20['totalFee'];
                    }
                    if ($data21['totalFee'] == null) {
                        $data21['totalFee'] = 0;
                    } else {
                        $data21['totalFee'] = $data21['totalFee'];
                    }
                    if ($data22['totalFee'] == null) {
                        $data22['totalFee'] = 0;
                    } else {
                        $data22['totalFee'] = $data22['totalFee'];
                    }
                    $fee18 = $data18['totalFee'];
                    $fee19 = $data19['totalFee'];
                    $fee20 = $data20['totalFee'];
                    $fee21 = $data21['totalFee'];
                    $fee22 = $data22['totalFee'];
                }
            ?>
                var data1 = google.visualization.arrayToDataTable([
                    ['Year', 'Total Fee'],
                    ['2018', <?php echo $fee18 ?>],
                    ['2019', <?php echo $fee19 ?>],
                    ['2020', <?php echo $fee20 ?>],
                    ['2021', <?php echo $fee21 ?>],
                    ['2022', <?php echo $fee22 ?>]
                ]);
                var options1 = {
                    title: 'Total Fee per Year (Estimation)',
                    curveType: 'linear',
                    legend: {
                        position: 'bottom'
                    }
                };
                var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart1'));
                chart1.draw(data1, options1);
            <?php
            }

            ?>



            //data 2
            <?php
            if ($accType == 'user') {

                $sql =  "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2022";
                $sql1 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2021";
                $sql2 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2020";
                $sql3 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2019";
                $sql4 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2018";


                $result = mysqli_query($con, $sql);
                $result1 = mysqli_query($con, $sql1);
                $result2 = mysqli_query($con, $sql2);
                $result3 = mysqli_query($con, $sql3);
                $result4 = mysqli_query($con, $sql4);
                $data18 = mysqli_fetch_assoc($result4);
                $data19 = mysqli_fetch_assoc($result3);
                $data20 = mysqli_fetch_assoc($result2);
                $data21 = mysqli_fetch_assoc($result1);
                $data22 = mysqli_fetch_assoc($result);
                if ($result && $result1 && $result2 && $result3 && $result4) {
                    $event18 = $data18['total'];
                    $event19 = $data19['total'];
                    $event20 = $data20['total'];
                    $event21 = $data21['total'];
                    $event22 = $data22['total'];
                }
            ?>

                var data2 = google.visualization.arrayToDataTable([
                    ['Year', 'Event'],
                    ['2018', <?php echo $event18 ?>],
                    ['2019', <?php echo $event19 ?>],
                    ['2020', <?php echo $event20 ?>],
                    ['2021', <?php echo $event21 ?>],
                    ['2022', <?php echo $event22 ?>]
                ]);

                var options2 = {
                    chart: {
                        title: 'Events Per Year',
                    }
                };
                var chart2 = new google.charts.Bar(document.getElementById('columnchart_material'));
                chart2.draw(data2, google.charts.Bar.convertOptions(options2));



            <?php
            }

            ?>
        }
    </script>

    <title>Statistic - VFRMS</title>
    <title>VFRMS</title>
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

                    <li class="active"><a href="stats.php"><span class="icon-pie-chart mr-3"></span>Stats</a></li>
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
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="row mt-5">
                        <div class="col">
                            <?php
                            if ($accType == 'user') {
                            ?>
                                <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
                            <?php
                            } else {
                            ?>
                                <div id="columnchart_material0" style="width: 800px; height: 500px;"></div>
                            <?php
                            }
                            ?>
                            <!-- <?php
                            if ($accType ) {
                            ?>
                                <hr style="border:2px solid grey; border-radius:5px">
                            <?php
                            }
                            ?> -->

                        </div>
                    </div>
                    <?php
                    if ($accType == 'user') {
                    ?>
                        <div class="row">
                            <div class="col">
                                <div id="curve_chart1" style="width: 900px; height: 500px;"></div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="row">
                            <div class="col">
                                <div id="curve_chart2" style="width: 900px; height: 500px;"></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>




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