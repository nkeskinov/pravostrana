<?php 
session_start();
?>
<?php require_once("../Connections/pravo.php"); ?>
<?php include("../util/misc.php"); ?>
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
           <li><a href="../index.php">Почетна</a></li>
          <li class="active"><a class="topdaddy" href="../documentlaws.php">Закони</a></li>
         <li><a href="../analysis.php">Анализи</a></li>
          <li><a href="../policies.php">Прописи</a></li>
          <li><a href="#">Судска Пракса</a>
           <ul>
            <li><a href="../studentpractice.php">Студентска Пракса</a></li>
            <li><a href="#">Непозната</a></li>
           </ul>
          </li>
          <li><a href="../forum.php">Форум</a></li>
          <li><a href="../news.php">Новости</a></li>
          <li><a href="../contact.php">Контакт</a></li>
        </ul>
      <!-- TemplateEndEditable -->
        <div id="menu"></div>
       <div id="mapMenu"><!-- TemplateBeginEditable name="SiteMap" -->Почетна &gt;<!-- TemplateEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content">
            <div><img src="../images/726-90.jpg" width="728" height="90" /></div>
            <!-- TemplateBeginEditable name="Content" -->
            <table width="100%">
              <tr>
                <td width="28%" valign="top"><div class="left-block">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Наслов</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <p>Текст </p>
                  </div>
                </div></td>
                <td width="72%" valign="top"><div class="right-block-bigger">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Наслов</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <p>Текст </p>
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
            <!-- TemplateEndEditable -->
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
</html>
