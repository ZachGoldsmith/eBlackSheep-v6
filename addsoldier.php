<title>Adding Soldier</title>
<?php 
ob_start();
 
	include('connection.php');
	include('functions.php');
	$newcitid = mysqli_real_escape_string($mysqli, $_POST['citid']);
	$citname = mysqli_real_escape_string($mysqli, $_POST['citname']);
	$discord = mysqli_real_escape_string($mysqli, $_POST['discordnick']);
	$herd = mysqli_real_escape_string($mysqli, $_POST['herd']);
	$date = date("Y-m-d");
	$time = date("h:i:sa T");
	$added = "Added Soldier ".$citname." (".$citid.") to ".$herd."";
	
	$sql3 = "SELECT * FROM bs_herds WHERE HerdName = '$herd'";
	$result3 = mysqli_query($mysqli, $sql3);
	$row3 = mysqli_fetch_array($result3);
	$herdabbr = $row3['HerdAbbr'];
	
	$supplyoption = mysqli_real_escape_string($mysqli, $_POST['supplyoption']);
	$clearance = mysqli_real_escape_string($mysqli, $_POST['clearance']);
	if($clearance == '1 - Soldier') {
		$clearance = '1';
	}
	elseif($clearance == '2 - Herd Leader') {
		$clearance = '2';
	}
	elseif($clearance == '3 - Honor Guard') {
		$clearance = '3';
	}
	elseif($clearance == '4 - Admin') {
		$clearance = '4';
	}
	elseif($clearance == '5 - Super Admin') {
		$clearance = '5';
	}
	
	$commune = mysqli_real_escape_string($mysqli, $_POST['commune']);
	$insignia = mysqli_real_escape_string($mysqli, $_POST['insignia']);
	
	if($insignia == 'E1 - Soldier') {
		$insignia = 'E1';
	}
	elseif($insignia == 'O1 - Officer Rank 1') {
		$insignia = 'O1';
	}
	elseif($insignia == '02 - Officer Rank 2') {
		$insignia = 'O2';
	}		
	elseif($insignia == '03 - Officer Rank 3') {
		$insignia = 'O3';
	}	
	
	$sql2="SELECT * FROM bs_accounts WHERE CitizenID='$citid'";
	$result2=mysqli_query($mysqli, $sql2);
	$numrows2=mysqli_num_rows($result2);
	
	$password = sha1('vma214');
	
	if($numrows2 < 1) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql5="INSERT INTO bs_accounts (CitizenID, CitizenName, DiscordNick, Clearance, Insignia, Team, OriginalTeam, Commune, SupplyOption, Password, XP, RankPoints, IP) VALUES ('$newcitid','$citname','$discord','$clearance','$insignia','$herdabbr','$herdabbr','$commune','$supplyoption', '$password', 0, 0, '$ip')";
	$result5=mysqli_query($mysqli, $sql5);
	$sql10="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$added')";
	$result10=mysqli_query($mysqli, $sql10);
	header("Location: apanel.php?addsoldier=1");			
	}
	else {
	header("Location: apanel.php?addsoldier-error=1");
	}
?>
<?php 

ob_flush();
mysqli_close($mysqli);

?>