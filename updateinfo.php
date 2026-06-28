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
$name = $row['CitizenName'];
$currentpassword = $row['Password'];

date_default_timezone_set('America/New_York');
$date = date("Y-m-d");
$time = date("h:i:sa T");
}
?>
<?php
if(isset($_GET['discord'])){
$newnick = mysqli_real_escape_string($mysqli, $_POST['discordnick']);
$sql2 = "UPDATE bs_accounts SET DiscordNick='$newnick' WHERE CitizenID='$vmaid'";
$result2 = mysqli_query($mysqli, $sql2);	


$updated_discord = "Changed Discord Nickname to: ".$newnick;
$sql3="INSERT INTO bs_slogs (Date, Time, CitizenName, Action) VALUES ('$date', '$time', '$name', '$updated_discord')";
$result3=mysqli_query($mysqli, $sql3);

header("Location: spanel.php?discord=".$newnick);
exit;
}

elseif(isset($_GET['pass'])){
$oldpass = mysqli_real_escape_string($mysqli, sha1($_POST['old_password']));
$newpass = mysqli_real_escape_string($mysqli, sha1($_POST['new_password']));
$rnewpass = mysqli_real_escape_string($mysqli, sha1($_POST['repeat_new_password']));

if($oldpass == $currentpassword && $newpass == $rnewpass){
	
$sql2 = "UPDATE bs_accounts SET Password='$newpass' WHERE CitizenID='$vmaid'";
$result2 = mysqli_query($mysqli, $sql2);	

$updated_pass = "Changed Password";
$sql3="INSERT INTO bs_slogs (Date, Time, CitizenName, Action) VALUES ('$date', '$time', '$name', '$updated_pass')";
$result3=mysqli_query($mysqli, $sql3);

header("Location: spanel.php?pass=1");
exit;
}
else {
header("Location: spanel.php?error-pass=1");	
}
}

elseif(isset($_GET['so'])){
$newso = mysqli_real_escape_string($mysqli, $_POST['supplyoption']);
$sql2 = "UPDATE bs_accounts SET SupplyOption='$newso' WHERE CitizenID='$vmaid'";
$result2 = mysqli_query($mysqli, $sql2);	

$sql4 = "SELECT * FROM bs_supplyoptions WHERE OptionNumber = '".$newso."'";
$result4 = mysqli_query($mysqli, $sql4);
$row4 = mysqli_fetch_array($result4);
$food = $row4['Food'];
$weapons = $row4['Weapons'];
$gold = $row4['Gold'];

$supplies = '[<span style="color:#006600">F: '.$food.'</span> | <span style="color:#B20000">T: '.$weapons.'</span>] | <span style="color:#0000B2">T: '.$gold.'</span>]';

$updated_supply = "Changed Supply Option to: ".$newso." (".$supplies.")";
$sql3="INSERT INTO bs_slogs (Date, Time, CitizenName, Action) VALUES ('$date', '$time', '$name', '$updated_supply')";
$result3=mysqli_query($mysqli, $sql3);

header("Location: spanel.php?supply=".$newso);
exit;
}
else { header("Location: spanel.php"); }
?>

<?php 

ob_flush();
mysqli_close($mysqli);

?>