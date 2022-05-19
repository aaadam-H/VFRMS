<?php
    include("connection.php");
    include("header.php");
    session_start();

    if (!isset($_SESSION['username'])) { //show option based on user type. check whether ada data dlm table user/organizer. 
        header("Location: login.php");
    }

    $email = $_SESSION['email'];
    $sql = "SELECT * from organizer WHERE email='$email'";
    $result = mysqli_query($con, $sql);
			if ($result->num_rows > 0) { //oragnizer 
                echo "<script>alert('organizer sec')</script>";
               //echo "<script>window.location.href='welcome.php'</script>"; //test
            
            }
            else{ //user
                echo "<script>alert('user sec')</script>";
                echo "<script>window.location.href='welcome.php'</script>"; //test
            }
?>
<a href="logout.php">Logout</a>