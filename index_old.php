<?php 
if (!isset($_SESSION)) {
session_start();
} ?>
<?php require_once("Connections/pravo.php"); ?>
<?php require("util/misc.php"); ?>
<?php 
$ip_address=$_SERVER['REMOTE_ADDR'];
$page=substr(strrchr($_SERVER['PHP_SELF'],"/"),1);
$from_page="";
$referrer="";
if (isset($_SERVER['HTTP_REFERER'])) {
	$from_page=substr(strrchr($_SERVER['HTTP_REFERER'],"/"),1);
	$referrer=$_SERVER['HTTP_REFERER'];
}
$browser=$_SERVER['HTTP_USER_AGENT'];
$language=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
$id_user=1;
if(isset($_SESSION['MM_ID']))
	$id_user=$_SESSION['MM_ID'];
trackVisit($ip_address, $referrer, $browser, $language, $id_user, $page, $from_page, $database_pravo, $pravo);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="mk-mk" />
<meta name="description" content="Сите закони на едно место. База на закони, анализи, судски пракси..." />
<meta name="keywords" content="makedonija, pravo, zakon, zakoni, sudska praksa, analizi, MOST, zakonodavstvo, zakonodavna funkcija, македонија, право, закон, судска пракса, закони, анализи, МОСТ, законодавна функција, законодавство" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Почетна</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="scripts" -->
<?php require("util/banner.php"); ?>
<!-- InstanceEndEditable -->
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>
<script type="text/javascript" src="mootools.js"></script>
<script type="text/javascript" src="rokmoomenu.js"></script>
<script type="text/javascript" src="javaScripts/cirillic_converter.js"></script>
<script type="text/javascript" src="javaScripts/popUpWindow.js"></script>
<script type="text/javascript">
<!--
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
//-->
</script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
        <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>    
      </div>
      <div id="horiz-menu" >
        <ul class="nav"><li class="active"><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="analysis.php">Анализи</a></li>
          <li><a href="regulations.php">Прописи</a></li>
          <li><a href="courtpractice.php">Судска пракса</a>
           <ul>
            <li><a href="courtpractice.php">Судска пракса</a></li>
            <li><a href="europeancourt.php">Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
       <table><tr><td><div id="mapMenu">Почетна &raquo;</div> </td></tr></table>
       </div>
      </div>
    <div class="mainBody">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><div><?php getBanner($database_pravo, $pravo, 1); ?></div></td>
    <td rowspan="4" valign="top">
    <?php include("util/login_block.php"); ?>
		  <br />
          <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
          <br />
          <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
          <br />
          <div><?php getBanner($database_pravo, $pravo, 5); ?></div>
    </td>
  </tr>
  <tr>
    <td valign="top" width="250">
    <div class="left-block1">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="leftTitle" -->Новости<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="leftContent" -->
                   <?php include("util/news_block.php"); ?>
                 <!-- InstanceEndEditable -->
                    
              </div>
            </div></td>
    <td valign="top" width="468" align="left" style="padding-left:3px; padding-right:1px;">
    <div class="right-block">
                <div class="title">
                    <div class="left"></div>
                  <div class="middle"><div class="text"><!-- InstanceBeginEditable name="rightTitle" -->Пребарување на закони<!-- InstanceEndEditable --> </div>
                  </div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="rightContent" -->
                   <?php include("util/search.php"); ?>
                 <!-- InstanceEndEditable --></div>
            </div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php getBanner($database_pravo, $pravo, 6); ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" width="250">
    <div class="left-red-block1">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="leftTitle2" -->Судска пракса пребарување<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="leftContent2" -->
                    <?php include("util/search_practice.php"); ?><!-- InstanceEndEditable -->
                    
              </div>
            </div>
    </td>
    <td valign="top" width="468" style="padding-right:4px;">
    <div class="right-yellow-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="rightTitle2" -->Последни документи<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="rightContent2" -->
                   <?php include('util/latestLaws.php'); ?>
                 <!-- InstanceEndEditable --></div>
        </div>
    </td>
  </tr>
  <tr><td colspan="2" align="center"><?php getBanner($database_pravo, $pravo, 7); ?></td></tr>
  <tr>
        <td colspan="2" valign="top">
        	<div><img src="images/eurocort.png" width="720" /></div>
            <div><!-- InstanceBeginEditable name="EuroCourtRegion" --><div style="width:718px; border:1px solid #f5e6a2; border-top:none; "><?php include("util/search_eurocourt.php"); ?></div><!-- InstanceEndEditable -->
            </div>
        </td>
    </tr>
</table>
<p>&nbsp;</p>
  </div>
<div class="footer"><span style="float:left;">&copy; 2010 Сите права задржани</span><span style="float:right;"><a href="JavaScript:popUpWindow('help.php?id=5','','',600,520);" style="color:#FFFFFF;">Услови за користење</a> | <a href="JavaScript:popUpWindow('help.php?id=6','','',600,350);" style="color:#FFFFFF;">Политика за приватност</a></span></div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите.<div style="float:right;"><a href="http://camost.org" target="_blank"><img src="images/most.jpg" border="0"/></a></div>
    
    </div>
</div>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.pravo.org.mk/piwik/" : "http://www.pravo.org.mk/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.pravo.org.mk/piwik/piwik.php?idsite=1" style="border:0" alt=""/></p></noscript>
<!-- End Piwik Tag -->
</body>
<!-- InstanceEnd --></html>