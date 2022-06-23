<?php
session_start();
include('connection.php');
$profilePicDir = $_SESSION['profilePicDir'];
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
            background: #BA68C8;
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

        /* body {
            overflow-y: hidden;
        } */
    </style>

    <title>Profile - VFRMS</title>
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
                    <li class="active"><a href="#"><span class="icon-person mr-3"></span>Profile</a></li>
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
        <?php
    include('header.php');
    ?>

        <div class="site-section">
            <div class="container rounded bg-black mt-5">

                <div class="row">
                    <div class="col-md-4 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="<?php echo $profilePicDir ?>" width="90"><span class="font-weight-bold"><?php echo $_SESSION['username'] ?></span><span class="text-black-50"><?php echo $_SESSION['email'] ?></span><span><?php echo $_SESSION['accType'] ?></span></div>
                    </div>
                    <div class="col-md-8">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-right"><a href="profile-edit.php" class="btn alert-info icon-edit" id="editProfileLink"> Edit Profile</a></h6>
                            </div>
                            <form action="" method="POST">
                                <div class="row mt-2">
                                    <div class="col-md-2"><label for="username">Username: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_SESSION['username']; ?>" disabled></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="password">Password: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Password" value="******" disabled></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="contactNum">Contact Number: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Contact Number" value="<?php echo $_SESSION['contactNum']; ?>" disabled></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="email">Email: </label></div>
                                    <div class="col-md-10"><input type="email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" disabled></div>

                                </div>

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