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
$discord = $row['DiscordNick'];
$citizenname = $row['CitizenName'];
}
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>News</title>
    <base target="_blank" />
    <style type="text/css"><!--

body    {
    background-color: #FFFFFF;
    margin: 0;
    padding: 0;
    border: 0;
    }

 /* FONT COLORS */

div     { color: #000000; font: 11px arial, sans-serif; font-weight: normal; }

.title      { color: #B25900; font: 12px arial, sans-serif; font-weight: bold; }

#NewsDiv    { position: absolute; left: 0; top: 0; width: auto; }

 /* PAGE LINK COLORS */

a:link      { color: #0033FF; text-decoration: underline; }

a:visited   { color: #6633FF; text-decoration: underline; }

a:active    { color: #0033FF; text-decoration: underline; }

a:hover     { color: #6699FF; text-decoration: none; }

table,th,td { font-size:100%; }
-->
    </style>
    <script type="text/javascript">
<!-- HIDE CODE JAVASCRIPT NEWS SCROLLER ver 2.0 2013


var scrollspeed = 1;        // SET SCROLLER SPEED 1 = SLOWEST
var speedjump   = 40;       // ADJUST SCROLL JUMPING = RANGE 20 TO 40
var startdelay  = 1;        // START SCROLLING DELAY IN SECONDS
var nextdelay   = 0;        // SECOND SCROLL DELAY IN SECONDS 0 = QUICKEST
var topspace    = 60;       // TOP SPACING FIRST TIME SCROLLING
var frameheight = 204;      // IF YOU RESIZE THE WINDOW EDIT THIS HEIGHT TO MATCH


current = (scrollspeed);


function HeightData() {
    AreaHeight = dataobj.offsetHeight;
    if (AreaHeight === 0) {
        setTimeout("HeightData()", (startdelay * 1000 * 1.5));
    } else {
        ScrollNewsDiv();
    }
}

function NewsScrollStart() {
    dataobj = document.all ? document.all.NewsDiv : document.getElementById("NewsDiv");
    dataobj.style.top = topspace + 'px';
    setTimeout("HeightData()", (startdelay * 1000 * 1.5));
}

function ScrollNewsDiv() {
    dataobj.style.top = parseInt(dataobj.style.top) - scrollspeed + 'px';
    if (parseInt(dataobj.style.top) < AreaHeight * (-1)) {
        dataobj.style.top = frameheight + 'px';
        setTimeout("ScrollNewsDiv()", (nextdelay * 1000 * 1.5));
    } else {
        setTimeout("ScrollNewsDiv()", speedjump);
    }
}



// END HIDE CODE -->
</script>
</head>
<body onLoad="NewsScrollStart();" onmouseout="scrollspeed=current" onmouseover="scrollspeed=0">
<div id="NewsDiv" style="text-align: left; padding: 5px;"><!-- SCROLLER CONTENT STARTS HERE -->


<!-- START SIDEBAR CONTENT -->

<?php

echo '<span class="title">Welcome, New Sheep!</span><br /><br />';
echo "<table border='0'>";

$sql_join = "SELECT * FROM bs_accounts WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= `Join`";
$resultjoin = mysqli_query($mysqli, $sql_join) or die("Query failed ($sql_join) - " . mysqli_error($mysqli));
$numrows_join = mysqli_num_rows($resultjoin);

if ($numrows_join > 0) { 

for($a = 0; $a < $numrows_join; $a++)
{
  $row_join = mysqli_fetch_array($resultjoin);
  $name_join = $row_join['CitizenName'];
  $id_join = $row_join['CitizenID'];
  $discord_join = $row_join['DiscordNick'];
  $herd_join = $row_join['Team'];
  $date_join = $row_join['Join'];
  if($herd_join == 'HG') {
    $herd_join = 'Honor Guard';
  }
  elseif($herd_join == '1RH') {
    $herd_join = 'Red Herd';
  }
  elseif($herd_join == '1BH') {
    $herd_join = 'Blue Herd';
  }
  elseif($herd_join == '1GH') {
    $herd_join = 'Green Herd';
  }
  elseif($herd_join == '1YH') {
    $herd_join = 'Yellow Herd';
  }
  elseif($herd_join == '1PH') {
    $herd_join = 'Purple Herd';
  }
  elseif($herd_join == '1WH') {
    $herd_join = 'White Herd';
  }
  elseif($herd_join == '1LH') {
    $herd_join = 'Lost Herd';
  }



$RowColor="bgcolor='#DDDDDD'";


//inserts the data in rows, creating one row for every record found
  echo "<tr ".$RowColor.">
    <th colspan='2'>
    <a href='http://www.erepublik.com/en/citizen/profile/" . $id_join . "' target='_blank' style='color:#000000; padding-right:5px;'>" . $name_join . "</a>
    </th></tr>";  

  //echo "<tr><td align='left'><a href='http://www.erepublik.com/en/citizen/profile/" . $id_join . "' target='_blank' style='color:#000000; padding-right:5px;'>" . $name_join . "</a></td>";

  echo "<tr ".$RowColor."><td>Discord:<td align='center'>" . $discord_join . "</td>";

  echo "<tr ".$RowColor."><td>Herd:<td align='center'>" . $herd_join . "</td>";

  echo "<tr ".$RowColor."><td>Joined:<td align='center'>" . $date_join . "</td>";
  
  echo "<tr ".$RowColor."><td>Say hi:<td align='center'><a href='http://www.erepublik.com/en/main/messages-compose/" . $id_join . "' target='_blank' style='color:#000000;'><img src='images/inbox-upload.png' width='16' height='16'></a></td>";

}
  echo "</table><br><br>";
}

?>

<!-- END SHEEP CONTENT -->

<?php
$queryn = "SELECT * FROM bs_news";  
$resultn = mysqli_query($mysqli, $queryn) or die("Query failed ($queryn) - " . mysqli_error($mysqli)); 
$numrowsn = mysqli_num_rows($resultn);

for($i = 0; $i < $numrowsn ; $i++) 
{ 
$news = mysqli_fetch_array($resultn);
$title = $news['Title'];
$msg = $news['Message'];

echo '<span class="title">'.$title.'</span>';
echo '<br />'.$msg.'<br><br>';

}

/*


<span class="title">Supply Requests</span><br />
We&#39;re halving second requests (for weapons) while our supplies are a little low. :( We apologize for the inconvenience.<br />
<br />
<br />
<span class="title">Forums</span><br />
Some sheep have been asking for forums, and we love to oblige. For any forum-lovers out there, please visit us at <a href="/forums">The Black Sheep Forums</a>. You can log in with your citizen ID and roster password.<br />
<br />
<br />
<span class="title">Vote!</span><br />
Please vote for The Black Sheep Party <a href="http://www.erepublik.com/en/main/congress-elections">here</a> if you don&#39;t have any other party affiliations! The party could use your vote.<br />
<br />
<br />
<span class="title">Moosic</span><br />
Check out this band! (<a href="yurp.php" target="_blank">Click Here</a>)<br />
<br />
<br />
<span class="title">Media Team Article</span><br />
Please read (and if you like it, vote) this article: <a href="http://www.erepublik.com/en/article/2402740/1/20" target="_top">Article Link</a><br />
<br />
*/
?>
<!-- SCROLLER CONTENT ENDS HERE --></div>
</body>
</html>
