<?php
session_start();
include('connection.php');
$ID = $_SESSION['ID'];
$accType = $_SESSION['accType'];




include('header.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>Past Event - VFRMS</title>
    <style>

        .back:hover {
            color: #682773;
            cursor: pointer
        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>


</head>
<body>

    <div class="container rounded bg-white mt-5 pb-3">
        <button onclick="history.back()" style="float: left;" class="btn btn-dark mt-3" >BACK</button>
       
        <div class="row mt-3">
            <div class="row mb-3">
                <div class="col text-center"><h1>Past Event</h1></div>
            </div>
            <table class="" border="0">
                <thead class="">
                    <tr class="">
                        <th class=""></th>
                        <th class="">Event Name</th>
                        
                        <th class="">Start Date</th>
                        <th class="">End Date</th>
                        <?php
                            if($accType=='organizer'){
                                ?>
                                <th class="">Status</th>
                                <?php
                            }
                        ?>
                        
                        
                        <th class=""></th>

                    </tr>
                </thead>
                <?php
                if($accType=='user'){
                    $query = "SELECT * FROM participant AS p,event AS e,user AS u where p.eventID=e.eventID AND p.userID=u.userID AND e.status='completed' and p.userID='$ID'";
                    $result = mysqli_query($con, $query);
                } else {
                    $query = "SELECT * FROM event where orgID='$ID' AND status='completed'";
                    $result = mysqli_query($con, $query);
                }
                

                if (mysqli_num_rows($result) > 0) {
                    //output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $eventName = $row["eventName"];
                        $eventDesc = $row["eventDesc"];
                        $eventSDate = $row["eventStartDate"];
                        $eventEDate = $row["eventEndDate"];
                        $eventStatus = $row["status"];
                        $eventID = $row['eventID'];
                        $eventImg = $row['eventImg'];


                ?>
                        <tbody>
                            <tr class="table-body-row">
                                <td class="" style="text-align: center;"><img src="<?php echo $eventImg ?>" alt="" width="160" height="90" style="object-fit: contain; "></td>
                                <td class=""><a href="eventDetail.php?eventID=<?php echo $eventID ?>" style="text-decoration:none; color:black;"><?php echo $eventName ?></a></td>
                                
                                <td class=""><?php echo $eventSDate ?></td>
                                <td class=""><?php echo $eventEDate ?></td>
                                <?php
                                if ($accType=='user'){
                                    ?>
                                    <td class=""><button type="" class="btn btn-info"><a href="eventDetail.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>CHECK</a></button</td>
                                    <td class=""><button type="" class="btn btn-danger"><a href="deleteProof.php?eventID=<?php echo $eventID ?>&userID=<?php echo $ID ?>" style='color: black; text-decoration:none;' title="Delete uploaded proof">DELETE</a></button</td>
                               <?php
                                } else { ?>
                                    <td class=""><?php echo $eventStatus ?></td>
                                    <td class=""><button type="" class="btn btn-info"><a href="viewParticipant.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>View Participant</a></button</td>
                                    <td class=""><button type="" class="btn btn-danger"><a href="deleteEvent.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' title="Delete Event">DELETE</a></button</td>
                                    <?php
                                }
                                ?>
                                

                            </tr>

                        </tbody>

                <?php

                    }
                } else {
                    echo "<tr><td colspan='2'></td><td colspan='5'>0 results</td></tr>";
                }
                ?>

            </table>
        </div>

    </div>
</body>
<?php
include('footer.html');
?>