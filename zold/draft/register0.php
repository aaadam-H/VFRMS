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
		if ($acc_type == "User") {//user register
			$sql = "SELECT * FROM user WHERE uEmail='$email'";
			$result = mysqli_query($con, $sql);
			if (!$result->num_rows > 0) { 
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
		} else{ //organizer register
			$sql = "SELECT * FROM organizer WHERE email='$email'";
			$result = mysqli_query($con, $sql);
			if (!$result->num_rows > 0) {
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
		echo "<script>alert('Password Not Matched.')</script>";
	}
}
include("header.php");

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="">

	<title>Register Form</title>
</head>

<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="tel" placeholder="Contact Number" name="contactNum" value="<?php echo $contactNum; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<table border="1">
				<tr>
					
					<td>
						<div class="input-group">
						Account Type: 
							<input type="radio" id="org" name="acc_type" value="Organizer">
							<label for="org">Organizer</label>
							<input type="radio" id="user" name="acc_type" value="User">
							<label for="user">User</label><br>
						</div>
					</td>
				</tr>

			</table>

			<div class="input-group">
				<button name="submit" class="btn btn-success">Sign Up</button>
				<button name="reset" class="btn-danger">Reset</button>

			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
</body>

</html>