<!-- tuka design -->
<?php
include('connection.php');
session_start();

$eventID=$_GET['eventID'];
$sql = "SELECT * from event where eventID='$eventID'";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)){
        $eventNameOG = $row['eventName'];
        $eventSDateOG = $row['eventStartDate'];
        $eventEDateOG = $row['eventEndDate'];
        $eventImgOG = $row['eventImg'];
    }
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

       

       
        
        #indexLink,
        #editProfileLink {
            text-decoration: none;
            color: black;
        }

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

    <div class="container rounded bg-white mt-5">
        <button onclick="" style="float: left;" class="btn btn-dark mt-3" ><a href="index.php" style="text-decoration: none; color:white;">BACK</a></button>
        <div class="row">
            <div class="row">&nbsp;</div>
            
            <div class="col-lg-6" style="float:none;margin:auto;">
                

                <table border="0" class="eventOGTable">
                    <th></th>
                    <th>PARTICIPANT LIST</th>


                    <tr>
                        <td rowspan="6"> <img src="<?php echo $eventImgOG ?>" alt="" width="160" height="90" style="object-fit: contain;"></td>
                        <td><?php echo $eventNameOG ?></td>
                    </tr>
                    
                    <tr>

                        <td><?php echo $eventSDateOG ?> - <?php echo $eventEDateOG ?> </td>
                    </tr>
                    <tr>

                        <td></td>
                    </tr>
                    
                    <tr>


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
                        <th style="text-align:center;">Proof</th>
                        <th class="">Participant Name</th>
                        <!-- <th class="">Description</th> -->
                        <th class=""></th>
                        
                        <th class=""></th>

                    </tr>
                </thead>
                <?php
                include("connection.php");
                $query = "SELECT * FROM user,proof where user.userID = proof.userID AND proof.eventID='$eventID'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    //output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $pName = $row["username"];
                        if ($row['eventProof']==null){
                            $proof = "imageProof/not-available";
                        } else {
                            $proof = $row["eventProof"];
                        }
                        
                        $userID= $row['userID'];
                        


                ?>
                        <tbody>
                            <tr class="table-body-row">
                                <td class="pb-2" style="text-align: center;"><img src="<?php echo $proof ?>" alt="" width="160" height="90" style="object-fit: contain; "></td>
                                <td class=""><?php echo $pName ?></td>

                                <td class=""><button type="" class="btn btn-info" title="View participant's proof"><a href="viewProof.php?userID=<?php echo $userID ?>&eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;' target="_blank">View</a></button</td>
                                <td class=""><button type="" class="btn btn-danger" title="Delete participant's proof"><a href="deleteProof.php?userID=<?php echo $userID ?>&eventID=<?php echo $eventID ?>" style='color: black; text-decoration:none;'>Delete</a></button</td>
                               

                            </tr>

                        </tbody>

                <?php

                    }
                } else {
                    echo "<tr><td></td><td colspan='4'>0 results</td></tr>";
                }
                ?>

            </table>
        </div>

    </div>
</body>
<?php
include('footer.html');
?>