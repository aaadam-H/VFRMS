<?php
    session_start();
    
    if ($_SESSION['accType']=='organizer'){
        header('location:view-event-org.php');
    } else if ($_SESSION['accType']=='user'){
        header('location:view-event.php');
    } else {
        header('location:index.php');
    }



?>