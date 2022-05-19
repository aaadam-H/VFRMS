<?php
session_start();
include('connection.php');

$profilePicDir = $_SESSION['profilePicDir'];


if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $password = md5($_POST['password']);
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];
    if ($accType == 'user') {
        $sql = "UPDATE user SET username='$username', uPass='$password', uEmail='$email', uContactNum='$contactNum' WHERE userID='$ID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['contactNum'] = $contactNum;
            echo "<script>alert('Profile Updated Successfully!')</script>";
            echo "<script>window.location.href='profile.php'</script>";
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    } else if ($accType == 'organizer') {
        $sql = "UPDATE organizer SET username='$username', email='$email', pass='$password', contactNum='$contactNum' WHERE orgID='$ID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['contactNum'] = $contactNum;
            echo "<script>alert('Profile Updated Successfully!')</script>";
            echo "<script>window.location.href='profile.php'</script>";
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    } else {
        echo "<script>alert('Woops! Something Wrong Went1.')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "imageWeb/" . $filename;


    if (!$filename) {
        echo "<script>alert('PLEASE UPLOAD PICTURE!')</script>";
    } else {
        if ($accType == 'organizer') {
            // Get all the submitted data from the form
            $sql = "UPDATE organizer SET profilePic = '$folder' WHERE orgID='$ID'";
        } else if ($accType == 'user') {
            $sql = "UPDATE user SET profilePic = '$folder' WHERE userID='$ID'";
        } else {
            echo "<script>alert('Something went wrong! Please try again!')</script>";
        }
        // Execute query
        mysqli_query($con, $sql);
        $_SESSION['profilePicDir'] = $folder;
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder)) {
            $msg = "Image changed successfully";
            echo "<script>alert('$msg')</script>";
        } else {
            $msg = "Failed to change image";
            echo "<script>alert('$msg')</script>";
        }
        echo "<script>window.location.href='profile.php';</script>";
    }
}

if (isset($_POST['delete'])) {
    $accType = $_SESSION['accType'];
    $ID = $_SESSION['ID'];

    if ($accType == 'organizer') {
        $sql = "UPDATE organizer SET profilePic = 'imageWeb/default.png' WHERE orgID='$ID'";
    } else if ($accType == 'user') {
        $sql = "UPDATE user SET profilePic = 'imageWeb/default.png' WHERE userID='$ID'";
    } else {
        echo "<script>alert('Something went wrong! Please try again!')</script>";
    }

    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION['profilePicDir'] = 'imageWeb/default.png';
        echo "<script> alert('Profile Picture Updated!'); window.location.href='profile.php';</script>";
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

        #indexLink,
        #editProfileLink {
            text-decoration: none;
            color: black;
        }

        body {
            overflow-y: scroll;
        }
    </style>

    <title>Edit Profile - VFRMS</title>
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
        <div class="text-center">
            <div style="background: url(img/bannerVFRMS2.png); background-repeat:no-repeat;  background-size:cover; background-position: 50% 100%;" class="bg-cover py-5"></div>

        </div>

        <div class="site-section">
            <div class="container rounded bg-white mt-5">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="<?php echo $profilePicDir ?>" width="90"><span class="font-weight-bold"><?php echo $_SESSION['username'] ?></span><span class="text-black-50"><?php echo $_SESSION['email'] ?></span><span><?php echo $_SESSION['accType'] ?></span></div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <label for="uploadfile">Upload New Picture to change </label>
                            <input type="file" name="uploadfile" value="" />
                            
                            <div class=" align-items-center text-center p-3 py-5">
                                <button type="submit" name="upload" class="btn btn-primary profile-button">UPLOAD</button>
                                <button type="submit" name="delete" class="btn btn-danger profile-button" title="DELETE CURRENT PROFILE PIC/RESET TO DEFAULT">DELETE</button>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="p-3 py-5">
                            <form action="" method="POST">
                                <div class="row mt-2">
                                    <div class="col-md-2"><label for="username">Username: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_SESSION['username']; ?>"></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="password">Password: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Re-enter current Password or New Password" name="password" required></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="contactNum">Contact Number: </label></div>
                                    <div class="col-md-10"><input type="text" class="form-control" placeholder="Contact Number" value="<?php echo $_SESSION['contactNum']; ?>" name="contactNum"></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2"><label for="email">Email: </label></div>
                                    <div class="col-md-10"><input type="email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" name="email"></div>

                                </div>
                                <div class="mt-5 text-right"><button name='submit' class="btn btn-primary profile-button">Save Profile</button></div>
                            </form>
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