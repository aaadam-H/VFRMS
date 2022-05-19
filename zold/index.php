<?PHP
include('header.php');
include("connection.php");
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
echo "  <div class='row'>
<div class='col'></div>
<div class='col'>
    <h2 style='text-align: center';>Main Menu</h2>
    <h4 style='text-align: center;'>Hi " . $_SESSION['username'] . " ( " . $_SESSION['accType'] . " )</h4> 
</div>";

echo "<div class='col'>";
echo date('l');
echo (", ");
echo date("d-m-Y");
echo (", ");
echo date("h:i:sa");
echo ("</div>");





$user = "
<div class='row'>
    <div class='col'>
        <fieldset style='width: 100%'>

            <table border='4' align='center' width='60%' >
            <tr > 
                <td style='padding:10px;' align='center'><a href= 'eventOpt.php'><img src='img/event.png'></a></td>
                <td style='padding:10px;' align='center'><a href= 'profile.php'><img src='img/man.png'></a></td>
               
            </tr>
            
            <tr> 
                <td align='center' style='padding-bottom:5px;'> Event </td>
                <td align='center' style='padding-bottom:5px;'> Profile </td>
               
            </tr>
            </table>
            </fieldset>
    </div>";

$org = "<div class='row'>
<div class='col'>
    <fieldset style='width:100%'>

    <table border='4' align='center' width='50%' style='border-top: none;'>
        <tr> 
            <td style='padding:10px;' align='center'><a href= 'createEvent.php'><img src='img/page.png'></a></td>
            
         
        </tr>
        
        <tr> 
            <td align='center' style='padding-bottom:5px;'> Create Event </td>
          
          
        </tr>
        </table>
        </fieldset>
</div>

</div>";

$shared = "

</div>
        <div class='row'><br></div>
        <div class='row'><br></div>
        <div class='row'><br></div>
        <div class='row'><br></div>
        <div class='row'><br></div>
        <div class='row'><br></div>
        <div class='row'>
            <div class='col'>
            </div>
            <div class='col'>
            </div>
            <div class='col'>
            </div>
            <div class='col text-center'>
                <button type='button' class='btn btn-warning'><a href='logout.php' style='text-decoration:none; color:Black;'>Logout</a></button>
            </div>
            <div class='col'>
            </div>
            <div class='col'>
            </div>
            <div class='col'>
            </div>
            
        </div>

    </div>
";

switch ($_SESSION['accType']) {
    case 'organizer'://admin/org
        echo $user . $org . $shared;
        break; 
    case 'user':
        echo $user . $shared;
        break;
    default:
        header('Location: logout.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>Virtual Fun Run Management System</title>
    <style>
        body{
           overflow-x: hidden;
        }
    </style>

</head>
<?php
    include('footer.html');
?>