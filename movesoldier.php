<?php
ob_start();

session_start();
$vmaid= $_SESSION['vmabsmu'];

if(!isset($vmaid)) {
header("Location: index.php");
exit;
}

elseif(isset($vmaid)) {
include('connection.php');
include('functions.php');
include('lookup.php');

$clearance = $row1['Clearance'];

if($clearance < 3) {
$lastlocation = $_SERVER['HTTP_REFERER'];
header("Location: ".$lastlocation."?denied=1");
exit;	
}


$soldierlocation = $_GET['herd'];
$soldier = $_GET['id'];

$sql5 = "UPDATE bs_accounts SET Team='".$soldierlocation."' WHERE CitizenID = ".$soldier."";
$result5 = mysqli_query($mysqli, $sql5);

$sql7 = "SELECT * FROM bs_accounts WHERE CitizenID = ".$soldier."";
$result7 = mysqli_query($mysqli, $sql7);
$row7 = mysqli_fetch_array($result7);
$soldiername = $row7['CitizenName'];

$sql8 = "SELECT * FROM bs_herds WHERE HerdAbbr = '$soldierlocation'";
$result8 = mysqli_query($mysqli, $sql8);
$row8 = mysqli_fetch_array($result8);
$herdname = strtoupper($row8['HerdName']);

mysqli_close($mysqli);
if($soldierlocation == "1LH"){
header("Location: teamlist.php?moved=1&team=".$herdname."&name=".$soldiername."");
}
else {
header("Location: teamlist.php?returned=1&team=".$herdname."&name=".$soldiername."");
}
}
?>