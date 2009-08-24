<?php
if (!isset($_SESSION)) {
  session_start();
}
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
<title>pravo.org.mk</title>
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
          <li><a href="../index.php">Почетна</a></li>
          <li class="active"><a class="topdaddy" href="../documentlaws.php">Закони</a></li>
          <li><a href="../analysis.php">Анализи</a></li>
          <li><a href="../regulations.php">Прописи</a></li>
          <li><a href="#">Судска Пракса</a>
           <ul>
             <li><a href="../courtpractice.php">Судска Пракса</a></li>
             <li><a href="../europeancourt.php">Судска Пракса на Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="../news.php">Новости</a></li>
          <li><a href="../contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
        <div id="menu"></div>
       <div id="mapMenu"><!-- InstanceBeginEditable name="SiteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td><td>Документи&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content">
            <div><img src="../images/726-90.jpg" width="728" height="90" /></div>
            <!-- InstanceBeginEditable name="Content" -->
            <table width="100%">
              <tr>
                <td width="28%" valign="top"><div class="left-block1">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Администраторско Мени</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina" style="padding-top:10px;">
                     <?php include("util/menu.php"); ?>
                  </div>
                </div></td>
                <td width="72%" valign="top"><div class="right-block-bigger">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Документи</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <p><?php include("util/document.php"); ?>&nbsp;</p>
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
        <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

      </div>

 
        <div class="right">
        <?php include("util/loginSmall.php"); ?>
          <div><img src="../images/250-250.jpg" width="250" height="250" /></div>
          </div>

    </div>
    
	<div class="footer">Copyright &copy; 2008 Сите права задржани</div>	
</div>

</body>
<!-- InstanceEnd --></html>
