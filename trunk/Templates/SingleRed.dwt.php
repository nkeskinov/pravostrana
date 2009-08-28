<?php 
if (!isset($_SESSION)) {
session_start();
} ?>
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
        <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- TemplateBeginEditable name="Menu" -->
          <ul class="nav">
          <li class="active"><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="analysis.php">Анализи</a></li>
          <li><a href="policies.php">Прописи</a></li>
          <li><a href="#">Судска пракса</a>
           <ul>
            <li><a href="courtpractice.php">Судска пракса</a></li>
            <li><a href="europeancourt.php">Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
      <!-- TemplateEndEditable -->
        <div id="menu"></div>
       <div id="mapMenu"><!-- TemplateBeginEditable name="siteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td></tr></table><!-- TemplateEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content">
            <div><?php getBanner($database_pravo, $pravo, 1); ?></div>
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
            <?php include("../util/login_block.php"); ?>
               <br />
              <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
              <br />
              <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
              <br />
              <div><?php getBanner($database_pravo, $pravo, 5); ?></div>
              </div>

    </div>
    <div class="above-footer"></div>
	<div class="footer">Copyright &copy; 2008 Сите права задржани</div>	
</div>

</body>
</html>
