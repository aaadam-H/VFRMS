<?php
session_start();
include('../connection.php');

$eventID = $_GET['eventID'];

$ID = $_SESSION['ID'];


    $sql = "SELECT eventProof from proof where eventID='$eventID' and userID='$ID'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)==1){
        while ($row = mysqli_fetch_assoc($result)){
            
            $eventProof = $row['eventProof'];
        }
    } else {
        $eventProof='../imageProof/not-available-circle.png';
    }


$msg = "";
    
    // If upload button is clicked ...
    if (isset($_POST['upload'])) {
    
    $ID = $_SESSION['ID'];

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "imageProof/".$filename;
            
    
    if(!$filename){
        echo "<script>alert('PLEASE UPLOAD PICTURE!')</script>";
    } else{
        if ($bttnVal=='submit'){
            $sql = "INSERT INTO proof(eventID, userID, eventProof) VALUES ('$eventID','$ID','$folder')";
         
            $result = mysqli_query($con,$sql);
            if ($result){
                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Proof Uploaded successfully";
                    echo "<script>alert('$msg');window.location.href='view-event.php'</script>";
                }else{
                    $msg = "Failed to upload!";
                    echo "<script>alert('$msg')</script>";
                }

            } else {
                    echo "<script>alert('Something went wrong! Please try again!')</script>";
                }
        } else if($bttnVal=='edit') {
                $sql = "UPDATE proof SET eventProof = '$folder' where eventID='$eventID' and userID='$ID'";
                $result = mysqli_query($con,$sql);
                if ($result){
                    if (move_uploaded_file($tempname, $folder))  {
                        $msg = "Proof Uploaded successfully";
                        echo "<script>alert('$msg');window.location.href='view-event.php'</script>";
                    }else{
                        $msg = "Failed to upload!";
                        echo "<script>alert('$msg')</script>";
                    }

                } else {
                        echo "<script>alert('Something went wrong! Please try again!')</script>";
                    }
        } else {
            echo "<script>alert('Something went wrong! Please try again!')</script>";
            }
        
       
    }
    
    }

    if (isset($_POST['delete'])){
        
        $sql = "UPDATE proof SET eventProof = 'imageProof/not-available-circle.png' WHERE userID='$ID' and eventID='$eventID'";
        $result = mysqli_query($con,$sql);
        if ($result){
            echo "<script> alert('Proof Deleted!'); window.location.href='view-event.php';</script>";
        } else {
            echo "<script>alert('Something went wrong! Please try again!')</script>";
        }
    }

$sql = "SELECT * from event where eventID='$eventID'";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)){
        $eventImg = $row['eventImg'];
        $eventName = $row['eventName'];
    } 
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Event Proof - VFRMS</title>
</head>

<body>
    <div class="container rounded bg-white mt-3 mb-5">
        
        <button onclick="" style="float: left;" class="btn btn-dark mt-3"><a href="view-event.php" style="text-decoration: none; color:white;">BACK</a></button>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="" src="<?php echo $eventImg ?>" width="640" height="360" style="object-fit:contain;"><span class="font-weight-bold"><b><?php echo $eventName ?></b> </span></div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class= "img-thumbnail" src="<?php echo $eventProof ?>" alt="N/A IF NONE UPLOADED" width="160" height="90" style="object-fit: contain;">
                        <label for="uploadfile"><b>Upload Proof</b>  </label>
                        <br>
                        <input type="file" name="uploadfile" value="" />
                    </div>
                    
                    <div class="d-flex flex-column align-items-center text-center p-3">
                        <button type="submit" name="upload" class="btn btn-primary profile-button">UPLOAD</button>
                        <br>
                        <button type="submit" name="delete" class="btn btn-danger profile-button" title="DELETE CURRENT PROOF">DELETE</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</body>

</html>
<?php
include('footer.html');
?>