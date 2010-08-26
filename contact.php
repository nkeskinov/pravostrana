<?php 
session_start();
?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php 
$id_post_category=3; //ID for news
$discussionName="Контакт"; //The name of the Discusion
$ip_address=$_SERVER['REMOTE_ADDR'];
$page=substr(strrchr($_SERVER['PHP_SELF'],"/"),1);
$from_page="";
$referrer = "";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/SingleRed.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Контакт</title>
<!-- InstanceEndEditable -->
<?php include("util/banner.php"); ?>
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>
<script type="text/javascript" src="javaScripts/cirillic_converter.js"></script>
<script type="text/javascript" src="javaScripts/popUpWindow.js"></script>
<script type="text/javascript" src="mootools.js"></script>
<script type="text/javascript" src="rokmoomenu.js"></script>
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
<!-- InstanceEndEditable -->
</head>
<body>
<table align="center"><tr><td>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="logoText"><img src="images/banner.png" /></div>
        <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- InstanceBeginEditable name="Menu" -->
          <ul class="nav">
          <li ><a href="index.php">Почетна</a></li>
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
          <li class="active"><a href="contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
       <div id="mapMenu"><!-- InstanceBeginEditable name="siteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td><td>Контакт</td></tr></table><!-- InstanceEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
            <table width="100%">
             <tr>
                <td valign="top"><div><?php getBanner($database_pravo, $pravo, 1); ?></div></td>
                <td rowspan="2" valign="top" width="250">
                <?php include("util/login_block.php"); ?>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 5); ?></div>
                </td>
              </tr>
            <tr><td valign="top">
            <div class="middle-red-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="BlockTitle" -->Контакт<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina" style="margin-top:-3px"><!-- InstanceBeginEditable name="BlockContent" -->
                   <?php include("util/news.php"); ?>
                 <!-- InstanceEndEditable --></div>
            </div>
            </td></tr></table>
    </div>
    <br />
	<div class="footer"><span style="float:left;">&copy; 2010 Сите права задржани</span><span style="float:right;"><a href="JavaScript:popUpWindow('help.php?id=5','','',600,520);" style="color:#FFFFFF;">Услови за користење</a> | <a href="JavaScript:popUpWindow('help.php?id=6','','',600,350);" style="color:#FFFFFF;">Политика за приватност</a></span></div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите.<div style="float:right;"><a href="http://camost.org" target="_blank"><img src="images/most.jpg" border="0"/></a></div></div>
</div>
</td></tr></table>
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
