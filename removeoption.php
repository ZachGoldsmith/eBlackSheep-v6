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
$option_number = mysqli_real_escape_string($mysqli, $_POST['option']);
$date = date("Y-m-d");
$time = date("h:i:sa T");
$removed = "Removed Option #".$option_number;

if($option_number == '1' || $option_number == '2' || $option_number == '3' || $option_number == '4'){
header("Location: apanel.php?removeoption-originals=1");	
exit;
}

$query1 = "DELETE FROM bs_supplyoptions WHERE OptionNumber='$option_number'";  
$result1 = mysqli_query($mysqli, $query1) or die("Query failed ($query1) - " . mysqli_error($mysqli)); 
$sql1="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$removed')";
$result1=mysqli_query($mysqli, $sql1);
$ai = $option_number;
$sql2="ALTER TABLE bs_supplyoptions AUTO_INCREMENT = ".$ai."";
$result2=mysqli_query($mysqli, $sql2);
header("Location: apanel.php?removeoption=1");	

if(!$result1) {
	header("Location: apanel.php?removeoption-error=1");
}
mysqli_close($mysqli);
?>