<?php
session_start();
include("connection.php");
include("header.php");



error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: home.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM organizer WHERE email='$email' AND pass='$password'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) { //oragnizer check
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['accType'] = $row['accType'];
        $_SESSION['contactNum'] = $row['contactNum'];
        $_SESSION['ID'] = $row['orgID'];
        $_SESSION['profilePicDir'] = $row['profilePic'];

        header("Location: home.php");
    } else {
        $sql = "SELECT * FROM user WHERE uEmail='$email' AND uPass='$password'";
        $result1 = mysqli_query($con, $sql);
        if ($result1->num_rows > 0) { //user check
            $row = mysqli_fetch_assoc($result1);
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['uEmail'];
            $_SESSION['accType'] = $row['accType'];
            $_SESSION['contactNum'] = $row['uContactNum'];
            $_SESSION['ID'] = $row['userID'];
            $_SESSION['profilePicDir'] = $row['profilePic'];

            
            header("Location: home.php");
        } else {
            echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">


    <style>
        
    </style>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/styleCss.css">
    

    <title>Login - VFRMS </title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="" method="POST" class="box">
                        <h1>Login</h1>
                        <p class="text-muted"> Please enter your login and password!</p>
                        <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                        <input type="password" name="password" placeholder="Password" value="" required>
                        <a class="forgot text-muted" href="register.php">Dont have an account?</a><br>
                        <button name="submit" class="btn btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>

