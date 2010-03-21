<?php

// *** Validate request to login to this site.
/* if (!isset($_SESSION)) {
session_start();
} 
 */
$selfArray = explode('/',$_SERVER['PHP_SELF']);
$phpSelfAdaptation = $selfArray[count($selfArray)-1];
$loginFormAction = $phpSelfAdaptation.($_SERVER['QUERY_STRING'] != '' ? "?".$_SERVER['QUERY_STRING'] : '');
/*if (isset($_GET['accesscheck']) && isset($_SERVER['HTTP_REFERER'])) {
  $_SESSION['PrevUrl'] = $_SERVER['HTTP_REFERER'];//$_GET['accesscheck'];
}*/

if (isset($_POST['username_login'])) {
  $count = 0;
  $loginUsername=$_POST['username_login'];
  $password=$_POST['password_login'];
  $MM_fldUserAuthorization = "id_user";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_pravo, $pravo);
  
  $LoginRS_query=sprintf("SELECT username, password, id_user, name, surname FROM `user` WHERE username=%s AND password=password(%s) AND is_approved = 1 AND (deleted!=1 OR deleted is null)",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS_query, $pravo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
	
	$loginStrName = mysql_result($LoginRS,0,'name');
	$loginStrSurname  = mysql_result($LoginRS,0,'surname');
	$id_user = mysql_result($LoginRS,0,'id_user');
	
	$Group_query = sprintf("select uc.name from user u, user_category uc "
    . "where u.id_user_category = uc.id_user_category "
    . "and u.id_user = %s ",$id_user);
	
	$loginResult = mysql_query($Group_query, $pravo) or die(mysql_error());
   
	$loginStrGroup  = mysql_result($loginResult,0,'name');
	$now = date("Y-m-d H:i:s");
	$Update_query = sprintf("UPDATE user SET last_login_date = %s where id_user = %s",
							"'".$now."'", 
							GetSQLValueString($id_user, "int") );
	mysql_query($Update_query, $pravo) or die(mysql_error());
	//echo $id_user."\n";
	//print_r( $loginStrGroup);
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	
	$_SESSION['MM_Name'] = $loginStrName." ".$loginStrSurname;
	$_SESSION['MM_ID'] = $id_user;
	
	/* if($_SERVER['PHP_SELF']=='register.php'){
		$tmp = isset($_SESSION['MM_ID']) ? $_SESSION['MM_ID'] : 0; 
		$_SESSION['MM_ID_TMP'] = $tmp;
		unset($_SESSION['MM_ID']);
		echo $_SESSION['MM_ID'];
		echo $_SERVER['PHP_SELF'];
	} */
    /*if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }*/
	if($_SERVER['QUERY_STRING']!=""){
		$MM_redirectLoginSuccess=$phpSelfAdaptation."?".$_SERVER['QUERY_STRING'];
		//header("Location: " . $MM_redirectLoginSuccess );
		//echo $MM_redirectLoginSuccess;
		echo "<script>document.location.href='../".$MM_redirectLoginSuccess."'</script>";
		echo "<script>'Content-type: application/octet-stream'</script>";
	} else {
		$MM_redirectLoginSuccess=$phpSelfAdaptation;
		//echo $MM_redirectLoginSuccess;
		//header("Location: " . $MM_redirectLoginSuccess );
		echo "<script>document.location.href='../".$MM_redirectLoginSuccess."'</script>";
		echo "<script>'Content-type: application/octet-stream'</script>";
	}
  }
  else {
	  $LoginRS_query=sprintf("SELECT username FROM `user` WHERE username=%s AND password=password(%s) AND is_approved = 0 AND (deleted!=1 OR deleted is null)",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
  $LoginRS = mysql_query($LoginRS_query, $pravo) or die(mysql_error());
  $loginUserNotActivated = mysql_num_rows($LoginRS);
  
   // header("Location: ". $MM_redirectLoginFailed );
   $count = $count + 1;
   //echo $count;
  }
}
?>