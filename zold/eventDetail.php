<?php
session_start();
include('connection.php');
$accType = $_SESSION['accType'];


$eventID = $_GET['eventID'];
$sql = "SELECT * FROM event,organizer where event.orgID=organizer.orgID AND eventID='$eventID'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $eventName = $row['eventName'];
        $eventDesc = $row['eventDesc'];
        $eventStatus = $row['status'];
        $eventSDate = $row['eventStartDate'];
        $eventEDate = $row['eventEndDate'];
        $orgName = $row['username'];
        $eventImg = $row['eventImg'];
        $fee = $row['fee'];
        $feeEarly = $row['earlyFee'];
        $eventRegSDate = $row['registerStartDate'];
        $eventRegEDate = $row['registerEndDate'];
    }
}

$sql1 = "SELECT COUNT(participantID) as TOTAL from participant WHERE eventID='$eventID'";
$result1 = mysqli_query($con,$sql1);
if(mysqli_num_rows($result1)>0){
    while ($row = mysqli_fetch_assoc($result1)){
        $totalParticipant = $row['TOTAL'];
    }
} 

?>


<html>
    <head>
        <title>Event Detail - VFRMS</title>
        <link rel="stylesheet" href="styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    </head>
    <body>
        <?php
        include ('header.php');
        ?>
        <div class="container rounded bg-white mt-5 pb-5">
            <button onclick="history.back()" style="float: left;" class="btn btn-dark mt-3">BACK</button>
            <div class="row">
                <div class="col-lg-6" style="float: none; margin:auto;">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-3"><img class="rounded mt-5" src="<?php echo $eventImg ?>" width="320" ></div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Event Name: </strong></div> 
                        <div class="col-md-8"><?php echo $eventName ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Event Description: </strong></div> 
                        <div class="col-md-8"><?php echo $eventDesc ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Status: </strong></div> 
                        <div class="col-md-8"><?php echo $eventStatus ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Event Register Start Date: </strong></div> 
                        <div class="col-md-8"><?php echo $eventRegSDate ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Event Register End Date: </strong></div> 
                        <div class="col-md-8"><?php echo $eventRegEDate ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Event Start Date: </strong></div> 
                        <div class="col-md-8"><?php echo $eventSDate ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Event End Date: </strong></div> 
                        <div class="col-md-8"><?php echo $eventEDate ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Organize By: </strong></div> 
                        <div class="col-md-8"><?php echo $orgName ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Total Participant: </strong></div> 
                        <div class="col-md-8"><?php echo $totalParticipant ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Fee: </strong></div> 
                        <div class="col-md-8">RM<?php echo $fee ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Early Bird Fee: </strong></div> 
                        <div class="col-md-8">RM<?php echo $feeEarly ?></div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center ">
                    <?php
                    if ($accType=='user'){
                        ?>
                        <button type="" class="btn btn-success mt-3"><a href="registerEvent.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>REGISTER</a></button>
                        <?php
                    }
                    ?>
                    
                    </div>
                    
                </div>
            </div>
            
        </div>
    </body>
</html>
<?php
include('footer.html');
?>