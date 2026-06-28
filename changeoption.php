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
$option_number = mysqli_real_escape_string($mysqli, $_POST['option']);
$new_food = mysqli_real_escape_string($mysqli, $_POST['new_food']);
$new_weapons = mysqli_real_escape_string($mysqli, $_POST['new_weapon']);
$new_gold = mysqli_real_escape_string($mysqli, $_POST['new_gold']);
$date = date("Y-m-d");
$time = date("h:i:sa T");
$changed = "Changed Option #".$option_number." to ".$new_food." food, ".$new_weapons." weapons, and ".$new_gold." gold";

$query1 = "UPDATE bs_supplyoptions SET Food='$new_food', Weapons='$new_weapons', Gold='$new_gold' WHERE OptionNumber='$option_number'";  
$result1 = mysqli_query($mysqli, $query1) or die("Query failed ($query1) - " . mysqli_error($mysqli)); 
$sql1="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$changed')";
$result1=mysqli_query($mysqli, $sql1);
header("Location: apanel.php?changeoption=1");	

if(!$result1) {
	header("Location: apanel.php?changeoption-error=1");
}
mysqli_close($mysqli);
?>