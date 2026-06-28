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
$irc = $row['IRCNick'];
$citizenname = $row['CitizenName'];
}
?>
<?php
$food_option = mysqli_real_escape_string($mysqli, $_POST['food_option']);
$weapon_option = mysqli_real_escape_string($mysqli, $_POST['weapon_option']);
$gold_option = mysqli_real_escape_string($mysqli, $_POST['gold_option']);

if($food_option == '') {
$food_option = 0;	
}

if($weapon_option == '') {
$weapon_option = 0;	
}

if($gold_option == '') {
$gold_option = 0;	
}

$date = date("Y-m-d");
$time = date("h:i:sa T");
$added = "Added New Supply Option with ".$food_option." food, ".$weapon_option." weapons, and ".$gold_option." gold";

$query1 = "INSERT INTO bs_supplyoptions (Food, Weapons, Gold) VALUES ('$food_option','$weapon_option','$gold_option')";  
$result1 = mysqli_query($mysqli, $query1) or die("Query failed ($query1) - " . mysqli_error($mysqli)); 
$sql1="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$added')";
$result1=mysqli_query($mysqli, $sql1);
header("Location: apanel.php?aop=1");	

if(!$result1) {
	header("Location: apanel.php?aop-error=1");
}
mysqli_close($mysqli);
?>