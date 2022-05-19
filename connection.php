<?php
    $con = mysqli_connect("localhost","root","","vfrms");

    if (!$con){
        echo("<script>alert('Connection Failed!')</script>");
        die("<script>window.location.href='error.php'</script>");
        
    }
    date_default_timezone_set("Asia/Kuala_Lumpur");
?>