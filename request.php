<?php
error_reporting(0);
include('connection.php');
include('functions.php');
session_start();
$vmaid= $_SESSION['vmabsmu'];

$sql1="SELECT * FROM bs_accounts WHERE CitizenID='$vmaid'";
$result1=mysqli_query($mysqli, $sql1);
$row = mysqli_fetch_array($result1);

$citizenid = $row['CitizenID'];
$citizenname = $row['CitizenName'];

if(!isset($vmaid))
{
header("Location: index.php");
exit;
}
?>
<?php
date_default_timezone_set('America/Los_Angeles');
$last_location = $_SERVER['HTTP_REFERER'];
$suptoday = date("Y-m-d");
$time = date('h:i:sa T');
$no = 'No';
$yes = 'Yes';

$query2 = "SELECT * FROM bs_supplies WHERE CitizenID='$citizenid' AND RequestDate='$suptoday'";  
$result2 = mysqli_query($mysqli, $query2) or die("Query failed ($query2) - " . mysqli_error($mysqli)); 
$row2 = mysqli_fetch_array($result2);
$numrows2 = mysqli_num_rows($result2);

$reqdate2 = date("Y-m-d");
$reqtime = date('h:i:sa T');

if ($numrows2 < 1) {
$query5 = "SELECT * FROM bs_accounts WHERE CitizenID = '$citizenid'";  
$result5 = mysqli_query($mysqli, $query5) or die("Query failed ($query5) - " . mysqli_error($mysqli)); 
$row5 = mysqli_fetch_array($result5);	

$option = $row5['SupplyOption'];
$status5 = $row5['CommuneStatus'];
	
$query6 = "SELECT * FROM bs_supplyoptions WHERE OptionNumber = '$option'";  
$result6 = mysqli_query($mysqli, $query6) or die("Query failed ($query6) - " . mysqli_error($mysqli)); 
$row6 = mysqli_fetch_array($result6);

if ($row5['DoubleSupplies'] == "doubled") {
    $reqfood = $row6['Food'] * 2;
    $reqweapons = $row6['Weapons'] * 2;
    $reqgold = $row6['Gold'] * 2;    
}
else {
    $reqfood = $row6['Food'];
    $reqweapons = $row6['Weapons'];
    $reqgold = $row6['Gold'];
}

switch($option) {
    case '5': // gold supply option
        $query4 = "INSERT INTO bs_gold (CitizenID, CitizenName, RequestDate, RequestTime, ReqGold, CommuneStatus) VALUES ('$citizenid','$citizenname','$reqdate2','$reqtime','$reqgold','$status5')";		       
        break;
    default: // normal supply options 1-4
        $query4 = "INSERT INTO bs_supplies (CitizenID, CitizenName, RequestDate, RequestTime, ReqFood, ReqWeapons, CommuneStatus) VALUES ('$citizenid','$citizenname','$reqdate2','$reqtime','$reqfood','$reqweapons','$status5')";      
}
$result4 = mysqli_query($mysqli, $query4) or die("Query failed ($query4) - " . mysqli_error($mysqli));


$requested = "Requested Supplies";
date_default_timezone_set('America/Los_Angeles');
$date2 = date("Y-m-d");
$time2 = date("h:i:sa T");
$sql="INSERT INTO bs_slogs (Date, Time, CitizenName, Action) VALUES ('$date2', '$time2', '$citizenname', '$requested')";
$result=mysqli_query($mysqli, $sql);
header("Location: ".$last_location."?requested=1");
exit;
}

else {
header("Location: ".$last_location."?error=1");	
exit;
}
?>