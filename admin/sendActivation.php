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
<title>Pravo.org.mk | Праќање на активациски код на корисник</title>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../mootools.js"></script>
<script type="text/javascript" src="../rokmoomenu.js"></script>
<script type="text/javascript" src="../javaScripts/cirillic_converter.js"></script>
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
           <li class="active"><a href="/pravo.org.mk/index.php">Почетна</a></li>
          <li><a class="topdaddy" href="/pravo.org.mk/documentlaws.php">Закони</a></li>
         <li><a href="/pravo.org.mk/analysis.php">Анализи</a></li>
          <li><a href="/pravo.org.mk/regulations.php">Прописи</a></li>
          <li><a href="/pravo.org.mk/courtpractice.php">Судска пракса</a>
           <ul>
             <li><a href="/pravo.org.mk/courtpractice.php">Судска пракса</a></li>
            <li><a href="/pravo.org.mk/europeancourt.php">Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="/pravo.org.mk/news.php">Новости</a></li>
          <li><a href="/pravo.org.mk/contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
       <div id="mapMenu"><!-- InstanceBeginEditable name="SiteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="/pravo.org.mk/index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
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
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="BlockTitle" -->Прати активациски код на корисник<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina" ><!-- InstanceBeginEditable name="BlockContent" -->
                   <div style="padding:5px;"><?php include("util/sendActivation.php"); ?></div></p>
                 <!-- InstanceEndEditable --></div>
            </div>
            </td></tr></table>
     
     </div>

    
	<div class="footer">Copyright &copy; 2009 Сите права задржани</div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите <div style="float:right;"><a href="http://camost.org" target="_blank"><img src="images/most.jpg" border="0"/></a></div></div>
</div>
</td></tr></table>
</body>
<!-- InstanceEnd --></html>
