<?php

include("connection.php");
// include("header.php");

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
	header("Location: welcome.php");
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
		header("Location: index.php");
	} else {
		$sql = "SELECT * FROM user WHERE uEmail='$email' AND uPass='$password'";
		$result1 = mysqli_query($con, $sql);
		if ($result1->num_rows > 0) { //user check
			$row = mysqli_fetch_assoc($result1);
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['uEmail'];
			$_SESSION['accType'] = $row['accType'];
			header("Location: index.php");
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="">

	<title>Login Form</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<form action="" method="POST" class="login-email">
					<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
					<div class="input-group">
						<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
					</div>
					<div class="input-group">
						<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
					</div>
					<div class="input-group">
						<button name="submit" class="btn btn-success">Login</button>
					</div>
					<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
				</form>
			</div>
		</div>

	</div>
</body>

</html>