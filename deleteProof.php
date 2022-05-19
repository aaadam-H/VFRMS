<?php
session_start();
include('connection.php');
$userID = $_GET['userID'];
$eventID = $_GET['eventID'];


$sql = "DELETE FROM proof WHERE userID='$userID' and eventID='$eventID'";

$result = mysqli_query($con,$sql);
if ($result){
    echo "<script> alert('Proof Deleted!'); onload='history.back();</script>";
} else {
    echo "<script>alert('Something went wrong! Please try again!'); window.location.href='viewParticipant.php';</script>";
}



?>

<html>
    <head>
        <script>
            history.back();
        </script>
    </head>
</html>