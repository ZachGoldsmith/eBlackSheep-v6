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
$discord = $row['DiscordNick'];
$citizenname = $row['CitizenName'];
}
?>
<?php
	$herdname = mysqli_real_escape_string($mysqli, $_POST['herd']);
	$new_leader = mysqli_real_escape_string($mysqli, $_POST['new_herdlead']);
	$date = date("Y-m-d");
	$time = date("h:i:sa T");
	$leadchange = "Changed leader of ".$herdname." to ".$new_leader."";		
	
	$sql2="SELECT * FROM bs_herds WHERE HerdName='$herdname'";
	$result2=mysqli_query($mysqli, $sql2);
	$row2 = mysqli_fetch_array($result2);
	$numrows2 = mysqli_num_rows($result2);
	
	$sql3="SELECT * FROM bs_accounts WHERE CitizenID='$new_leader'";
	$result3=mysqli_query($mysqli, $sql3);
	$row3 = mysqli_fetch_array($result3);
	$new_leader = $row3['CitizenName'];	
	
	if($numrows2 < 1 && $numrows3 < 1) {
header("Location: apanel.php?newleader-error=1");
	}
	
	elseif($numrows2 == 1) {
	$sql4="UPDATE bs_herds SET Leader='$new_leader' WHERE HerdName ='$herdname'";
	$result4=mysqli_query($mysqli, $sql4);
	$sql6="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$leadchange')";
	$result6=mysqli_query($mysqli, $sql6);		
header("Location: apanel.php?newleader=1");
	}
?>