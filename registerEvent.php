<?php
    session_start();
    include('connection.php');
    $eventID = $_GET['eventID'];

    $ID = $_SESSION['ID'];

    $sql = "SELECT * from joinedevent where userID='$ID' and eventID='$eventID'";
    $result = mysqli_query($con,$sql);
    
    
    while ($row=mysqli_fetch_assoc($result)){
        $eventIDJoin = $row['eventID'];
        $participantID = $row['participantID'];
        
    }
    
    if ($eventIDJoin==$eventID){
        echo "<script>alert('You are already registered!');window.location.href='myEvent.php';</script>";
    } else {
        $sql1 = "INSERT INTO joinedEvent(eventID,userID) VALUES ('$eventID','$ID')";
        $result1 = mysqli_query($con,$sql1);
        if ($result1){
            echo "<script>alert('Event Registration Successful!');window.location.href='myEvent.php';</script>";

        } else {
            echo "<script>alert('Event Registration Failed!');window.location.href='eventDetail.php?eventID=$eventID';</script>";
        }
    }
