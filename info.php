<?php
session_start();
include('connection.php');
$accType = $_SESSION['accType'];
$ID = $_SESSION['ID'];


echo "Username: " . $_SESSION['username'];
echo "<br>";
echo "Email: " . $_SESSION['email'];
echo "<br>";
echo "acc type: " . $_SESSION['accType'];
echo "<br>";
echo "contact number: " . $_SESSION['contactNum'];
echo "<br>";
echo "ID: " . $_SESSION['ID'];
echo "<br>";
echo "Profile Pic dir: " . $_SESSION['profilePicDir'];
echo "<br>";



?>

<button><a href="home.php">HOME</a></button>

