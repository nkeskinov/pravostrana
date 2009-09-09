<?php 
session_start();
?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php include("util/banner.php"); ?>
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
<!-- TemplateBeginEditable name="scripts" -->
<!-- TemplateEndEditable -->
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>
<script type="text/javascript" src="../mootools.js"></script>
<script type="text/javascript" src="../roktools.js"></script>
<script type="text/javascript" src="../javaScripts/cirillic_converter.js"></script>
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
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<body>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
        <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>    
      </div>
      <div id="horiz-menu" >
        <ul class="nav"><li class="active"><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="analysis.php">Анализи</a></li>
          <li><a href="regulations.php">Прописи</a></li>
          <li><a href="#">Судска пракса</a>
           <ul>
            <li><a href="courtpractice.php">Судска пракса</a></li>
            <li><a href="europeancourt.php">Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
       <table><tr><td><div id="mapMenu">Почетна &raquo;</div> </td></tr></table>
       </div>
      </div>
    <div class="mainBody">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><div><?php getBanner($database_pravo, $pravo, 1); ?></div></td>
    <td rowspan="4" valign="top">
    <?php include("util/login_block.php"); ?>
		  <br />
          <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
          <br />
          <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
          <br />
          <div><?php getBanner($database_pravo, $pravo, 5); ?></div>
    </td>
  </tr>
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
            </div></td>
    <td valign="top" width="468" style="padding-right:4px;">
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
  <tr>
    <td colspan="2" align="center"><?php getBanner($database_pravo, $pravo, 6); ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" width="250">
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
    <td valign="top" width="468" style="padding-right:4px;">
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
  <tr><td colspan="2" align="center"><?php getBanner($database_pravo, $pravo, 7); ?></td></tr>
  <tr>
        <td colspan="2" valign="top">
        	<div><img src="../images/eurocort.png" width="720" /></div>
            <div><!-- TemplateBeginEditable name="EuroCourtRegion" -->EuroCourtRegion<!-- TemplateEndEditable -->
            </div>
        </td>
    </tr>
</table>
<p>&nbsp;</p>
  </div>
<div class="footer">Copyright &copy; 2009 Сите права задржани</div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите <div style="float:right;"><a href="http://camost.org" target="_blank"><img src="images/most.jpg" border="0"/></a></div>
    
    </div>
</div>

</body>
</html>
