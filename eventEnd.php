<?php
    session_start();
    include('connection.php');
    $eventID = $_GET['eventID'];
    $status = $_GET['status'];
    if($status=='completed'){
        echo "<script>alert('EVENT ALREADY ENDED!'); window.location.href='myEvent.php'</script>";
    } else{
        $sql = "UPDATE event SET status='completed' where eventID='$eventID'";
        $result = mysqli_query($con,$sql);
        // $sql1 = "UPDATE user SET ongoingEvent=null where ongoingEvent='$eventID'";
        // $result1 = mysqli_query($con,$sql1);

        // if ($result && $result1){
        if ($result && $result1){
            echo "<script>alert('Event Ended!'); window.location.href='myEvent.php'</script>";
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    }
    

?>