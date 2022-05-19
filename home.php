<?php
session_start();
include('connection.php');
if(!$_SESSION['ID']){
  echo "<script>alert('Please log in first!'); window.location.href='login.php';</script>";
  // header('location:login.php');
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
          <li class="active"><a href="home.php"><span class="icon-home mr-3"></span>Home</a></li>
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
      <div class="text-center headline">
        <h1 style="color: white; text-shadow: 2px 2px black;">EVENT</h1>
      </div>

      <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">

          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <?php

        $sql = "SELECT * from event WHERE status='ongoing' LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $eventName0 = $row['eventName'];
        $eventID0 = $row['eventID'];
        $eventImg0 = $row['eventImg'];
        $eventDesc0 = $row["eventDesc"];
        if (strlen($eventDesc0) > 100) {
          $eventDesc0 = substr($eventDesc0, 0, 100) . '...';
        }
        ?>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="overlay-image" style="background-image:url(<?php echo $eventImg0 ?>);"></div>
            <div class="containerCarousel">
              <h1><a href="eventDetail.php?eventID=<?php echo $eventID0 ?>"><?php echo $eventName0 ?></a></h1>
              <p><?php echo $eventDesc0 ?></p>
            </div>
          </div>
          <?php
          $query = "SELECT * FROM event where status='ongoing' AND NOT eventID=$eventID0 ORDER BY RAND() LIMIT 2";
          $result1 = mysqli_query($con, $query);

          if (mysqli_num_rows($result1) > 0) {
            //output data of each row
            while ($row = mysqli_fetch_assoc($result1)) {
              $eventName = $row["eventName"];
              $eventDesc = $row["eventDesc"];
              $eventID = $row['eventID'];
              $eventImg = $row['eventImg'];
              if (strlen($eventDesc) > 100) {
                $eventDesc = substr($eventDesc, 0, 100) . '...';
              }
          ?>
              <div class="carousel-item">
                <div class="overlay-image" style="background-image:url(<?php echo $eventImg ?>);"></div>
                <div class="containerCarousel">
                  <h1><a href="eventDetail.php?eventID=<?php echo $eventID ?>"><?php echo $eventName ?></a></h1>
                  <p><?php echo $eventDesc ?></p>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>

      <div class="container mt-2">
        <div class="row justify-content-left">
          <table class="headerName">
            <tr>
              <td>
                <h1>REGISTER NOW!</h1>
              </td>
            </tr>
          </table>
        </div>
        <div class="row mt-2">

          <table border="0" class="d-flex justify-content-center">
            <?php
            $i = 0;
            $sql = "SELECT * FROM event where status='ongoing'";
            $result0 = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result0)) {
              $eventName = $row['eventName'];
              $eventImg = $row['eventImg'];
              $fee = $row['fee'];
              $feeEarly = $row['earlyFee'];
              $regEndDateS = $row['registerEndDate'];
              $eventID = $row['eventID'];
              if ($i % 3 == 0) {
                echo "<tr>";
              }
            ?>
              <td class='col-3'><img src='<?php echo $eventImg ?>' alt='' width='320' height='180' style='object-fit: contain; margin-inline:auto' class='d-flex justify-content-center mt-2'><br><a href='eventDetail.php?eventID=<?php echo $eventID ?>' class='d-flex justify-content-center text-justify'><?php echo $eventName ?></a></td>
            <?php
              if ($i % 3 == 2) {
                echo "</tr>";
              }
              $i++;
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