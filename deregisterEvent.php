<?php
session_start();
include('connection.php');
$eventID = $_GET['eventID'];
$ID = $_SESSION['ID'];
$eventSql = "SELECT contactNumEvent from event WHERE eventID='$eventID'";
$result0 = mysqli_query($con,$eventSql);
if ($result0){
    $row = mysqli_fetch_assoc($result0);
    $contactNumEvent = $row['contactNumEvent'];

}

$sql = "DELETE FROM joinedevent WHERE eventID='$eventID' AND userID='$ID'";
$result = mysqli_query($con,$sql);
if($result){
    echo "<script>alert('Deregister successfully! Please contact organizer at ".$contactNumEvent." for refund!'); window.location.href='myEvent.php';</script>";
} else {
    echo "<script>alert('Deregister failed! Please try again!'); window.location.href='myEvent.php';</script>";
}
?>