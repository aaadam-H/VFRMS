<?php
session_start();
include('connection.php');
$ID = $_GET['orgID'];
$eventID = $_GET['eventID'];


$sql = "DELETE FROM event WHERE eventID='$eventID'";

$result = mysqli_query($con,$sql);
if ($result){
    echo "<script> alert('Proof Deleted!'); onload='history.back();</script>";
} else {
    echo "<script>alert('Something went wrong! Please try again!'); window.location.href='pastEvent.php';</script>";
}



?>
<html>
    <head>
        <script>
            history.back();
        </script>
    </head>
</html>