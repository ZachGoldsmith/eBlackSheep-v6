<?php 
ob_start();
session_start();
$vmaid = $_SESSION['vmabsmu'];

if(!isset($vmaid)) {
header("Location: index.php");
exit;
}

elseif(isset($vmaid)) {
include('connection.php');
include('functions.php');

$sql = "SELECT * FROM bs_accounts WHERE CitizenID = '$vmaid'";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);
$soption = $row['SupplyOption'];
$citizenname = $row['CitizenName'];
}
?>
<?php
$old_herdname = mysqli_real_escape_string($mysqli, $_POST['old_herdname']);
	$new_herdname = mysqli_real_escape_string($mysqli, $_POST['new_herdname']);
	$herd_abbrev = mysqli_real_escape_string($mysqli, $_POST['herd_abbrev']);	
	$date = date("Y-m-d");
	$time = date("h:i:sa T");
	$renamed = "Renamed ".$old_herdname." to ".$new_herdname."";		
	
	$sql2="SELECT * FROM bs_herds WHERE HerdName='$old_herdname'";
	$result2=mysqli_query($mysqli, $sql2);
	$row2 = mysqli_fetch_array($result2);
	$numrows2 = mysqli_num_rows($result2);
	
	if($numrows2 < 1 && $numrows3 < 1) {
header("Location: apanel.php?renameherd-error=1");
	}
	
	elseif($numrows2 == 1) {
	$sql4="UPDATE bs_herds SET HerdName='$new_herdname', Abbrev='$herd_abbrev'";
	$result4=mysqli_query($mysqli, $sql4);
	$sql6="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$renamed')";
	$result6=mysqli_query($mysqli, $sql6);		
header("Location: apanel.php?renameherd=1");
	}
?>