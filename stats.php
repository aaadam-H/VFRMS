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

            <?php
            $data18['totalFee'] = 0;
            $data19['totalFee'] = 0;
            $data20['totalFee'] = 0;
            $data21['totalFee'] = 0;
            $data2['totalFee'] = 0;
            if ($accType == 'organizer') {
                $sqlfee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2022 and orgID='$ID'";
                $sql1fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2021 and orgID='$ID'";
                $sql2fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2020 and orgID='$ID'";
                $sql3fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2019 and orgID='$ID'";
                $sql4fee = "SELECT sum(fee) as totalFee from event where YEAR(eventStartDate)=2018 and orgID='$ID'";
            } else { //user
                $sqlfee =  "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2022";
                $sql1fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2021";
                $sql2fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2020";
                $sql3fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2019";
                $sql4fee = "SELECT sum(e.fee) as totalFee from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2018";
            }

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


            //data 2
            <?php
            if ($accType == 'organizer') {
                $sql = "SELECT count(*) as total from event where YEAR(eventStartDate)=2022 and orgID='$ID'";
                $sql1 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2021 and orgID='$ID'";
                $sql2 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2020 and orgID='$ID'";
                $sql3 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2019 and orgID='$ID'";
                $sql4 = "SELECT count(*) as total from event where YEAR(eventStartDate)=2018 and orgID='$ID'";
            } else { //user
                $sql =  "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2022";
                $sql1 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2021";
                $sql2 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2020";
                $sql3 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2019";
                $sql4 = "SELECT count(*) as total from event AS e, joinedevent AS j where e.eventID=j.eventID AND userID='$ID' AND YEAR(eventStartDate)=2018";
            }

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
        <div class="text-center">
            <div style="background: url(img/bannerVFRMS2.png); background-repeat:no-repeat;  background-size:cover; background-position: 50% 100%;" class="bg-cover py-5"></div>

        </div>

        <div class="site-section">
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="row mt-5">
                        <div class="col">
                            <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
                            <hr style="border:3px solid grey; border-radius:5px">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col">
                            <div id="curve_chart1" style="width: 900px; height: 500px;"></div>

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