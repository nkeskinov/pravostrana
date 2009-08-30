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
<title>Pravo.org.mk | Категории на документи</title>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="../roktools.js"></script>


<script type="text/javascript" src="../mootools.js"></script>
<script type="text/javascript" src="../javaScripts/cirillic_converter.js"></script>

<script type="text/javascript" src="../rokmoomenu.js"></script>
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

<style type="text/css">
<!--

-->
</style>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="logoText"><img src="../images/banner.png" /></div>
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- InstanceBeginEditable name="Menu" -->
        <ul class="nav">
           <li><a href="/pravo.org.mk/index.php">Почетна</a></li>
          <li class="active"><a class="topdaddy" href="/pravo.org.mk/documentlaws.php">Закони</a></li>
         <li><a href="/pravo.org.mk/analysis.php">Анализи</a></li>
          <li><a href="/pravo.org.mk/regulations.php">Прописи</a></li>
          <li><a href="#">Судска пракса</a>
           <ul>
             <li><a href="/pravo.org.mk/courtpractice.php">Судска пракса</a></li>
            <li><a href="/pravo.org.mk/europeancourt.php">Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="/pravo.org.mk/news.php">Новости</a></li>
          <li><a href="/pravo.org.mk/contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
        <div id="menu"></div>
       <div id="mapMenu"><!-- InstanceBeginEditable name="SiteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
      </div>
	</div>
    <div class="mainBody">
   	  <div class="content">
            <div></div>
            <table><tr><td>
            <div class="middle-red-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="BlockTitle" -->Наслов<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="BlockContent" -->
                   <?php include("util/document_category.php") ?>
                 <!-- InstanceEndEditable --></div>
            </div>
            </td></tr></table>
   		 <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>   
      </div>
        <div class="right">
				<?php include("util/loginSmall.php"); ?>
            <br />
            <div class="left-block1" style="width:250px;>
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text">Администраторско Мени</div></div>
                    <div class="right"></div>
                </div>
                <div class="sodrzina" style="padding-top:10px;">
                    <?php include("util/menu.php"); ?>
                </div>
            </div>
          </div>

    
	<div class="footer">Copyright &copy; 2008 Сите права задржани</div>	
</div>

</body>
<!-- InstanceEnd --></html>
