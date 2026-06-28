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
include('lookup.php');

$version = $row6['Version'];
$vmaname = $row1['CitizenName'];
$vmaclearance = $row1['Clearance'];
$vmaherd = $row2['HerdName'];

include("navigations.php");

if ($vmaclearance < 4) {
header("Location: home.php?denied=1");	
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Citizen Recruiter | eRepublik</title>

<style type="text/css">
@font-face {
    font-family: BerlinSan;
    src: url(fonts/BRLNSR.ttf) format("truetype");
}
@font-face {
    font-family: Impact;
    src: url(fonts/impact.ttf) format("truetype");
}
body {
	margin-top: 0 0 0 0;
}
#topinfo a:link {
	color: #999999;
	text-decoration: none;
}
#topinfo a:visited {
	text-decoration: none;
	color: #999999;
}
#topinfo a:hover {
	text-decoration: underline;
	color: #666666;
}
#topinfo a:active {
	text-decoration: none;
	color: #999999;
}
a:link, a:visited, a:hover, a:active {
	color:#000000;
	text-decoration:none;	
}
#topinfo {
	color:#999999;
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;
}
.main {
	width:800px;
	height:auto;
	margin: 0 auto;	
}
#line1 {
	width:800px;
	height:2px;
	background-color:#000000;
	margin: 0 auto;
}
#line2 {
	width:800px;
	height:2px;
	background-color:#B25900;
	margin: 0 auto;
}
#navigation {
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:12px;
	padding-left:3px;
	margin-top:2px;
	margin-bottom:2px;
}

#content {
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:10px;
	margin-top:10px;
	text-align:center;	
}
a.current {
 text-decoration:underline;
 color:#666666;	
}
#footer {
	font-size:10px;
	font-family:"Berlin Sans FB", BerlinSans;
	color:#666666;
	margin:0 auto;
	height:25px;
	margin-top:10px;
}
#messages {
	text-align:center;
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;	
	margin-top:10px;
}
</style>
<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>
<script>
$(function() {
  $("#accordion, #accordion2, #accordion3, #accordion4, #accordion5").accordion({
	collapsible: true,
    active: false,
    heightStyle: "content",
	icons: null
  }); 
    $( "#recruit-button" ).button()
});
</script>
</head>

<body>
<div class="main">

<!-- Top Bar -->
<div>
<table width="800" border="0">
  <tr>
    <td align="left"><img src="images/logos/sidelogo-NEW.png" width="159" height="61" /></td>
    <td align="right" id="topinfo">
    Current eDay: <?=$eday?>
    <br />
	Welcome, <?=$vmaname?>!
    <br />
	You are in <?=$vmaherd?>
    <br />
    <a href="logout.php">Logout</a>
    </td>
  </tr>
</table>
</div>
<!-- ------ -->
<div id="line1"></div>

<!-- Navigation -->
<div id="navigation"><?=$nav3?></div>
<!-- ---------- -->

<div id="line2"></div>

<div id="messages">
<?php
include('error-messages.php');
?>
</div>

<div id="content">

      <?
if (isset($_GET['error']) AND !empty($_GET['error']))
{
    echo '<div align="center" style="font-size:xx-small; font-weight:bold; margin-top:-25px; margin-bottom:2.5px;">You have already requested today!</div>';
}
elseif (isset($_GET['requested']) AND !empty($_GET['requested']))
{
    echo '<div align="center" style="font-size:xx-small; font-weight:bold; margin-top:-20px; margin-bottom:2.5px;">Supply request recieved!</div>';
}
elseif (isset($_GET['saved']) AND !empty($_GET['saved']))
{
    echo '<div align="center" style="font-size:xx-small; font-weight:bold; margin-top:-20px; margin-bottom:2.5px;">Commune statuses updated!</div>';
}

if ($vmaclearance <= '3') header("Location: home.php?denied=1");

