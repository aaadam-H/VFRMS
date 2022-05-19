<?php

include("connection.php");

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $acc_type = $_POST['acc_type'];

    if ($password == $cpassword) {
        if ($acc_type == "User") { //user register
            $sql = "SELECT * FROM user WHERE uEmail='$email'";
            $result = mysqli_query($con, $sql);
            $sql1 = "SELECT * from organizer where email='$email'";
            $result1 = mysqli_query($con,$sql1);
            if (!$result->num_rows > 0 && !$result1->num_rows > 0) {
                $sql = "INSERT INTO user (username, uPass, uEmail, uContactNum, accType)
					VALUES ('$username','$password','$email','$contactNum','user')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo "<script>alert('User Registration Completed.')</script><script> window.location.href='login.php'</script>";
                    $username = "";
                    $email = "";
                    $_POST['password'] = "";
                    $_POST['cpassword'] = "";
                } else {
                    echo "<script>alert('Woops! Something Wrong Went.')</script>";
                }
            } else {
                echo "<script>alert('Woops! Email Already Exists.')</script>";
            }
        } else { //organizer register
            $sql = "SELECT * FROM organizer WHERE email='$email'";
            $result = mysqli_query($con, $sql);
            $sql1 = "SELECT * from user where uEmail='$email'";
            $result1 = mysqli_query($con,$sql1);
            if (!$result->num_rows > 0 && !$result1->num_rows > 0) {
                $sql = "INSERT INTO organizer (username, email, pass, contactNum, accType)
					VALUES ('$username','$email','$password','$contactNum','organizer')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo "<script>alert('User Registration Completed.')</script><script> window.location.href='login.php'</script>";
                    $username = "";
                    $email = "";
                    $_POST['password'] = "";
                    $_POST['cpassword'] = "";
                } else {
                    echo "<script>alert('Woops! Something Wrong Went.')</script>";
                }
            } else {
                echo "<script>alert('Woops! Email Already Exists.')</script>";
            }
        }
    } else {
        echo "<script>alert('Password Not Matched!')</script>";
    }
}
include("header.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="styles.css">
    
    <style>
        .rad-title,
        .rad-label{
            color: #636963;
        }
        .box{
            margin-top: 50px;
        }
    </style>

    <title>Register - VFRMS</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="" method="POST" class="box">
                        <h1>Register</h1>
                        <p class="text-muted"> Please fill in the form!</p>
                        <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                        <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                        <input type="tel" name="contactNum" placeholder="Contact Number" value="<?php echo $_POST['contactNum']; ?>" required>
                        <input type="password" name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>" required>
                        <input type="password" name="cpassword" placeholder="Confirm Password" value="<?php echo $_POST['cpassword']; ?>" required>
                        <table border="0" class="rad-tab">
                            <tr>
                                <td>
                                    <div class="">
                                    <p class="rad-title">Account Type: </p>    
                                        <input type="radio" id="org" name="acc_type" value="Organizer" style="margin-left: 10px;" >
                                        <label class="rad-label" for="org">Organizer</label>
                                        <input type="radio" id="user" name="acc_type" value="User" style="margin-left: 5px;">
                                        <label  class="rad-label" for="user">User</label><br>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <a class="forgot text-muted" href="login.php">Have an account? Login Here</a><br>
                        <button name="submit" class="btn btn-success">Register</button>
                        <button name="reset" type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
