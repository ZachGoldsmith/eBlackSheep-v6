<?php
ob_start();
include('connection.php');
include('functions.php');

session_start();
$vmaid = $_SESSION['vmabsmu'];

$sql="SELECT * FROM bs_accounts WHERE CitizenID='".$vmaid."'";
$result=mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);

$reqname = $row['CitizenName'];

if(!isset($vmaid))
{
header("Location: index.php");
exit;
}
?>

<?php
date_default_timezone_set('America/Los_Angeles');
$last_location_success = $_SERVER['HTTP_REFERER']."?recieved=1";
$last_location_error = $_SERVER['HTTP_REFERER']."?error=1";
$today = date("Y-m-d");
$now = date('h:i:sa T');
$n = 'No';
$y = 'Yes';
$timestamp = time();

// Check to see if Soldier has Requested Already
$query2 = "SELECT * FROM bs_supplies WHERE CitizenID='".$vmaid."' AND RequestDate='".$today."'";  
$result2 = mysqli_query($mysqli, $query2) or die("Query failed ($query2) - " . mysqli_error($mysqli)); 
$row2 = mysqli_fetch_array($result2);
$numrows2 = mysqli_num_rows($result2);

$query7 = "SELECT * FROM bs_gold WHERE CitizenID='".$vmaid."' AND RequestDate='".$today."'";  
$result7 = mysqli_query($mysqli, $query7) or die("Query failed ($query7) - " . mysqli_error($mysqli)); 
$row7 = mysqli_fetch_array($result7);
$numrows7 = mysqli_num_rows($result7);

// If they have not, run this
if($numrows2 < 2 && $numrows7 < 2) {
$query3 = "SELECT * FROM bs_accounts WHERE CitizenID = '".$vmaid."'";  
$result3 = mysqli_query($mysqli, $query3) or die("Query failed ($query3) - " . mysqli_error($mysqli)); 
$row3 = mysqli_fetch_array($result3);	

$option = $row3['SupplyOption'];
$status = $row3['CommuneStatus'];

if($status == "") {
	$status = 'Unknown';
}
	
$query4 = "SELECT * FROM bs_supplyoptions WHERE OptionNumber = '".$option."'";  
$result4 = mysqli_query($mysqli, $query4) or die("Query failed ($query4) - " . mysqli_error($mysqli)); 
$row4 = mysqli_fetch_array($result4);

if ($row3['DoubleSupplies'] == "doubled") {
    $reqfood = $row4['Food'] * 2;
    $reqweapons = $row4['Weapons'] * 2;
    $reqgold = $row4['Gold'] * 2;    
}
else {
    $reqfood = $row4['Food'];
    $reqweapons = $row4['Weapons'];
    $reqgold = $row4['Gold'];
}

if($reqgold == '') {
$reqgold = 0;	
}

$reqnum = $reqnum + 1;

switch($option) {
    case '5': // gold supply option
        $query5 = "INSERT INTO bs_gold (CitizenID, CitizenName, RequestDate, RequestTime, ReqGold, CommuneStatus) VALUES ('$vmaid','$reqname','$today','$now','$reqgold','$status')";        
        break;
    default: // normal supply options 1-4
        $query5 = "INSERT INTO bs_supplies (CitizenID, CitizenName, RequestDate, RequestTime, ReqFood, ReqWeapons, ReqGold, CommuneStatus) VALUES ('$vmaid','$reqname','$today','$now','$reqfood','$reqweapons','$reggold','$status')";      
}
$result5 = mysqli_query($mysqli, $query5) or die("Query failed ($query5) - " . mysqli_error($mysqli));


$requested = "Requested Supplies";
$sql6="INSERT INTO bs_slogs (Date, Time, CitizenName, Action) VALUES ('$today', '$now', '$reqname', '$requested')";
$result6=mysqli_query($mysqli, $sql6);
header("Location: home.php?recieved=1");
}
// If they have, run this
else {
header("Location: home.php?error=1");	
}
mysqli_close($mysqli);
ob_flush();
?>