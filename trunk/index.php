<?php 
if (!isset($_SESSION)) {
session_start();
} ?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Почетна</title>
<!-- InstanceEndEditable -->
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>

<script type="text/javascript" src="roktools.js"></script>

<script type="text/javascript" src="javaScripts/cirillic_converter.js"></script>
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
   	    <div id="logoText"><img src="images/banner.png" /></div>
   	  </div>

      <div id="horiz-menu" class="moomenu">
        <ul class="nav"><li class="active"><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="#">Анализи</a></li>
          <li><a href="#">Прописи</a></li>
          <li><a href="#">Судска Пракса</a>
           <ul>
            <li><a href="#">Студентска</a></li>
            <li><a href="#">Непозната</a></li>
           </ul>
          </li>
          <li><a href="#">Форум</a></li>
          <li><a href="#">Новости</a></li>
          <li><a href="#">Контакт</a></li>
        </ul>

      	<div id="menu"></div>
       <table><tr><td><div id="mapMenu">Почетна &raquo;</div> </td></tr></table>
       </div>
      </div>


    <div class="mainBody">
   	  <div class="content">
            <div><img src="images/726-90.jpg" width="728" height="90" /></div>
            <table>
            <tr>
            <td valign="top" width="250">
            <div class="left-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="leftTitle" -->Новости<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="leftContent" -->
                    <p>Текст </p>
                    <p><a href="login.php">login</a></p>
                    <p>sdf</p>
                    <p>sdf</p>
                 <!-- InstanceEndEditable -->
                    
              </div>
            </div>
            </td>
            <td valign="top" width="468">
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
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
            <td valign="top">
            <div class="left-red-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="leftTitle2" -->Наслов<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="leftContent2" -->
                    <p>Текст </p><!-- InstanceEndEditable -->
                    
              </div>
            </div>
            </td>
            <td valign="top">
           <div class="right-yellow-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="rightTitle2" -->Последни закони<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="rightContent2" -->
                   <?php include('util/latestLaws.php'); ?>
                 <!-- InstanceEndEditable --></div>
        </div>
        </td>
        </tr>
        </table>  
    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
      </div>

 
        <div class="right">
        <?php include("util/login_block.php"); ?>
          <div><img src="images/250-250.jpg" width="250" height="250" /></div>
          </div>

    </div>
    
	<div class="footer">Copyright &copy; 2008 Сите права задржани</div>	
</div>

</body>
<!-- InstanceEnd --></html>
