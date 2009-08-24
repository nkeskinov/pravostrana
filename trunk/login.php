<?php 
if (!isset($_SESSION)) {
session_start();
} ?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php include("util/login.php"); ?>
<?php 
	if(isset($_GET['accesscheck'])) {
		$_SESSION['referrer'] = urldecode($_GET['accesscheck']);
	} elseif(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'login.php') === FALSE) { 
		$_SESSION['referrer'] = $_SERVER['HTTP_REFERER'];
	}
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
<title>pravo.org.mk | Логирање</title>
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
   	  </div>
      <div id="horiz-menu" class="moomenu">

  		
         <ul class="nav"><li class="active"><a href="index.php">Почетна</a></li>
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

      	<div id="menu"></div>
       <div id="mapMenu"><!-- InstanceBeginEditable name="siteMap" --><table cellpadding="0" cellspacing="0"><tr><td><a href="index.php">Почетна</a></td>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;<td>Логирање&nbsp;</td></tr></table><!-- InstanceEndEditable --></div> 
      </div>
	</div>
    
    <div class="mainBody">
   	  <div class="content" style="width:100%">
            <div></div>
            <!-- InstanceBeginEditable name="EditRegion4" --><table width="370" align="center"><tr><td width="601">
            <br />
            <div class="middle-red-block-small">
                <div class="title">
                    <div class="left"></div>
                    <div class="middle" style="width:350px;"><div class="text">Логирање</div></div>
                    <div class="right"></div>
                </div>
                 <div class="sodrzina">
                  <br />
                  <?php if((!isset( $_SESSION['MM_Username'] )) or (!isset($_SESSION['MM_UserGroup']))){  ?>
                <form action="" method="post" name="form1">
                  <table width="337" border="0" align="center" cellspacing="0">
              <tr>
                        <td width="153">Корисничко име:</td>
                        <td width="193" ><input name="username_login" type="text" id="username_login" size="30" /></td>
                    </tr>
                      <tr>
                        <td>Лозинка:</td>
                        <td><input name="password_login" type="password" id="password_login" size="30" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="right" style="padding-top:5px;">
                          <input type="submit" name="button" id="button" value="Логирај ме!" style="background-color:#993300; color:#FFFFFF" />
                        </div></td>
                      </tr>
                      <tr>
                        <td colspan="2"><?php if(isset($loginFoundUser) && !$loginFoundUser) {?>
                        <div style="color:#F00;">Корисничкото име и лозинката не се совпаѓаат</div>
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
		if(isset($_SESSION['referrer'])) {
			header("Location: ".$_SESSION['referrer']); 
			$_SESSION['referrer'] = NULL;
			unset($_SESSION['referrer']);
		}
		else 
			header("Location: index.php"); 
		
	} ?>

                 </div>
            </div>
        </td></tr></table><!-- InstanceEndEditable --> 
      </div>

    </div>
    <div class="above-footer"></div>
	<div class="footer">Copyright &copy; 2008 Сите права задржани</div>	
</div>

</body>
<!-- InstanceEnd --></html>
