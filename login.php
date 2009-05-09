<?php 
if (!isset($_SESSION)) {
session_start();
} ?>
<?php require_once("Connections/pravo.php"); ?>
<?php include("util/misc.php"); ?>
<?php include("util/login.php"); ?>
<?php 
	if(strpos($_SERVER['HTTP_REFERER'],'login.php') == false) { 
		$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
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
<title>pravo.org.mk</title>
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

  		
        <ul class="nav"><li class="active"><a href="#">Почетна</a></li>
        <li><a class="topdaddy" href="#">Документи</a>
          <ul>
        <li><a href="#">Закони</a></li>
        <li><a href="#">Анализи</a></li>
        <li><a href="#">Прописи</a></li>
        </ul></li>
      
        <li><a href="#">Судска Пракса</a></li>
        <li><a href="#">Форум</a></li>
        <li><a href="#">Новости</a></li>
        <li><a href="#">Контакт</a></li>
        </ul>

      	<div id="menu"></div>
       <div id="mapMenu"><!-- InstanceBeginEditable name="siteMap" -->Почетна &gt;<!-- InstanceEndEditable --></div> 
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
                <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="form1">
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
                        <div style="color:#F00;">Корисничкото име и лозинката не се софпаѓаат</div>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><div align="center" class="down">Заборави лозинка? |<a href="register.php?new">Регистрирај се!</a></div></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>
                    </form>
	<?php }else { 
		 if(isset($_SESSION['referer']))
			header("Location: ".$_SESSION['referer']); 
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
