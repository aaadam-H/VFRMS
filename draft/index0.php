<?PHP 
include ('header.php');
include ("connection.php");
session_start();
echo"<h2>Main Menu</h2>
<h4>Hi ".$_SESSION['username']." ( " . $_SESSION['accType']." )</h4> ";
date_default_timezone_set("Asia/Kuala_Lumpur");
echo date("l").", ".date("Y-m-d").", ".date("h:i:sa");

 

$user="<fieldset style='width:90%'>
 
<table border='2' align='center' width='100%'>
<tr> 
    <td  width='14.2%' align='center'><a href= '#'><img src='#'></a></td>
    <td  width='14.2%' align='center'><a href= '#'><img src='#'></a></td>
   
</tr>

<tr> 
    <td align='center'> Event </td>
    <td align='center'> Profile </td>
   
</tr>
</table>
</fieldset>";

$org="<fieldset style='width:90%'>
 
<table border='2' align='center' width='100%'>
<tr> 
    <td  width='14.2%' align='center'><a href= '#'><img src='#'></a></td>
    
 
</tr>

<tr> 
    <td align='center'> Create Event </td>
  
  
</tr>
</table>
</fieldset>";

$shared="

<button type='button' class='btn btn-warning'><a href='logout.php'>Logout</a></button>
";

switch($_SESSION['accType'])
{
    case 'organizer' : echo $user.$org.$shared; break; //admin/org
    case 'user' : echo $user.$shared; break;
    default      : header('Location: logout.php');
    
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="">

	<title>Virtual Fun Run Management System</title>
    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <button type='button' class='btn btn-warning'><a href='logout.php'>Logout</a></button>
            </div>
            <div class="col">

            </div>

        </div>

    </div>
    
</head>

<?php
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        if (!$password == "") {
            
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
        
    }

?>