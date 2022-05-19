<?php
session_start();
include('connection.php');
include('header.php');
$profilePicDir = $_SESSION['profilePicDir'];



?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile - VFRMS</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

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
        #editProfileLink{
            text-decoration: none;
            color: black;
        }
        
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5">
    <button onclick="" style="float: left;" class="btn btn-dark mt-3" ><a href="index.php" style="text-decoration: none; color:white;">BACK</a></button>
        <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="<?php echo $profilePicDir ?>" width="90"><span class="font-weight-bold"><?php echo $_SESSION['username'] ?></span><span class="text-black-50"><?php echo $_SESSION['email'] ?></span><span><?php echo $_SESSION['accType'] ?></span></div>
        </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        
                        <h6 class="text-right"><a href="profile-edit.php" id="editProfileLink">Edit Profile</a></h6>
                        <h6><a href="pastEvent.php" id="editProfileLink">Event</a></h6>
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
</body>

</html>

<?php
    include('footer.html');
?>