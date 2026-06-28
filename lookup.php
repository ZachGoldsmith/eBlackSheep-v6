<?php

$sql1 = "SELECT * FROM bs_accounts WHERE CitizenID = '$vmaid'";
$result1 = mysqli_query($mysqli, $sql1);
$row1 = mysqli_fetch_array($result1);

$vmateam = $row1['Team'];
$sql2 = "SELECT * FROM bs_herds WHERE HerdAbbr = '$vmateam'";
$result2 = mysqli_query($mysqli, $sql2);
$row2 = mysqli_fetch_array($result2);

$vmasupply = $row1['SupplyOption'];
$sql3 = "SELECT * FROM bs_supplyoptions WHERE OptionNumber = '$vmasupply'";
$result3 = mysqli_query($mysqli, $sql3);
$row3 = mysqli_fetch_array($result3);

$sql6 = "SELECT * FROM bs_global";
$result6 = mysqli_query($mysqli, $sql6);
$row6 = mysqli_fetch_array($result6);
$dateupdated = $row6['DateUpdated'];
$timeupdated = $row6['TimeUpdated'];

$sql4 = "SELECT * FROM bs_accounts WHERE Insignia = 'O3'";
$result4 = mysqli_query($mysqli, $sql4);
$row4 = mysqli_fetch_array($result4);
$commandid = $row4['CitizenID'];
$commandname = $row4['CitizenName'];
$commandavatar = $row4['Avatar'];
$commanderlink= 'http://www.erepublik.com/en/citizen/profile/'.$commandid;

?>