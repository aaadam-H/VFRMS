<?php
include('connection.php');
session_start();

$eventID = $_GET['eventID'];
$sql = "SELECT * from event where eventID='$eventID'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $eventNameOG = $row['eventName'];
    $eventSDateOG = $row['eventStartDate'];
    $eventEDateOG = $row['eventEndDate'];
    $eventImgOG = $row['eventImg'];
    $eventStatus = $row['status'];
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
          <div class="row">&nbsp;</div>

          <div class="col-lg-6" style="float:none;margin:auto;">


            <table border="0" class="eventOGTable">
              <th></th>
              <th>PARTICIPANT LIST</th>


              <tr>
                <td rowspan="6"> <img src="<?php echo $eventImgOG ?>" alt="" width="160" height="90" style="object-fit: contain;"></td>
                <td><?php echo $eventNameOG ?></td>
              </tr>

              <tr>

                <td><?php echo $eventSDateOG ?> - <?php echo $eventEDateOG ?> </td>
              </tr>
              <tr>

                <td>
                  <button type="submit" name="endEvent" class="btn btn-danger" title="End the Event"><a onClick="javascript: return confirm('Are you sure to end event <?php echo $eventNameOG ?>');" class="btn" href="eventEnd.php?eventID=<?php echo $eventID ?>&status=<?php echo $eventStatus ?>" style="text-decoration:none; color:black;">END EVENT</a></button>
                </td>
              </tr>

              <tr>


              </tr>
            </table>
          </div>
        </div>

        <div class="row"> &nbsp;
          <hr width="100%">
        </div>
        <div class="row">
          <table class="table justify-content-center" border="1">
            <thead class="thead-dark">
              <tr class="">
                <th style="text-align:center;">Proof</th>
                <th class="">Participant Name</th>
                <th class="">Date</th>
                <th class=""></th>



              </tr>
            </thead>
            <?php
            include("connection.php");
            $query = "SELECT * FROM user,proof where user.userID = proof.userID AND proof.eventID='$eventID'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
              //output data of each row
              while ($row = mysqli_fetch_assoc($result)) {
                $pName = $row["username"];
                if ($row['eventProof'] == null) {
                  $proof = "imageProof/not-available";
                } else {
                  $proof = $row["eventProof"];
                }

                $userID = $row['userID'];
                $date = $row['date'];



            ?>
                <tbody class="justify-content-center">
                  <tr class="table-body-row">
                    <td class="pb-2" style="text-align: center;"><img src="<?php echo $proof ?>" alt="" width="160" height="90" style="object-fit: contain; "></td>
                    <td class=""><?php echo $pName ?></td>
                    <td class=""><?php echo $date ?></td>

                    <td class="border-0 d-flex justify-content-around">
                      <button type="" class="btn btn-info " title="View participant's proof"><a class="btn" href="viewProof.php?userID=<?php echo $userID ?>&eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' target="_blank">View</a></button>
                      <button type="" class="btn btn-danger " title="Delete participant's proof"><a class="btn" href="deleteProof.php?userID=<?php echo $userID ?>&eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>Delete</a></button>
                    </td>



                  </tr>

                </tbody>

            <?php

              }
            } else {
              echo "<tr><td colspan='4' class='text-center'>0 results</td></tr>";
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