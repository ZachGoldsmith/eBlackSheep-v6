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
<title>VMA-214 | BlackSheep Military Unit | Commune Management | eRepublik</title>

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
    $( ".button" ).button()
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

<h3>WORKERS</h3>
        <div align="center">
            <?php
            $sqlcom = "SELECT DISTINCT(Commune) FROM bs_accounts";
            $resultcom = mysqli_query($mysqli, $sqlcom) or die("Query failed ($sqlcom) - " . mysqli_error($mysqli));
            $communecount = mysqli_num_rows($resultcom);
            
            for($i = 0; $i < $communecount; $i++) 
            { 
                $com = mysqli_fetch_array($resultcom);
                $owner = $com['Commune'];
                // Display the commune-holder
                echo '<div id="accordion2" style="width:450px;">';
                echo '<h3>'.$owner.'</h3><div><p>';

                echo "<table border='0' align='center'><tr>
                <tr>
                <th><div class='pagehead3' align='center' style='padding-left:5px; font-size:xx-small;'>CITIZEN NAME</div></th>
                <th><div class='pagehead3' align='center' style='padding-left:5px; font-size:xx-small;'>WORKS</div></th>
                <th><div class='pagehead3' align='center' style='padding-left:5px; font-size:xx-small;'>DOESN'T WORK</div></th>
                <th><div class='pagehead3' align='center' style='padding-left:5px; font-size:xx-small;'>RESET</div></th>
                <th><div class='pagehead3' align='center' style='padding-left:5px; font-size:xx-small;'></div></th>
                </tr>";
                echo "<form action='updatecommune.php' method='post'>";

                // Display (after selecting) each commune worker under the commune-holder

                $sqlcom2 = "SELECT * FROM bs_accounts WHERE Commune = '$owner'";
                $resultcom2 = mysqli_query($mysqli, $sqlcom2) or die("Query failed ($sqlcom2) - " . mysqli_error($mysqli));
                $numrowscom2 = mysqli_num_rows($resultcom2);
                echo 'Workers: '.$numrowscom2;

                for($x = 0; $x < $numrowscom2; $x++) 
                { 
                    $com2 = mysqli_fetch_array($resultcom2);
                    $db_citname = $com2['CitizenName'];
                    $db_citid = $com2['CitizenID'];
                    $db_onlinestatus = $com2['OnlineStatus'];
                    $db_citizenstatus = $com2['CitizenStatus'];
                    $db_communestatus = $com2['CommuneStatus'];
                    if ($db_citizenstatus == '1') {
                        $db_citizenstatus = 'Alive!';
                    }
                    else {
                        $db_citizenstatus = 'Dead.';
                    }

                    // Start alternate color pattern on rows

                    if($x % 2)
                    {
                        $RowColor="bgcolor=''";
                    }
                    else
                    {
                        $RowColor="bgcolor='#DDDDDD'";                       
                    }
                    /*
                    // Every 2 columns, make a new row
                    // Nevermind, don't.
                    if (!($x % 2)) {
                        echo "</tr><tr>";
                    }
                    */
                    // Inserts the data in rows, creating one row for every record found
                    echo "<tr ".$RowColor.">";
                    // Select button based on commune status already set
                    if ($db_communestatus == 'work') {
                        echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><a href='http://www.erepublik.com/en/citizen/profile/".$db_citid."' target='_blank' style='color:#11FF00;'>" . $db_citname . "</a></td>                        
                        <td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><input type='radio' name='".$db_citid."'value='work' checked></td>
                        <td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><input type='radio' name='".$db_citid."'value='nowork'>
                        </td>";    
                    }
                    elseif ($db_communestatus == 'nowork') {
                        echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><a href='http://www.erepublik.com/en/citizen/profile/".$db_citid."' target='_blank' style='color:#FF0000;'>" . $db_citname . "</a></td>
                        <td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><input type='radio' name='".$db_citid."'value='work'></td>
                        <td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><input type='radio' name='".$db_citid."'value='nowork' checked>
                        </td>";    
                    }
                    else {
                        echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><a href='http://www.erepublik.com/en/citizen/profile/".$db_citid."' target='_blank' style='color:#000000;'>" . $db_citname . "</a></td>
                        <td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><input type='radio' name='".$db_citid."'value='work' ></td>
                        <td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><input type='radio' name='".$db_citid."'value='nowork'>
                        </td>";    
                    }
                    echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'><input type='radio' name='".$db_citid."'value=''></td>";
                    $infoaction = "soldierinfo.php?id=".$db_citid."";

?>
<script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 820;
 var height = 425;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'Edit Soldier', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->
</script>
                    <td><a style="cursor:pointer;" onclick="popup('<?=$infoaction?>')"><img src="images/information-button.png" width="16" height="16" /></a></td>
<?php
                    echo "</tr>";
                }
                echo '<br /><input type="submit" id="update'.$i.'-button" class="button" value="Update" /></tr></form></table></p></div></div>';
            }
            ?>
      </div>

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
<?php ob_flush(); mysqli_close($mysqli);?>