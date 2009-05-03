<?php require_once('Connections/pravo.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "id_user";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_pravo, $pravo);
  	
  $LoginRS__query=sprintf("SELECT username, password, id_user, name, surname FROM `user` WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $pravo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
	$loginStrName = mysql_result($LoginRS,0,'name');
	$loginStrSurname  = mysql_result($LoginRS,0,'surname');
	$id_user = mysql_result($LoginRS,0,'id_user');
	
	$Group_query = sprintf("select uc.name from user u, user_category uc, user_category_has_user uchu \n"
    . "where u.id_user = uchu.id_user and uc.id_user_category = uchu.id_user_category\n"
    . "and u.id_user = %s ",$id_user);
	
	$loginResult = mysql_query($Group_query, $pravo) or die(mysql_error());
   
	
	$loginStrGroup = array();
	while($row = mysql_fetch_array($loginResult,MYSQL_ASSOC)){
		array_push($loginStrGroup, $row["name"]);	
	}
	//echo $id_user."\n";
	//print_r( $loginStrGroup);
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	
	$_SESSION['MM_Name'] = $loginStrName." ".$loginStrSurname;
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
   // header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
   // header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<?php if((!isset( $_SESSION['MM_Username'] )) or (!isset($_SESSION['MM_UserGroup']))){  ?>
<div class="login">
              <div class="title">Најавување</div>
                <div class="forms">
                <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="form1">
                  <table width="100%" border="0" cellspacing="0">
              <tr>
                        <td>Корисничко име:</td>
                        <td ><input name="username" type="text" id="username" size="17" /></td>
                    </tr>
                      <tr>
                        <td>Лозинка:</td>
                        <td><input name="password" type="password" id="password" size="17" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="right" style="padding-top:5px;">
                          <input type="submit" name="button" id="button" value="Логирај ме!" style="background-color:#993300; color:#FFFFFF" />
                        </div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><div align="center" style="color:#493a35">Заборави лозинка?</div></td>
                      </tr>
                      <tr>
                        <td colspan="2"><div align="center" style="color:#493a35"><a href="register.php">Регистрирај се!</a></div></td>
                      </tr>
                    </table>
                    </form>
	</div>
</div>
<?php }elseif((isset( $_SESSION['MM_Username'] )) and  (isset($_SESSION['MM_UserGroup']))){ ?>
	<div class="login">
              <div class="title">Успешно најавен</div>
                <div class="forms">
                
                  <table width="100%" border="0" cellspacing="0">
              		<tr>
                        <td colspan="2">Добредојде,  <?php if(isset($_SESSION['MM_Name'])) echo $_SESSION['MM_Name']; ?></td>
                    </tr>
                      <tr>
                        <td></td>
                        <td align="right">[<a href="<?php echo $logoutAction ?>">Одјави се</a> ]</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right">&nbsp;</td>
                      </tr>
                    </table>
                    <br />
	</div>
</div>

<?php } ?>

