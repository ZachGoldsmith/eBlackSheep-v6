<?php

$sql = "SELECT * FROM bs_accounts WHERE CitizenID = '$soldierid'";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);

$sql10 = "SELECT * FROM bs_accounts WHERE CitizenID = '$vmaid'";
$result10 = mysqli_query($mysqli, $sql10);
$row10 = mysqli_fetch_array($result10);

$vmateam = $row['Team'];
$sql2 = "SELECT * FROM bs_herds WHERE HerdAbbr = '$vmateam'";
$result2 = mysqli_query($mysqli, $sql2);
$row2 = mysqli_fetch_array($result2);

$sql6 = "SELECT * FROM bs_global";
$result6 = mysqli_query($mysqli, $sql6);
$row6 = mysqli_fetch_array($result6);
$dateupdated = $row6['DateUpdated'];
$timeupdated = $row6['TimeUpdated'];

$vmasupply = $row['SupplyOption'];
$sql3 = "SELECT * FROM bs_supplyoptions WHERE OptionNumber = '$vmasupply'";
$result3 = mysqli_query($mysqli, $sql3);
$row3 = mysqli_fetch_array($result3);

?>