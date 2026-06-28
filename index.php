<?php
ob_start();
include("connection.php");
include('functions.php');
session_start();
if(isset($_SESSION['vmabsmu'])) { header("Location: home.php"); }


//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="shortcut icon" href="favicon.ico" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>VMA-214 | BlackSheep Military Unit | eRepublik Soldier Login</title>
    <style type="text/css">
    @font-face {font-family: BerlinSans; src: url(fonts/BRLNSR.ttf) format("truetype");}
    @font-face {font-family: Impact; src: url(fonts/impact.ttf) format("truetype");}
    body {margin-top: 0 0 0 0;}
    a {border: none;}
    .login {width: 800px; height: 100%; margin: 0 auto;}
    #eday {color: #999999; font-size: 12px; font-family: "Berlin Sans FB", BerlinSans;}
    #line {width: 110px; height: 1px; background-color: #B25900; margin: 0 auto;}
    #logo {width: 241px; height: 144px; margin: 0 auto; padding-top: 15px; padding-bottom: 60px;}
    #login {width: 245px; height: auto; margin: 0 auto; font-size: 14px; font-family: Impact; margin-top: 20px;}
    #input {width: 225px; height: 25px; background-color: #EEEEEE; border-color: #DDDDDD; border-style: solid; border-width: 1px; padding-left: 10px; font-family: "Berlin Sans FB", BerlinSans; font-size: 14px; color: #B25900;}
    #footer {font-size: 10px; font-family: "Berlin Sans FB", BerlinSans; color: #666666; margin: 0 auto; position: fixed; bottom: 0; left: 0; right: 0; height: 20px;}
    </style>
</head>

<body>
    <div class="login">

        <!-- Current eDay
        <div id="eday" align="center">
         Current eDay:
        </div>
        <div id="line"></div>
         ------------ -->

        <!-- Logo -->
        <div id="logo">
            <img src="images/logos/logo-NEW.png" width="241" height="241" />
        </div>
        <!-- ---- -->

        <!-- Login Area -->
        <div id="login" align="center">
            <form action="" method="post">
                <div style="color:#666666;padding-left:7px;text-align:left;">CITIZEN ID:</div>
                <input id="input" name="vmaid" type="text" />
                <br />
                <div style="color:#666666;padding-left:7px;text-align:left;margin-top:6px;">PASSWORD:</div>
                <input id="input" name="vmapswd" type="password" />
                <br />
                <table width="100%" border="0" align="center" style="margin-top:3px;">
                    <tr>
                        <td align="left"><a href="joinbs.php" target="_self"><img src="images/buttons/joinbs.png"
                                    width="112" height="27" /></a></td>
                        <td align="right" style="padding-right:3px;"><input name="login" type="image"
                                src="images/buttons/login.png" /></td>
                    </tr>
                </table>
            </form>
            <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Authorize User
    UserAuth($mysqli);
}
?>
        </div>
        <!-- ---------- -->

        <!-- Footer -->
        <div id="footer" align="center" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">
            Version: <?=$version?> | Created and Managed by: Zach Goldsmith | Current eDay: <?=$eday?>
        </div>
        <!-- ------ -->

    </div>
</body>

</html>
<?php ob_flush(); mysqli_close($mysqli); ?>