<?php 
session_start();
?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php include("util/banner.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate_new.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="mk-mk" />
<meta name="description" content="Сите закони на едно место. База на закони, анализи, судски пракси..." />
<meta name="keywords" content="makedonija, pravo, zakon, zakoni, sudska praksa, analizi, MOST, zakonodavstvo, zakonodavna funkcija, македонија, право, закон, судска пракса, закони, анализи, МОСТ, законодавна функција, законодавство" />
<link href="../rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="../style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="scripts" -->
<!-- InstanceEndEditable -->
<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>
<script type="text/javascript" src="../mootools.js"></script>
<script type="text/javascript" src="../rokmoomenu.js"></script>
<script type="text/javascript" src="../javaScripts/cirillic_converter.js"></script>
<script type="text/javascript" src="../javaScripts/popUpWindow.js"></script>
<script type="text/javascript">
<!--
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
//-->
</script>
<style type="text/css" media="screen"> 
            html, body  { height:100%; }
            body { margin:0; padding:0; overflow:auto; text-align:center; 
                   background-color: #ffffff; }   
            object:focus { outline:none; }
            #flashContent { display:none; }
        </style>
        
        <!-- Enable Browser History by replacing useBrowserHistory tokens with two hyphens -->
        <!-- BEGIN Browser History required section -->
        <link rel="stylesheet" type="text/css" href="history/history.css" />
        <script type="text/javascript" src="history/history.js"></script>
        <!-- END Browser History required section -->  
            
        <script type="text/javascript" src="swfobject.js"></script>
        <script type="text/javascript">
            // For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. 
            var swfVersionStr = "11.1.0";
            // To use express install, set to playerProductInstall.swf, otherwise the empty string. 
            var xiSwfUrlStr = "playerProductInstall.swf";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "RightToKnowFlash";
            attributes.name = "RightToKnowFlash";
            attributes.align = "middle";
            swfobject.embedSWF(
                "RightToKnowFlash/bin-debug/RightToKnowFlash.swf", "flashContent", 
                "680", "430", 
                swfVersionStr, xiSwfUrlStr, 
                flashvars, params, attributes);
            // JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
            swfobject.createCSS("#flashContent", "display:block;text-align:left;");
        </script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<div id="wrapper">
	<div class="header">
   	  <div class="header-top">
        <div id="bannerDiv1"><?php include("util/login_test.php"); ?>
          </div>    
      </div>
      <div id="horiz-menu" >
        <ul class="nav"><li class="active"><a href="index.php">Почетна</a></li>
          <li><a class="topdaddy" href="documentlaws.php">Закони</a></li>
          <li><a href="analysis.php">Анализи</a></li>
          <li><a href="regulations.php">Прописи</a></li>
          <li><a href="courtpractice.php">Судска пракса</a>
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

<table width="100%" border="0" cellspacing="0" >
 <tr>
 	<td colspan="2"><?php getBanner($database_pravo, $pravo, 1); ?></td>
    <td width="250"></td>
 </tr>
 <tr>
   <td width="250" valign="top"  >
   <table width="100%" border="0" cellpadding="0" cellspacing="0" height="462">
   	<tr height="30">
    	<td width="7" style="background:url(images/red-title-left1.png)"></td> 
        <td style="background:url(images/red-title-middle1.png); color:#fcf9ea; font-weight:bold;padding-top:5px;" >
        	<!-- InstanceBeginEditable name="searchTitle" -->Наслов<!-- InstanceEndEditable -->
        </td>
        <td width="7" style="background:url(images/red-title-right1.png);"></td>
    </tr>
    <tr>
    	<td colspan="3" style="margin-top:0px;  background:#fbf6df; padding-left:5px; padding-right:5px" valign="top">
        	<!-- InstanceBeginEditable name="searchContent" -->
                    <p>Текст </p><!-- InstanceEndEditable -->
        </td>
    </tr>
   </table>
   	</td>
   <td valign="top" colspan="2" style="padding-left:3px; padding-right:5px">
   <table width="100%" height="450" border="0" cellpadding="0" cellspacing="0">
   	<tr height="30">
    	<td width="7" style="background:url(images/red-title-left.png)"></td>
        <td style="background:url(images/red-title-middle.png); color:#fcf9ea; font-weight:bold; padding-top:5px;"  width="690"> 
        	<!-- InstanceBeginEditable name="middleTitle" -->Наслов<!-- InstanceEndEditable -->
        </td>
        <td width="7" style="background:url(images/red-title-right.png);"></td>
    </tr>
    <tr>
    	<td colspan="3" style="border:1px solid #71312d; border-top:none margin-top:0px; padding:0px;" align="center" valign="top">
        	<!-- InstanceBeginEditable name="middleContent" -->
                    <p>Текст </p><!-- InstanceEndEditable -->
        </td>
    </tr>
   </table>
   </td>
 </tr>
 <tr>
 	<td colspan="2"><?php getBanner($database_pravo, $pravo, 6); ?></td>
    <td rowspan="4" valign="top" style="padding-left:3px; padding-right:3px">
   <div><?php getBanner($database_pravo, $pravo, 3); ?></div>
          <br />
          <div><?php getBanner($database_pravo, $pravo, 4); ?></div>
          <br />
          <div><?php getBanner($database_pravo, $pravo, 5); ?></div>   </td>
 </tr>
 <tr>
   <td valign="top">
   <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
   	<tr height="30">
    	<td width="7" style="background:url(images/red-title-left1.png)"></td>
        <td style="background:url(images/red-title-middle1.png); color:#fcf9ea; font-weight:bold; padding-top:5px;" >
        	<!-- InstanceBeginEditable name="leftTitle1" -->Наслов<!-- InstanceEndEditable -->
        </td>
        <td width="7" style="background:url(images/red-title-right1.png);"></td>
    </tr>
    <tr>
    	<td colspan="3" style="margin-top:0px; padding:0px;" align="center">
        	<!-- InstanceBeginEditable name="leftContent1" -->
                    <p>Текст </p><!-- InstanceEndEditable -->
        </td>
    </tr>
   </table>
   </td>
   <td valign="top" style="padding-left:5px">
     <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
       <tr height="30">
         <td width="7" style="background:url(images/red-title-left.png)"></td>
         <td style="background:url(images/red-title-middle.png); color:#fcf9ea; font-weight:bold; padding-top:5px;"  width="468">
           <!-- InstanceBeginEditable name="middleTitle1" -->Наслов<!-- InstanceEndEditable -->
           </td>
         <td width="7" style="	background:url(images/red-title-right.png);"></td>
         </tr>
       <tr>
         <td colspan="3" style="border:1px solid #71312d; border-top:none margin-top:0px; padding:0px;" align="center">
           <!-- InstanceBeginEditable name="middleContent1" -->
                    <p>Текст </p><!-- InstanceEndEditable -->
           </td>
         </tr>
       </table>
   </td>
   </td>
 </tr>
 <tr>
 	<td colspan="2"><?php getBanner($database_pravo, $pravo, 7); ?></td>
    <td></td>
 </tr>
 <tr>
 	 <td colspan="2" valign="top">
        	<div><img src="../images/eurocort.png" width="720" /></div>
            <div style="	border:1px solid #f5e6a2; border-top:none"><!-- InstanceBeginEditable name="EuroCourtRegion" -->EuroCourtRegion<!-- InstanceEndEditable -->
            </div>
      </td>
      </tr>
</table>
<p>&nbsp;</p>
  </div>
<div class="footer"><span style="float:left;">&copy; 2010 Сите права задржани</span><span style="float:right;"><a href="JavaScript:popUpWindow('help.php?id=5','','',600,520);" style="color:#FFFFFF;">Услови за користење</a> | <a href="JavaScript:popUpWindow('help.php?id=6','','',600,350);" style="color:#FFFFFF;">Политика за приватност</a></span></div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите.<div style="float:right;"><a href="http://camost.org" target="_blank"><img src="images/most.jpg" border="0"/></a></div>
    
    </div>
</div>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.pravo.org.mk/piwik/" : "http://www.pravo.org.mk/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.pravo.org.mk/piwik/piwik.php?idsite=1" style="border:0" alt=""/></p></noscript>
<!-- End Piwik Tag -->
</body>
<!-- InstanceEnd --></html>
