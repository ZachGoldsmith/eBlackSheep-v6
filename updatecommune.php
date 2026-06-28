<?php ob_start(); ?>
<title>Updating Commune Status</title>
<?php
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
$result = mysqlI_query($mysqli, $sql);
$row = mysqli_fetch_array($result);

$name = $row['CitizenName'];
$id = $row['CitizenID'];
$clearance = $row['Clearance'];
$insignia = $row['Insignia'];
$dbherd = $row['Team'];
$soption = $row['SupplyOption'];
$current_password = $row['Password'];

$birthday = $row['Birthday'];
$level = number_format($row['Level']);
$experience = number_format($row['XP']);
$strength = number_format($row['Strength']);
$milrank = $row['Rank'];
$millevel = $row['RankLevel'];  
$rankpoints = number_format($row['RankPoints']);
$citizenship = $row['Citizenship'];
$state = $row['State'];
$country = $row['Country'];
$avatar = $row['Avatar'];

if($dbherd == 'HG') {
$herd = 'Honor Guard';  
}
elseif($dbherd == '1RH') {
$herd = 'Red Herd'; 
}
elseif($dbherd == '1BH') {
$herd = 'Blue Herd';
}
elseif($dbherd == '1GH') {
$herd = 'Green Herd';   
}
elseif($dbherd == '1YH') {
$herd = 'Yellow Herd';  
}
elseif($dbherd == '1PH') {
$herd = 'Purple Herd';  
}
elseif($dbherd == '1WH') {
$herd = 'White Herd';   
}
elseif($dbherd == '1LH') {
$herd = 'Lost Herd';    
}
}
?>
<?php
$communecount = count($_POST);
/*
var_dump($_POST);
echo "<br/ >Count: " . $communecount;
$c2 = array_slice($_POST, 1, 1);
echo "<br />" . $c2[0];
echo "<br /> Value: " . current($_POST) . "<br /> Key: ". key($_POST);
*/

$c = array_keys($_POST);

for($i = 0; $i < $communecount; $i++) 
{
    $cid = $c[$i];
    $new_status = $_POST[$cid];
    $sql2 = "UPDATE bs_accounts SET CommuneStatus='$new_status' WHERE CitizenID='$cid'";
    $result2 = mysqli_query($mysqli, $sql2)or die("Query failed ($sql2) - " . mysqli_error($mysqli));
}

$updated_com = "Edited commune statuses";
date_default_timezone_set('America/Los_Angeles');
$date = date("Y-m-d");
$time = date("h:i:sa T");
$sql3="INSERT INTO bs_logs (Date, Time, CitizenName, Action) VALUES ('$date', '$time', '$name', '$updated_com')";
$result3=mysqli_query($mysqli, $sql3);

header("Location: cmanagement.php?csaved=1");
?>

<?php 

ob_flush();
mysqli_close($mysqli);

?>
nn