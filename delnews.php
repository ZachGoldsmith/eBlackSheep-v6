<?php
ob_start();
session_start();
$vmaid= $_SESSION['vmabsmu'];

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
$news_title = $_POST['title'];
//$news_msg = mysqli_real_escape_string($_POST['msg']);

/*
if($food_option == '') {
$food_option = 0;   
}

if($weapon_option == '') {
$weapon_option = 0; 
}
*/
$date = date("Y-m-d");
$time = date("h:i:sa T");
$news = "Deleted news: " . $news_title;

$query1 = "DELETE FROM bs_news WHERE Title='$news_title'";  
$result1 = mysqli_query($mysqli, $query1) or die("Query failed ($query1) - " . mysql_error()); 
$sql1="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$news')";
$result1=mysqli_query($mysqli, $sql1);
header("Location: news.php?delnews=1&newsname=".$news_title); 

if(!$result1) {
    header("Location: news.php?delnews-error=1");
}
?>