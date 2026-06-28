<?php
session_start();
$vmaid = $_SESSION['vmabsmu'];

if(!isset($vmaid)) {
header("Location: index.php");
exit;
}

elseif(isset($vmaid)) {
include('connection.php');
include('functions.php');
include('lookup.php');

$version = $row6['Version'];
$vmaname = $row1['CitizenName'];
$vmaclearance = $row1['Clearance'];
$vmaherd = $row2['HerdName'];

include("navigations.php");

if ($vmaclearance < 3) {
header("Location: home.php?denied=1");	
}

}
?>
<?php
$citid = mysqli_real_escape_string($mysqli, $_GET['id']);
date_default_timezone_set('America/Los_Angeles');
$suptoday = mysqli_real_escape_string($mysqli, $_GET['date']);
$supplyDate = date("Y-m-d");
$time = date('h:i:sa T');
$no = 'No';
$yes = 'Yes';
$req_type = mysqli_real_escape_string($mysqli, $_GET['req']);
switch($req_type) 
{
    case 'supplies':
        $query2 = "SELECT * FROM bs_supplies WHERE RequestDate='$suptoday' AND Supplied='$no' AND CitizenID = '$citid'";  
        $result2 = mysqli_query($mysqli, $query2) or die("Query failed ($query2) - " . mysqli_error($mysqli)); 
        $numrows2 = mysqli_num_rows($result2);
        $row2 = mysqli_fetch_array($result2);
        
        $citname = $row2['CitizenName'];
        $food = $row2['ReqFood'];
        $weapons = $row2['ReqWeapons'];
        
        if ($numrows2 < 1) {
            header("Location: qm.php?supplied-error=1");
        }
        
        else {
            $query3 = "UPDATE bs_supplies SET Supplied='$yes' WHERE CitizenID='$citid' AND RequestDate='$suptoday'";  
            $result3 = mysqli_query($mysqli, $query3) or die("Query failed ($query3) - " . mysqli_error($mysqli)); 
            
            $query4 = "INSERT INTO bs_supplylogs (ReqCitizen, ReqFood, ReqWeapons, DateSupplied, TimeSupplied, Supplier) VALUES ('$citname','$food','$weapons','$supplyDate','$time','$vmaname')";  
            $result4 = mysqli_query($mysqli, $query4) or die("Query failed ($query4) - " . mysqli_error($mysqli));
            
            header("Location: qm.php?supplied=".$citname."");
        }
        break;
    case 'gold':
        $query5 = "SELECT * FROM bs_gold WHERE RequestDate='$suptoday' AND Supplied='$no' AND CitizenID = '$citid'";  
        $result5 = mysqli_query($mysqli, $query5) or die("Query failed ($query5) - " . mysqli_error($mysqli)); 
        $numrows5 = mysqli_num_rows($result5);
        $row5 = mysqli_fetch_array($result5);
        
        $citname = $row5['CitizenName'];
        $goldval = $row5['ReqGold'];
        
        if ($numrows5 < 1) {
            header("Location: qm.php?supplied-error=1");
        }
        
        else {            
            $query7 = "INSERT INTO bs_goldlogs (ReqCitizen, ReqGold, DateSupplied, TimeSupplied, Supplier) VALUES ('$citname','$goldval','$supplyDate','$time','$vmaname')";  
            $result7 = mysqli_query($mysqli, $query7) or die("Query failed ($query7) - " . mysqli_error($mysqli));
			
            $query6 = "UPDATE bs_gold SET Supplied='$yes' WHERE CitizenID='$citid' AND RequestDate='$suptoday'";  
            $result6 = mysqli_query($mysqli, $query6) or die("Query failed ($query6) - " . mysqli_error($mysqli)); 
            
            header("Location: qm.php?supplied=".$citname."");
        }
        break;
}
?>