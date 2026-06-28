<title>Adding Soldier</title>
<?php 
	ob_start();  
	include('connection.php');
	include('functions.php');
	$citid = mysqli_real_escape_string($mysqli, $_POST['citid']);
	$citpw = mysqli_real_escape_string($mysqli, sha1($_POST['citpw']));

	
	$sql2="SELECT * FROM bs_accounts WHERE CitizenID='$citid'";
	$result2=mysqli_query($mysqli, $sql2);
	$row2=mysqli_fetch_array($result2);
	$numrows2=mysqli_num_rows($result2);
	$citname=$row2['CitizenName'];
	
	$changedpw = "Changed ".$citname."'s Password";
	
	if($numrows2 == 1) {
	$sql5="UPDATE bs_accounts SET Password='$citpw' WHERE CitizenID='$citid'";
	$result5=mysqli_query($mysqli, $sql5);
	$sql10="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$changedpw')";
	$result10=mysqli_query($mysqli, $sql10);
	header("Location: apanel.php?changesoldierpw=1");			
	}
	else {
	header("Location: apanel.php?changesoldierpw-error=1");
	}
?>
<?php
ob_flush();
mysqli_close($mysqli);
?>