<?php
session_start();

echo "Username: ".$_SESSION['username'];
echo "<br>";
echo "Email: ". $_SESSION['email'];
echo "<br>";
echo "acc type: ".$_SESSION['accType'];
echo "<br>";
echo "contact number: ".$_SESSION['contactNum'] ;
echo "<br>";
echo "ID: ".$_SESSION['ID'];
echo "<br>";
echo "Profile Pic dir: " .$_SESSION['profilePicDir'];
echo "<br>";



?>

<button><a href="index.php">INDEX</a></button>