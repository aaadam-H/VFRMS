<?php
session_start();
include('connection.php');
include('header.php');
$orgID = $_SESSION['ID'];
$accType = $_SESSION['accType'];

if ($accType == 'user') {
    header('location:index.php');
}

$sql = "SELECT * from event WHERE status='ongoing' and orgID='$orgID'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $eventImgOG = $row['eventImg'];
    $eventIDOG = $row['eventID'];
    $eventNameOG = $row['eventName'];
    $eventDescOG = $row['eventDesc'];
    $eventSDateOG = $row['eventStartDate'];
    $eventEDateOG = $row['eventEndDate'];
} else {
    $eventImgOG = '';
    $eventIDOG = null;
    $eventNameOG = '';
    $eventDescOG = '';
    $eventSDateOG = '';
    $eventEDateOG = '';
}

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

    <title>Event - VFRMS</title>
    <style>
        .eventOGTable td {
            padding-inline: 10px;
            padding-bottom: 5px;

        }

        <?php
        if (!$eventIDOG) {
        ?>.eventOGTable {
            display: none;
        }
        hr{
            display: none;
        }

        <?php
        }
        ?>#indexLink,
        #editProfileLink {
            text-decoration: none;
            color: black;
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }
    </style>


</head>

<body>

    <div class="container rounded bg-white mt-5 pb-3">
        <button onclick="" style="float: left;" class="btn btn-dark mt-3"><a href="index.php" style="text-decoration: none; color:white;">BACK</a></button>
        <div class="row">
            <div class="row">&nbsp;</div>

            <div class="col-lg-6" style="float:none;margin:auto;">


                <table border="0" class="eventOGTable">
                    <th></th>
                    <th>ONGOING</th>


                    <tr>
                        <td rowspan="8"> <img src="<?php echo $eventImgOG ?>" alt="" width="160" height="90" style="object-fit: contain;"></td>
                        <td><?php echo $eventNameOG ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $eventDescOG ?></td>
                    </tr>
                    <tr>

                        <td><?php echo $eventSDateOG ?> - <?php echo $eventEDateOG ?></td>
                    </tr>
                   
                    <tr>
                        <td><button type="submit" name="editEvent" class="btn btn-warning"> <a href="editEvent.php?eventID=<?php echo $eventIDOG ?>" style="text-decoration:none; color:black;">Edit Event</a> </button></td>

                    </tr>
                    <td><button type="submit" name="View Participant" class="btn btn-info"><a href="viewParticipant.php?eventID=<?php echo $eventIDOG ?>" style="text-decoration:none; color:black;">View Participant</a></button></td>

                    <tr>
                    <tr>
                        <td><button type="submit" name="endEvent" class="btn btn-danger"><a href="eventEnd.php?eventID=<?php echo $eventIDOG ?>" style="text-decoration:none; color:black;">End Event</a></button></td>
                    </tr>


                    </tr>
                </table>
            </div>
        </div>
        <div class="row"> &nbsp;
            <hr width="100%">
        </div>
        <div class="row">
            <table class="" border="0">
                <thead class="">
                    <tr class="">
                        <th class=""></th>
                        <th class="">Event Name</th>
                        <!-- <th class="">Description</th> -->
                        <th class="">Start Date</th>
                        <th class="">End Date</th>

                        <th class=""></th>

                    </tr>
                </thead>
                <?php
                include("connection.php");
                $query = "SELECT * FROM event where status='ongoing' AND NOT orgID='$orgID'";
                $result = mysqli_query($con, $query);

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
                                <td class=""><?php echo $eventName ?></td>
                                <!-- <td class=""><?php echo $eventDesc ?></td> -->
                                <td class=""><?php echo $eventSDate ?></td>
                                <td class=""><?php echo $eventEDate ?></td>

                                <td class=""><button type="" class="btn btn-info"><a href="eventDetail.php?eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>CHECK</a></button< /td>

                            </tr>

                        </tbody>

                <?php

                    }
                } else {
                    echo "<tr><td colspan='5'>0 results</td></tr>";
                }
                ?>

            </table>
        </div>

    </div>
</body>
<?php
include('footer.html');
?>