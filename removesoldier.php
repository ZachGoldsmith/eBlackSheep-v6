<?php
ob_start();
date_default_timezone_set('America/Los_Angeles');
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
}
?>
<?php 
	include('connection.php');
	$citid = mysqli_real_escape_string($mysqli, $_POST['citid']);
	$citname = mysqli_real_escape_string($mysqli, $_POST['citname']);
	$date = date("Y-m-d");
	$time = date("h:i:sa T");
	$removed = "Removed ".$citname." (".$citid.")";
	
	$sql2="SELECT * FROM bs_accounts WHERE CitizenID='$citid' AND CitizenName='$citname'";
	$result2=mysqli_query($mysqli, $sql2);
	$row2 = mysqli_fetch_array($result2);
	$numrows2 = mysqli_num_rows($result2);
	
	if($numrows2 < 1) {
	header("Location: apanel.php?removesoldier-error=1");
	}
	
	if($numrows2 == 1) {
	$sql3="DELETE FROM bs_accounts WHERE CitizenID='$citid' AND CitizenName='$citname'";
	$result3=mysqli_query($mysqli, $sql3);
	$sql4="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$removed')";
	$result4=mysqli_query($mysqli, $sql4);
	header("Location: apanel.php?removesoldier=1");		
	}
	
//Close MYSQLI Connection 
mysqli_close($mysqli);
ob_flush();

?>