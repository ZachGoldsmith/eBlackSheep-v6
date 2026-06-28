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
<title>VMA-214 | BlackSheep Military Unit | News Panel | eRepublik</title>

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
	font-size:12px;
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
    $( "#addnews-button, #delnews-button" ).button()
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

<div id="accordion">
<!-- Soldier Options -->
<h3>News</h3>
<div>
<p>
        <div id="accordion2">
          <h3>Add News</h3>
          <div>
        <p>
        <form action="addnews.php" method="post">
    Title<br />
<input name="title" type="text" />
    <br />
    <br />
    Message<br />
<textarea name="msg" style="width: 400px; margin: 0px;"></textarea>
    <br />
    <br />    
    <input type="submit" id="addnews-button" value="Add News" />
    </form>
        </p>
          </div>
          <h3>Delete News</h3>
          <div>
        <p>
        <form action="delnews.php" method="post">
          Title <br />
        <select style="margin-top:5px;" name="title">
        <?php
        $querynews = "SELECT * FROM bs_news";  
        $resultnews = mysqli_query($mysqli, $querynews) or die("Query failed ($querynews) - " . mysqli_error($mysqli)); 
        $numrowsnews = mysqli_num_rows($resultnews);

        for($i = 0; $i < $numrowsnews ; $i++) 
        { 
            $news = mysqli_fetch_array($resultnews);
            $title = $news['Title'];
            echo '<option>'.$title.'</option>';
        }
        ?>
        </select>
    <br />
    <br />
    <input type="submit" id="delnews-button" value="Delete News" />
    </form>
        </p>
          </div>
        </div>
      </div>
    </div> 
</p>
</div>


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