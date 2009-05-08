<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username_login'])) {
  $count = 0;
  $loginUsername=$_POST['username_login'];
  $password=$_POST['password_login'];
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
	

	$Update_query = sprintf("UPDATE user SET last_login_date = now() where id_user = %s",GetSQLValueString($id_user, "int") );
	mysql_query($Update_query, $pravo) or die(mysql_error());
	//echo $id_user."\n";
	//print_r( $loginStrGroup);
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	
	$_SESSION['MM_Name'] = $loginStrName." ".$loginStrSurname;
	$_SESSION['MM_ID'] = $id_user;
	
	/* if($_SERVER['PHP_SELF']=='/pravo.org.mk/register.php'){
		$tmp = isset($_SESSION['MM_ID']) ? $_SESSION['MM_ID'] : 0; 
		$_SESSION['MM_ID_TMP'] = $tmp;
		unset($_SESSION['MM_ID']);
		echo $_SESSION['MM_ID'];
		echo $_SERVER['PHP_SELF'];
	} */
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
   // header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
   // header("Location: ". $MM_redirectLoginFailed );
   $count = $count + 1;
   echo $count;
  }
}
?>