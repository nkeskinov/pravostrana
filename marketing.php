<?php 
if (!isset($_SESSION)) {
session_start();
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
<title>pravo.org.mk</title>
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
      <!-- InstanceEndEditable -->
        <div id="menu"></div>
       <div id="mapMenu"><!-- InstanceBeginEditable name="siteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content">
            <div><?php getBanner($database_pravo, $pravo, 1); ?></div>
            <table><tr><td>
            <div class="middle-red-block">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle"><div class="text"><!-- InstanceBeginEditable name="BlockTitle" -->Маркетинг<!-- InstanceEndEditable --></div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina"><!-- InstanceBeginEditable name="BlockContent" -->
                   <table width="100%" border="0">
                     <tr>
                       <th scope="col">&nbsp;</th>
                       <th scope="col">Опис</th>
                       <th scope="col">Димензии</th>
                       <th scope="col">Максимална големина</th>
                       <th scope="col">Цена/неделно</th>
                     </tr>
                     <tr>
                       <th scope="row">Позиција 1</th>
                       <td align="center">Leaderboard</td>
                       <td align="center">728 x 90</td>
                       <td align="center">40 KB</td>
                       <td align="center">&nbsp;</td>
                     </tr>
                     <tr>
                       <th scope="row">Позиција 2</th>
                       <td align="center">Half Banner</td>
                       <td align="center">234 x 60</td>
                       <td align="center">40 KB</td>
                       <td align="center">&nbsp;</td>
                     </tr>
                     <tr>
                       <th scope="row">Позиција 3</th>
                       <td align="center">Medium Rectangle</td>
                       <td align="center">250 x 250</td>
                       <td align="center">40 KB</td>
                       <td align="center">&nbsp;</td>
                     </tr>
                     <tr>
                       <th scope="row">Позиција 4</th>
                       <td align="center">Medium Rectangle</td>
                       <td align="center">250 x 250</td>
                       <td align="center">40 KB</td>
                       <td align="center">&nbsp;</td>
                     </tr>
                     <tr>
                       <th scope="row">Позиција 5</th>
                       <td align="center">Wide Skyscraper</td>
                       <td align="center">160 x 600</td>
                       <td align="center">40 KB</td>
                       <td align="center">&nbsp;</td>
                     </tr>
                     <tr>
                       <th scope="row">Позиција 6</th>
                       <td align="center">Full Banner</td>
                       <td align="center">468 x 60</td>
                       <td align="center">40 KB</td>
                       <td align="center">&nbsp;</td>
                     </tr>
                     <tr>
                       <th scope="row">Позиција 7</th>
                       <td align="center">Full Banner</td>
                       <td align="center">468 x 60</td>
                       <td align="center">40 KB</td>
                       <td align="center">&nbsp;</td>
                     </tr>
                   </table>
                   <ul>
                     <li>Во цените не е вклучен 18% ДДВ.<br>
                     </li>
                     <li>За 1+ месечно рекламирање цените се пониски за 20%, за 2+ месечно рекламирање цените се пониски за 30%. </li>
                     <li>Позициите за рекламирање се резервираат и плаќаат една недела однапред. </li>
                     <li>Во цените не е вклучено изработка на рекламен банер. </li>
                   </ul>
                   <p>Контакт: <br />
                   email: marketing@pravo.org.mk<br />
                   </p>
                   <div align="center"><img src="images/marketing.jpg" /></div>
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
