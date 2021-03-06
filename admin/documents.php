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
//change into/out of force
if (isset($_GET['id_document']) && isset($_GET['id_doc_type']) && isset($_GET['into_force']) && $_GET['id_document'] != '0' && ($_GET['id_doc_type'] == '1' || $_GET['id_doc_type'] == '2')) {
	$id_document = $_GET['id_document'];
	$query_IntoForce = sprintf("UPDATE document SET into_force = %s WHERE id_document = %s", GetSQLValueString($_GET['into_force'], "int"), GetSQLValueString($id_document, "int"));
	mysql_select_db($database_pravo, $pravo);
	mysql_query($query_IntoForce, $pravo) or die(mysql_error());
	header('Location: '.'../documentDetail.php?id='.$id_document);
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
<title>Pravo.org.mk | Документи</title>
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
           <li><a href="../index.php">Почетна</a></li>
          <li class="active"><a class="topdaddy" href="../documentlaws.php">Закони</a></li>
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
       <div id="mapMenu"><!-- InstanceBeginEditable name="SiteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="../index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
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
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="BlockTitle" -->Документи<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina" ><!-- InstanceBeginEditable name="BlockContent" -->
                  <?php include("util/document.php"); ?>
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
