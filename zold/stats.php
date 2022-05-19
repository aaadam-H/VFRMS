<?php
include('connection.php');
session_start();
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

    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      

        var data1 = google.visualization.arrayToDataTable([
          ['Year', 'Total Fee'],
          ['2018',     110],
          ['2019',      20],
          ['2020',  22],
          ['2021', 200],
          ['2022',    75]
        ]);
        var options1 = {
          title: 'Total Fee per Year',
          curveType: 'linear',
          legend: { position: 'bottom' }
        };
        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart1'));
        chart1.draw(data1, options1);
        
    
        var data2 = google.visualization.arrayToDataTable([
          ['Year', 'Event'],
          ['2014', 2],
          ['2015', 3],
          ['2016', 1],
          ['2017', 7]
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
                    <li ><a href="home.php"><span class="icon-home mr-3"></span>Home</a></li>
                    <li><a href="#"><span class="icon-person mr-3"></span>Profile</a></li>
                    <li><a href="#"><span class="icon-calendar mr-3"></span>Event</a></li>
                    <?php
                    if ($_SESSION['accType'] == 'organizer') {
                        echo "<li><a href='#'><span class='icon-location-arrow mr-3'></span>Create Event</a></li>";
                    }
                    ?>

                    <li class="active"><a href="stats.php"><span class="icon-pie-chart mr-3"></span>Stats</a></li>
                    <li><a href="logout.php"><span class="icon-sign-out mr-3"></span>Sign out</a></li>
                </ul>
            </div>
        </div>

    </aside>

    <main>
        <div class="site-section">
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="row">
                        <div class="col">
                            <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
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
    </main>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>