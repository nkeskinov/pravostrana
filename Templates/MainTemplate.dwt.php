<?php 
session_start();
?>
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
<title>Pravo.org.mk</title>
<!-- TemplateEndEditable -->
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>

<script type="text/javascript" src="../roktools.js"></script>

<script type="text/javascript" src="../javaScripts/cirillic_converter.js"></script>
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

      <div id="horiz-menu" class="moomenu">
        <ul class="nav"><li class="active"><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="analysis.php">Анализи</a></li>
          <li><a href="regulations.php">Прописи</a></li>
          <li><a href="#">Судска Пракса</a>
           <ul>
            <li><a href="courtpractice.php">Судска Пракса</a></li>
            <li><a href="europeancourt.php">Европски суд</a></li>
           </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>

      	<div id="menu"></div>
       <table><tr><td><div id="mapMenu">Почетна &raquo;</div> </td></tr></table>
       </div>
      </div>


    <div class="mainBody">
   	  <div class="content">
            <div><img src="../images/726-90.jpg" width="728" height="90" /></div>
            <table>
            <tr>
            <td valign="top" width="250">
            <div class="left-block1">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- TemplateBeginEditable name="leftTitle" -->Наслов<!-- TemplateEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- TemplateBeginEditable name="leftContent" -->
                    <p>Текст </p><!-- TemplateEndEditable -->
                    
              </div>
            </div>
            </td>
            <td valign="top" width="468">
           <div class="right-block">
                <div class="title">
                    <div class="left"></div>
                  <div class="middle"><div class="text"><!-- TemplateBeginEditable name="rightTitle" -->Наслов<!-- TemplateEndEditable --> </div>
                   </div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- TemplateBeginEditable name="rightContent" -->
                   <p>Текст </p>
                 <!-- TemplateEndEditable --></div>
            </div>
            </td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
            <td valign="top">
            <div class="left-red-block1">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- TemplateBeginEditable name="leftTitle2" -->Наслов<!-- TemplateEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- TemplateBeginEditable name="leftContent2" -->
                    <p>Текст </p><!-- TemplateEndEditable -->
                    
              </div>
            </div>
            </td>
            <td valign="top">
           <div class="right-yellow-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- TemplateBeginEditable name="rightTitle2" -->Наслов<!-- TemplateEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- TemplateBeginEditable name="rightContent2" -->
                   <p>Текст </p>
                 <!-- TemplateEndEditable --></div>
        </div>
        </td>
        </tr>
        <tr>
        <td colspan="2" valign="top">
        	<div><img src="../images/eurocort.png" width="720" /></div>
            <div><!-- TemplateBeginEditable name="EuroCourtRegion" -->EuroCourtRegion<!-- TemplateEndEditable --></div>
        </td>
        </table> 
        <p>&nbsp;</p>
 <!--<div style="height:50px; background:#a25852; margin-bottom:-12px; padding:5px; color:#FFF;">
        <table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Реализирано од</td>
    <td>Подржано од</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div> 
!-->
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div>
        <div class="right">
        <?php include("util/login_block.php"); ?>
          <div><img src="../images/250-250.jpg" width="250" height="250" /></div>
          </div>

    </div>
    
	<div class="footer">Copyright &copy; 2009 Сите права задржани</div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не превзема одговорност за евентуалните грешки во текстот на законите <div style="float:right;"><img src="images/most.jpg"/></div>
    
    </div>
</div>

</body>
</html>