if ($_POST)
{
    //include('connection.php');
 
    $ids = explode(',', $_POST['IDs']);
    $reg = $_POST['reg'];

    $subject = "Welcome to eRepublik, @@!";

    $message = "Hi @@, welcome to the eUSA! I hope you're getting familiar with the eWorld. Starting a new game like eRep can be confusing. That's exactly why I messaged you.".
        
        "\n\nTo start off, you'll need food, weapons, and answers to any questions you have. That's where I'd like to help. I'll send you 50 quality-5 (Q5) food to show you I care. My political party, the Black Sheep, gives away 75 Q5 food (750 energy) every day just for posting in-game! You don't need to visit other websites or fill any forms for that! You might have figured out that you need energy to work, to train, and especially to fight. By the way, you don't need to be politically active to join the party. It's open to anyone!".
        
        "\n\nI'm also a member of a top eUS military unit called VMA-214 The Black Sheep. They also offer food as well as quality-7 (Q7) weapons, the best in the game! There is absolutely no catch, simply join and they'll get you started in the eWorld and equipped on the eUS's battlefields.".
        
        "\n\nIf you're interested in these opportunities, click the links I've left below. New players are the backbone of eAmerican society, so take some time to explore your options. We have people from all over the real world ready to help: Brazil, Finland, USA, & more. If you need any help, or if you have some questions about this, or even if you'd like that food I promised, just send me a message back & I'd be very happy to assist.".
        
        "\n\nI look forward to hearing back from you, @@. :) (Seriously, I do!)".
        "\neShades,".
        "\nHonor Guard & Party President, The Black Sheep".
        
        "\n\nMilitary unit: erepublik.com/en/main/group-show/2349".
        "\nParty: erepublik.com/en/party/2397".
        
        "\n\nTell Vice Party President Henry William French you joined for another 75 Q5 food: erepublik.com/en/main/messages-compose/5991937";

    $sql14 = "INSERT INTO bs_recruit (CitizenID,CitizenName,Recruiter,Date) VALUES ";
    
    for ($i = 0; $i < count($ids); $i++)
    {
        $id = preg_replace('/\s+/', '', $ids[$i]);
        $sql13 = "SELECT * FROM bs_recruit WHERE CitizenID = '$id'";
        $result13 = mysqli_query($mysqli, $sql13) or die("Query failed ($sql13) - " . mysqli_error($mysqli));
        $count13 = mysqli_num_rows($result13);
        if ($count13 < 1) 
        {
            $client = new Client;
            $client->setEmail('lanbo@aa.agaaa.org');
            $client->setPassword('ekZZ1kl');
    
            $module = new ManagementModule($client);
    
            $citizen = new CitizenModule($client);    
    
            $results = $citizen->getProfile($id);
    
            $nick = $results['name'];
            
            sleep(1);
            
            $invite = $module->inviteMU($id, 2349, $reg);
            
            sleep(1);            
            
            $friend = $module->addFriend($id);
    
            sleep(1);

            $send = $module->sendMessage($id, str_replace('@@', $nick, $subject), str_replace('@@', $nick, $message));
            
            sleep(1);

            $sql14.= "('$id','$nick','$citizenname','$date'),";
    
            echo "Inviting/Friending/Messaging: " . $nick . " (" . $id . ")<br />";
            //print_r($invite);
            $client = '';
            $module = '';
            $citizen = '';
        }
        else 
        {
            echo "ID " . $id . " already recruited.<br />";
        }
    }
    $sql15="INSERT INTO bs_logs (Date, Time, CitizenName, Action)
    VALUES ('$date', '$time', '$citizenname', 'Recruiting')";
    $result15=mysqli_query($mysqli, $sql15);
    $result14=mysqli_query($mysqli, $sql14);    
}
else 
{
?>
    Enter citizen IDs separated by commas (1233543,2344543,134543,...) and press Submit <b>once</b>.
    <form action="" method="post">
    <textarea name="IDs" style="width: 500px;" placeholder="CITIZEN IDS"></textarea><br />
    RegimentID: <input style="margin-top:8px;" type="text" name="reg" value="18439"/><br />
    <a href="javascript:toggletext('mytext')">
    <input id="recruit-button" style="margin-top:8px;" type="submit" name="submit" value="Submit" /></a>
    <div id="mytext" style="display: none;"><br />Please wait... performing operations.</div>
    </form>
<?
}
?>

</div>

<!-- Footer -->
<div id="footer" align="center">
<div id="line2"></div>
<table width="800px" border="0" style="margin: 0 auto;" align="center">
  <tr>
    <td align="left" style="color:#000000;font-family:BerlinSans,'Berlin Sans FB';font-size:12px;"><?=$nav2?></td>
    <td align="right" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">Version: <?=$version?> | <a href="mailto:zachgoldsmith@outlook.com" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">Contact Webmaster</a> | <?APILastUpdate()?></td>
  </tr>
</table>
<div id="line1"></div>
</div>
<!-- ------ -->

</div>
</body>
</html>
<? ob_flush(); mysqli_close($mysqli);?>