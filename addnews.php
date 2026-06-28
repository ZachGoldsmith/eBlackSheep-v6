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
$news_msg = $_POST['msg'];

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
$news = "Added news: " . $news_title;

$query1 = "INSERT INTO bs_news (Title, Message) VALUES ('$news_title','$news_msg')";  
$result1 = mysqli_query($mysqli, $query1) or die("Query failed ($query1) - " . mysqli_error($mysqli)); 
$sql1="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
VALUES ('$date', '$time', '$citizenname', '$news')";
$result1=mysqli_query($mysqli, $sql1);
header("Location: news.php?addnews=1&newsname=".$news_title); 

if(!$result1) {
    header("Location: news.php?addnews-error=1");
}
?>