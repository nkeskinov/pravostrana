<?php 
session_start();
?>
<?php require_once("../Connections/pravo.php"); ?>
<?php include("../util/misc.php"); ?>
<?php

$MM_authorizedUsers = "admin";
$MM_donotCheckaccess = "false";

$MM_restrictGoTo = "../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CleanAdminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="../style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Администраторски панел</title>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../mootools.js"></script>
<script type="text/javascript" src="../rokmoomenu.js"></script>
<script type="text/javascript" src="../javaScripts/cirillic_converter.js"></script>
<script type="text/javascript" src="../javaScripts/popUpWindow.js"></script>
<!-- calendar stylesheet -->
<script type="text/javascript">
window.addEvent('domready', function() {
new rokmoomenu($E('ul.nav'), {
bgiframe: false,
delay: 500,
animate: {
props: ['opacity', 'width', 'height'],
opts: {
duration:400,
fps: 100,
transition: Fx.Transitions.sineOut
}
}
});
});
</script>
<!-- InstanceBeginEditable name="head" -->
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
</head>
<body>
<table align="center"><tr><td>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="bannerDiv1"></div>    
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- InstanceBeginEditable name="Menu" -->
        <ul class="nav">
           <li class="active"><a href="../index.php">Почетна</a></li>
          <li><a class="topdaddy" href="../documentlaws.php">Закони</a></li>
         <li><a href="../analysis.php">Анализи</a></li>
          <li><a href="../regulations.php">Прописи</a></li>
          <li><a href="../courtpractice.php">Судска пракса</a>
           <ul>
             <li><a href="../courtpractice.php">Судска пракса</a></li>
            <li><a href="../europeancourt.php">Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="../news.php">Новости</a></li>
          <li><a href="../contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
       <div id="mapMenu"><!-- InstanceBeginEditable name="SiteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
      </div>
	</div>
    <div class="mainBody">
   	 <table width="100%">
             <tr>
                <td valign="top"></td>
                <td rowspan="2" valign="top" width="250">
                <?php include("util/login_block.php"); ?>
                      <br />
                      <div style="text-align:left; margin:0;"><?php include("util/menu.php"); ?></div>
                </td>
              </tr>
            <tr><td valign="top">
            <div class="middle-red-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="BlockTitle" -->Администраторски панел<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina" ><!-- InstanceBeginEditable name="BlockContent" -->
                 <div style="padding:5px"><p>Кликнете на линковите од десно за извршување на соодветнте акции.</p>
                 <p>Едноставна статистика на посети на месечно ниво.</p>
                   <p>
                     <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="710" height="305">
                       <param name="movie" value="Main.swf">
                       <param name="quality" value="high">
                       <param name="wmode" value="opaque">
                       <param name="swfversion" value="9.0.45.0">
                       <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                       <param name="expressinstall" value="../Scripts/expressInstall.swf">
                       <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                       <!--[if !IE]>-->
                       <object type="application/x-shockwave-flash" data="Main.swf" width="710" height="305">
                         <!--<![endif]-->
                         <param name="quality" value="high">
                         <param name="wmode" value="opaque">
                         <param name="swfversion" value="9.0.45.0">
                         <param name="expressinstall" value="../Scripts/expressInstall.swf">
                         <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                         <div>
                           <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                           <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
                         </div>
                         <!--[if !IE]>-->
                       </object>
                       <!--<![endif]-->
                     </object>
                   </p>
               <p>&nbsp;</p>
                   <p>&nbsp;</p>
                 <script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
                   </script>
                   </div>
                 <!-- InstanceEndEditable --></div>
            </div>
            </td></tr></table>
     
     </div>

    
	<div class="footer"><span style="float:left;">&copy; 2010 Сите права задржани</span><span style="float:right;"><a href="JavaScript:popUpWindow('../help.php?id=5','','',600,520);" style="color:#FFFFFF;">Услови за користење</a> | <a href="JavaScript:popUpWindow('../help.php?id=6','','',600,350);" style="color:#FFFFFF;">Политика за приватност</a></span></div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите.<div style="float:right;"><a href="http://camost.org" target="_blank"><img src="../images/most.jpg" border="0"/></a></div></div>
</div>
</td></tr></table>
</body>
<!-- InstanceEnd --></html>
