<?php 
if (!isset($_SESSION)) {
session_start();
} ?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="../style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../images/favicon1.png" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>pravo.org.mk</title>
<!-- TemplateEndEditable -->
<script type="text/javascript" src="../roktools.js"></script>


<script type="text/javascript" src="../mootools.js"></script>

<script type="text/javascript" src="../rokmoomenu.js"></script>
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
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="logoText"><img src="../images/banner.png" /></div>
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- TemplateBeginEditable name="Menu" -->
        <ul class="nav">
          <li class="active"><a href="#">Почетна</a></li>
          <li><a class="topdaddy" href="#">Документи</a>
            <ul>
              <li><a href="#">Закони</a></li>
              <li><a href="#">Анализи</a></li>
              <li><a href="#">Прописи</a></li>
            </ul>
          </li>
          <li><a href="#">Судска Пракса</a></li>
          <li><a href="#">Форум</a></li>
          <li><a href="#">Новости</a></li>
          <li><a href="#">Контакт</a></li>
        </ul>
      <!-- TemplateEndEditable -->
        <div id="menu"></div>
       <div id="mapMenu"><!-- TemplateBeginEditable name="siteMap" -->Почетна &gt;<!-- TemplateEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content">
            <div><img src="../images/726-90.jpg" width="728" height="90" /></div>
            <table><tr><td>
            <div class="middle-red-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- TemplateBeginEditable name="BlockTitle" -->Наслов<!-- TemplateEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- TemplateBeginEditable name="BlockContent" -->
                   <p>Текст </p>
                   <p>Текст</p>
                   <p>&nbsp;</p>
                 <!-- TemplateEndEditable --></div>
            </div>
            </td></tr></table>
   		 <p>&nbsp;</p>   
      </div>
        <div class="right">
            <?php include("../util/loginSmall.php"); ?>
               <div><img src="../images/250-250.jpg" width="250" height="250" /></div>
          </div>

    </div>
    <div class="above-footer"></div>
	<div class="footer">Copyright &copy; 2008 Сите права задржани</div>	
</div>

</body>
</html>
