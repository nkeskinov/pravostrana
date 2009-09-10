<?php session_start(); ?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php 
$ip_address=$_SERVER['REMOTE_ADDR'];
$page=substr(strrchr($_SERVER['PHP_SELF'],"/"),1);
$from_page="";
$referrer = "";
if (isset($_SERVER['HTTP_REFERER'])) {
	$from_page=substr(strrchr($_SERVER['HTTP_REFERER'],"/"),1);
	$referrer=$_SERVER['HTTP_REFERER'];
}
$browser=$_SERVER['HTTP_USER_AGENT'];
$language=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
$id_user=1;
if(isset($_SESSION['MM_ID']))
	$id_user=$_SESSION['MM_ID'];

trackVisit($ip_address, $referrer, $browser, $language, $id_user, $page, $from_page, $database_pravo, $pravo);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CleanTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Детален опис на документ</title>
<!-- InstanceEndEditable -->
<?php include("util/banner.php"); ?>
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>

<script type="text/javascript" src="roktools.js"></script>

<script type="text/javascript" src="mootools.js"></script>

<script type="text/javascript" src="javaScripts/cirillic_converter.js"></script>
<script type="text/javascript" src="rokmoomenu.js"></script>
<script language="javascript" type="text/javascript" src="javaScripts/prototype.js"></script><script language="javascript" type="text/javascript" src="javaScripts/autoExpandContract.js"></script>
 <script type="text/javascript">  
         // <![CDATA[  
         document.observe('dom:loaded', function() {  
             $$('.highlight').each(function(item) {  
                 item.observe('focus', function(){   
                     item.style.backgroundColor = "FDFFDE";  
                 });  
                 item.observe('blur', function(){   
                     item.style.backgroundColor = "ffffff";  
                 });               
             });  
             
         });  
         //   
         </script> 
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
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
<table align="center"><tr><td>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
   	    <div id="bannerDiv1"><?php getBanner($database_pravo, $pravo, 2); ?></div>    
   	  </div>
      <div id="horiz-menu" class="moomenu"><!-- InstanceBeginEditable name="Menu" -->
        <ul class="nav">
          <li><a href="index.php">Почетна</a></li>
          <li <?php if($_GET['page']=="documentlaws.php") echo 'class="active"' ?>><a href="documentlaws.php">Закони</a></li>
          <li <?php if($_GET['page']=="analysis.php") echo 'class="active"' ?>><a href="analysis.php">Анализи</a></li>
          <li <?php if($_GET['page']=="regulations.php") echo 'class="active"' ?>><a href="regulations.php">Прописи</a></li>
          <li <?php if($_GET['page']=="courtpractice.php" || $_GET['page']=="europeancourt.php") echo 'class="active"' ?>><a href="courtpractice.php">Судска пракса</a>
          	<ul>
            	 <li><a href="courtpractice.php">Судска пракса</a></li>
            	 <li><a href="europeancourt.php">Европски суд за човекови права</a></li>
             </ul>
          </li>
          <li><a href="news.php">Новости</a></li>
          <li><a href="contact.php">Контакт</a></li>
        </ul>
      <!-- InstanceEndEditable -->
        <div id="mapMenu">
       <!-- InstanceBeginEditable name="SiteMap" -->
       <table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</td><td>
	   <?php if($_GET['page']=="documentlaws.php") echo '<a href="documentlaws.php">Закони</a>'; if($_GET['page']=="analysis.php") echo '<a href="analysis.php">Анализи</a>';  if($_GET['page']=="regulations.php") echo '<a href="regulations.php">Прописи</a>'; if($_GET['page']=="courtpractice.php") echo '<a href="courtpractice.php">Судска пракса</a>';  if($_GET['page']=="europeancourt.php") echo '<a href="europeancourt.php">Судска пракса на Европски суд</a>';?>
       &nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td><td> Детален опис на документ</td></tr></table> 
      <!-- InstanceEndEditable -->
       </div>
      </div>
	</div>
    
    <div class="mainBody">
            <!-- InstanceBeginEditable name="Content" -->
            <table width="100%" cellpadding="0">
             <tr>
                <td colspan="2"><div><?php getBanner($database_pravo, $pravo, 1); ?></div></td>
                <td rowspan="4" valign="top">
                <?php include("util/login_block.php"); ?>
        			  <p><a href="http://www.adobe.com/go/EN_US-H-GET-FLASH"><img src="/pravo.org.mk/images/get_adobe_reader.png" border="0" /></a> </p>
                      <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
                      <br />
                      <div><?php getBanner($database_pravo, $pravo, 5); ?></div>
                </td>
              </tr>
              <tr>
                <td valign="top" width="200"><div class="left-block">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Поврзани документи</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina" style=" padding:0; padding-left:2px;">
                    <p><?php include("util/documents_by_category.php"); ?></p>
                  </div>
                </div></td>
                <td valign="top" width="468" style="padding-right:1px;"><div class="right-block-bigger">
                  <div class="title">
                    <div class="left"></div>
                    <div class="middle">
                      <div class="text">Детален опис на документ</div>
                    </div>
                    <div class="right"></div>
                  </div>
                  <div class="sodrzina">
                    <?php include("util/documentdetail.php"); ?>
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
    </div>
	<div class="footer">Copyright &copy; 2009 Сите права задржани</div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите <div style="float:right;"><a href="http://camost.org" target="_blank"><img src="images/most.jpg" border="0"/></a></div></div>
</div>
</td></tr></table>
</body>
<!-- InstanceEnd --></html>