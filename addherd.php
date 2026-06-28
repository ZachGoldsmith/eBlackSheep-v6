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
$herd_abbrev = mysqli_real_escape_string($mysqli, $_POST['abbrev']);
$herd_name = mysqli_real_escape_string($mysqli, $_POST['herdname']);
$herd_short = ltrim($herd_abbrev, '1');
$date = date("Y-m-d");
$time = date("h:i:sa T");
$added = "Added ".$herd_name;

$query1 = "INSERT INTO bs_herds (HerdShort, HerdAbbr, HerdName, Leader) VALUES ('$herd_short','$herd_abbrev', '$herd_name', 'None')";  
$result1 = mysqli_query($mysqli, $query1) or die("Query failed ($query1) - " . mysqli_error($mysqli)); 
$sql1="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$added')";
$result1=mysqli_query($mysqli, $sql1);
header("Location: apanel.php?addherd=1");	

if(!$result1) {
	header("Location: apanel.php?addherd-error=1");
}
mysqli_close($mysqli);
?>