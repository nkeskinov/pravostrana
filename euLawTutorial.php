<?php 
if (!isset($_SESSION)) {
session_start();
$id_post_category=4; //ID for news
$discussionName="Европски суд туторијал"; //The name of the Discusion
} ?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php include("util/banner.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/SingleRed.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Правна рамка на Европската Унија</title>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="roktools.js"></script>


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
        <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- InstanceBeginEditable name="Menu" -->
          <ul class="nav">
          <li><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="analysis.php">Анализи</a></li>
          <li><a href="policies.php">Прописи</a></li>
          <li class="active"><a href="#">Судска Пракса</a>
           <ul>
            <li><a href="courtpractice.php">Судска Пракса</a></li>
            <li><a href="europeancourt.php">Европски суд за човекови права</a></li>
           </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
        <div id="menu"></div>
       <div id="mapMenu"><!-- InstanceBeginEditable name="siteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td><td>Правна рамка на Европската Унија&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content">
            <div><?php getBanner($database_pravo, $pravo, 1); ?></div>
            <table><tr><td>
            <div class="middle-red-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="BlockTitle" -->Правна рамка на Европската Унија<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="BlockContent" -->
                   <?php include("util/news.php"); ?>
                 <!-- InstanceEndEditable --></div>
            </div>
            </td></tr></table>
   		 <p>&nbsp;</p>   
      </div>
        <div class="right">
            <?php include("util/login_block.php"); ?>
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
<!-- InstanceEnd --></html>
