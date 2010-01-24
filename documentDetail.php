<?php session_start(); ?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php include("util/newsletter.php"); ?>
<?php 
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
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CleanTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Детален опис на документ</title>
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
<script language="javascript" type="text/javascript" src="javaScripts/MM.js"></script>
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
<table align="center"><tr><td>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>    
   	  </div>
      <div id="horiz-menu" ><!-- InstanceBeginEditable name="Menu" -->
        <ul class="nav">
          <li><a href="index.php">Почетна</a></li>
          <li <?php if($_GET['page']=="documentlaws.php") echo 'class="active"' ?>><a href="documentlaws.php">Закони</a></li>
          <li <?php if($_GET['page']=="analysis.php") echo 'class="active"' ?>><a href="analysis.php">Анализи</a></li>
          <li <?php if($_GET['page']=="regulations.php") echo 'class="active"' ?>><a href="regulations.php">Прописи</a></li>
          <li <?php if($_GET['page']=="courtpractice.php" || $_GET['page']=="europeancourt.php") echo 'class="active"' ?>><a href="courtpractice.php">Судска пракса</a>
          	<ul>
            	 <li><a href="courtpractice.php">Судска пракса</a></li>
            	 <li><a href="europeancourt.php">Европски суд за човекови права</a></li>
             </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
        <div id="mapMenu">
       <!-- InstanceBeginEditable name="SiteMap" -->
       <table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</td><td>
	   <?php if($_GET['page']=="documentlaws.php") echo '<a href="documentlaws.php">Закони</a>'; if($_GET['page']=="analysis.php") echo '<a href="analysis.php">Анализи</a>';  if($_GET['page']=="regulations.php") echo '<a href="regulations.php">Прописи</a>'; if($_GET['page']=="courtpractice.php") echo '<a href="courtpractice.php">Судска пракса</a>';  if($_GET['page']=="europeancourt.php") echo '<a href="europeancourt.php">Судска пракса на Европски суд</a>';?>
       &nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td><td> Детален опис на документ</td></tr></table> 
      <!-- InstanceEndEditable -->
       </div>
      </div>
	</div>
    
    <div class="mainBody">
            <!-- InstanceBeginEditable name="Content" -->
            <table width="100%" cellpadding="0">
             <tr>
                <td colspan="2"><div><?php getBanner($database_pravo, $pravo, 1); ?></div></td>
                <td rowspan="4" valign="top">
                <?php include("util/login_block.php"); ?>
        			  <p><a href="http://www.adobe.com/go/EN_US-H-GET-READER" target="_blank"><img src="images/get_adobe_reader.png" border="0" /></a> </p>
                      <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 5); ?></div>
                </td>
              </tr>
              <tr>
                <td valign="top" width="200"><div class="left-block">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Поврзани документи</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina" style=" padding:0; padding-left:2px;">
                    <div style="padding:0; padding-top:10px;"><?php include("util/documents_by_category.php"); ?></div>
                  </div>
                </div></td>
                <td valign="top" width="468" style="padding-right:1px;"><div class="right-block-bigger">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Детален опис на документ</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <?php include("util/documentdetail.php"); ?>
                  </div>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td></td>
              </tr>
              <tr>
                <td valign="top"></td>
                <td valign="top"></td>
              </tr>
            </table>
            <!-- InstanceEndEditable -->
    </div>
	<div class="footer">Copyright &copy; 2009 Сите права задржани</div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите <div style="float:right;"><a href="http://camost.org" target="_blank"><img src="images/most.jpg" border="0"/></a></div></div>
</div>
</td></tr></table>
</body>
<!-- InstanceEnd --></html>