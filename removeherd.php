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
$herdname = mysqli_real_escape_string($mysqli, $_POST['herdname']);
	$date = date("Y-m-d");
	$time = date("h:i:sa T");
	$removed = "Removed ".$herdname;
	
	$sql2="SELECT * FROM bs_herds WHERE HerdName='$herdname'";
	$result2=mysqli_query($mysqli, $sql2);
	$row2 = mysqli_fetch_array($result2);
	$numrows2 = mysqli_num_rows($result2);
	
	if($numrows2 < 1 && $numrows3 < 1) {
header("Location: apanel.php?removeherd-error=1");
	}
	
	elseif($numrows2 == 1) {
	$sql4="DELETE FROM bs_herds WHERE HerdName='$herdname'";
	$result4=mysqli_query($mysqli, $sql4);
	$sql6="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$removed')";
	$result6=mysqli_query($mysqli, $sql6);			
header("Location: apanel.php?removeherd=1");
	}
	mysqli_close($mysqli);
?>