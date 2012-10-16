<?php 
if (!isset($_SESSION)) {
session_start();
} 
if (isset($_SESSION['download_id'])) {
	$_SESSION['download_id_request'] = $_SESSION['download_id'];
	$_SESSION['download_id'] = NULL;
	unset($_SESSION['download_id']);
}
?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php include("util/login.php"); ?>
<?php 
	if(isset($_GET['accesscheck'])) {
		$_SESSION['referrer'] = urldecode($_GET['accesscheck']);
	} elseif(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'login.php') === FALSE) { 
		$_SESSION['referrer'] = $_SERVER['HTTP_REFERER'];
	}
	if((!isset( $_SESSION['MM_Username'] )) or (!isset($_SESSION['MM_UserGroup']))) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/SingleRed_clean.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!--templateinfo codeoutsidehtmlislocked="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="rokmoomenu.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon1.png" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pravo.org.mk | Логирање</title>
<!-- InstanceEndEditable -->
<script type="text/javascript" src="mootools.js"></script>
<script type="text/javascript" src="rokmoomenu.js"></script>
<script type="text/javascript" src="javaScripts/popUpWindow.js"></script>
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

      	<div id="menu"></div>
        <div id="mapMenu">
       <table cellpadding="0" cellspacing="0"><tr><!-- InstanceBeginEditable name="SiteMap" --><td><a href="index.php">Почетна</a>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;</td><td>Логирање&nbsp;</td><!-- InstanceEndEditable --></tr></table>
         </div>
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content" style="width:100%">
            <div></div>
            <!-- InstanceBeginEditable name="EditRegion4" --><table width="440" align="center"><tr><td width="640">
            <br />
            <div class="middle-red-block-small">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle" style="width:420px;"><div class="text">Логирање</div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina">
                  <br />
                <form action="" method="post" name="form1">
                  <table width="420" border="0" align="center" cellspacing="0">
              <tr>
                        <td width="180" align="right">Корисничко име (<strong>e-mail</strong>):</td>
                        <td><input name="username_login" type="text" id="username_login" style="width: 190px;"/></td>
                    </tr>
                      <tr>
                        <td align="right">Лозинка:</td>
                        <td><input name="password_login" type="password" id="password_login" style="width: 190px;"/></td>
                      </tr>
                      <tr>
                      <td width="180">&nbsp;</td>
                        <td><div align="left" style="padding-top:5px;">
                          <input type="submit" name="button" id="button" value="Логирај ме!" style="background-color:#993300; color:#FFFFFF" />
                        </div></td>
                      </tr>
                      <tr>
                        <td colspan="2"><?php if(isset($loginFoundUser) && !$loginFoundUser && isset($loginUserNotActivated) && !$loginUserNotActivated) {?>
                        <div style="color:#F00;">Корисничкото име и лозинката не се совпаѓаат</div>
                        <?php } elseif(isset($loginUserNotActivated) && $loginUserNotActivated) {?>
                        <div style="color:#F00;">Вашата корисничка сметка не е активирана!<br />Проверете го вашиот e-mail за активациската порака.</div>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><div align="center" class="down"><a href="resetPassword.php">Заборави лозинка?</a> | <a href="register.php?new">Регистрирај се!</a></div></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>
                    </form>
	<?php } else { 
		if (isset($_SESSION['download_id_request'])) {
			$_SESSION['download_id'] = $_SESSION['download_id_request'];
			$_SESSION['download_id_request'] = NULL;
			unset($_SESSION['download_id_request']);
		}
		if (isset($_SESSION['referrer'])) {
			$referrer = $_SESSION['referrer'];
			$_SESSION['referrer'] = NULL;
			unset($_SESSION['referrer']);
			header("Location: ".$referrer); 
		} else { 
			header("Location: index.php"); 
		}
		
	} ?>

                 </div>
            </div>
        </td></tr></table><!-- InstanceEndEditable --> 
      </div>

    </div>
    <div class="above-footer"></div>
	<div class="footer"><span style="float:left;">&copy; 2010 Сите права задржани</span><span style="float:right;"><a href="JavaScript:popUpWindow('help.php?id=5','','',600,520);" style="color:#FFFFFF;">Услови за користење</a> | <a href="JavaScript:popUpWindow('help.php?id=6','','',600,350);" style="color:#FFFFFF;">Политика за приватност</a></span></div>	
    <div style="margin-top:-30px; color:#999; float:left; width:100%;">Pravo.org.mk не презема одговорност за евентуалните грешки во текстот на законите.<div style="float:right;"><a href="http://www.most.org.mk" target="_blank"><img src="images/most.jpg" border="0"/></a></div></div>
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
