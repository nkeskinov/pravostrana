<?php require_once('Connections/pravo.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "user";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO `user` (id_user, username, password, name, surname, occupation, e-mail, organization, date_of_birth, sex, address, city, country, phone, is_locked_out, create_date, last_login_date, last_password_changed_date, password_question, password_answer, is_approved, delated, last_lockout_date, failed_password_attempt_count, failed_password_attempt_window_start, failed_password_answer_attempt_count, failed_password_answer_attempt_window_start) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_user'], "int"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['organization'], "text"),
                       GetSQLValueString($_POST['date_of_birth'], "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString(isset($_POST['is_locked_out']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['create_date'], "date"),
                       GetSQLValueString($_POST['last_login_date'], "date"),
                       GetSQLValueString($_POST['last_password_changed_date'], "date"),
                       GetSQLValueString($_POST['password_question'], "text"),
                       GetSQLValueString($_POST['password_answer'], "text"),
                       GetSQLValueString($_POST['is_approved'], "int"),
                       GetSQLValueString($_POST['delated'], "int"),
                       GetSQLValueString($_POST['last_lockout_date'], "date"),
                       GetSQLValueString($_POST['failed_password_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_window_start'], "date"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE `user` SET username=%s, password=%s, name=%s, surname=%s, occupation=%s, e-mail=%s, organization=%s, date_of_birth=%s, sex=%s, address=%s, city=%s, country=%s, phone=%s, is_locked_out=%s, create_date=%s, last_login_date=%s, last_password_changed_date=%s, password_question=%s, password_answer=%s, is_approved=%s, delated=%s, last_lockout_date=%s, failed_password_attempt_count=%s, failed_password_attempt_window_start=%s, failed_password_answer_attempt_count=%s, failed_password_answer_attempt_window_start=%s WHERE id_user=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['organization'], "text"),
                       GetSQLValueString($_POST['date_of_birth'], "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['is_locked_out'], "int"),
                       GetSQLValueString($_POST['create_date'], "date"),
                       GetSQLValueString($_POST['last_login_date'], "date"),
                       GetSQLValueString($_POST['last_password_changed_date'], "date"),
                       GetSQLValueString($_POST['password_question'], "text"),
                       GetSQLValueString($_POST['password_answer'], "text"),
                       GetSQLValueString($_POST['is_approved'], "int"),
                       GetSQLValueString($_POST['delated'], "int"),
                       GetSQLValueString($_POST['last_lockout_date'], "date"),
                       GetSQLValueString($_POST['failed_password_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['id_user'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
  $updateSQL = sprintf("UPDATE `user` SET username=%s, password=%s, name=%s, surname=%s, occupation=%s, email=%s, organization=%s, date_of_birth=%s, sex=%s, address=%s, city=%s, country=%s, phone=%s, is_locked_out=%s, create_date=%s, last_login_date=%s, last_password_changed_date=%s, password_question=%s, password_answer=%s, is_approved=%s, delated=%s, last_lockout_date=%s, failed_password_attempt_count=%s, failed_password_attempt_window_start=%s, failed_password_answer_attempt_count=%s, failed_password_answer_attempt_window_start=%s WHERE id_user=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['organization'], "text"),
                       GetSQLValueString($_POST['date_of_birth'], "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['is_locked_out'], "int"),
                       GetSQLValueString($_POST['create_date'], "date"),
                       GetSQLValueString($_POST['last_login_date'], "date"),
                       GetSQLValueString($_POST['last_password_changed_date'], "date"),
                       GetSQLValueString($_POST['password_question'], "text"),
                       GetSQLValueString($_POST['password_answer'], "text"),
                       GetSQLValueString(isset($_POST['is_approved']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['delated'], "int"),
                       GetSQLValueString($_POST['last_lockout_date'], "date"),
                       GetSQLValueString($_POST['failed_password_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['id_user'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE `user` SET username=%s, password=%s, name=%s, surname=%s, occupation=%s, email=%s, organization=%s, date_of_birth=%s, sex=%s, address=%s, city=%s, country=%s, phone=%s, is_locked_out=%s, create_date=%s, last_login_date=%s, last_password_changed_date=%s, password_question=%s, password_answer=%s, is_approved=%s, deleted=%s, last_lockout_date=%s, failed_password_attempt_count=%s, failed_password_attempt_window_start=%s, failed_password_answer_attempt_count=%s, failed_password_answer_attempt_window_start=%s WHERE id_user=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['organization'], "text"),
                       GetSQLValueString($_POST['date_of_birth'], "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['is_locked_out'], "int"),
                       GetSQLValueString($_POST['create_date'], "date"),
                       GetSQLValueString($_POST['last_login_date'], "date"),
                       GetSQLValueString($_POST['last_password_changed_date'], "date"),
                       GetSQLValueString($_POST['password_question'], "text"),
                       GetSQLValueString($_POST['password_answer'], "text"),
                       GetSQLValueString($_POST['is_approved'], "int"),
                       GetSQLValueString($_POST['deleted'], "int"),
                       GetSQLValueString($_POST['last_lockout_date'], "date"),
                       GetSQLValueString($_POST['failed_password_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['id_user'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO `user` (id_user, username, password, name, surname, occupation, email, organization, date_of_birth, sex, address, city, country, phone, is_locked_out, create_date, last_login_date, last_password_changed_date, password_question, password_answer, is_approved, delated, last_lockout_date, failed_password_attempt_count, failed_password_attempt_window_start, failed_password_answer_attempt_count, failed_password_answer_attempt_window_start) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_user'], "int"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['occupation'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['organization'], "text"),
                       GetSQLValueString($_POST['date_of_birth'], "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['is_locked_out'], "int"),
                       GetSQLValueString($_POST['create_date'], "date"),
                       GetSQLValueString($_POST['last_login_date'], "date"),
                       GetSQLValueString($_POST['last_password_changed_date'], "date"),
                       GetSQLValueString($_POST['password_question'], "text"),
                       GetSQLValueString($_POST['password_answer'], "text"),
                       GetSQLValueString(isset($_POST['is_approved']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['delated'], "int"),
                       GetSQLValueString($_POST['last_lockout_date'], "date"),
                       GetSQLValueString($_POST['failed_password_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_attempt_window_start'], "date"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_count'], "int"),
                       GetSQLValueString($_POST['failed_password_answer_attempt_window_start'], "date"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
}

mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = "SELECT * FROM `user`";
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_user:</td>
      <td><?php echo $row_Recordset1['id_user']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Username:</td>
      <td><input type="text" name="username" value="<?php echo htmlentities($row_Recordset1['username'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo htmlentities($row_Recordset1['password'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Name:</td>
      <td><input type="text" name="name" value="<?php echo htmlentities($row_Recordset1['name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Surname:</td>
      <td><input type="text" name="surname" value="<?php echo htmlentities($row_Recordset1['surname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Occupation:</td>
      <td><input type="text" name="occupation" value="<?php echo htmlentities($row_Recordset1['occupation'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Organization:</td>
      <td><input type="text" name="organization" value="<?php echo htmlentities($row_Recordset1['organization'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date_of_birth:</td>
      <td><input type="text" name="date_of_birth" value="<?php echo htmlentities($row_Recordset1['date_of_birth'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sex:</td>
      <td><input type="text" name="sex" value="<?php echo htmlentities($row_Recordset1['sex'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Address:</td>
      <td><input type="text" name="address" value="<?php echo htmlentities($row_Recordset1['address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><input type="text" name="city" value="<?php echo htmlentities($row_Recordset1['city'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Country:</td>
      <td><input type="text" name="country" value="<?php echo htmlentities($row_Recordset1['country'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phone:</td>
      <td><input type="text" name="phone" value="<?php echo htmlentities($row_Recordset1['phone'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Is_locked_out:</td>
      <td><input type="text" name="is_locked_out" value="<?php echo htmlentities($row_Recordset1['is_locked_out'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Create_date:</td>
      <td><input type="text" name="create_date" value="<?php echo htmlentities($row_Recordset1['create_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last_login_date:</td>
      <td><input type="text" name="last_login_date" value="<?php echo htmlentities($row_Recordset1['last_login_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last_password_changed_date:</td>
      <td><input type="text" name="last_password_changed_date" value="<?php echo htmlentities($row_Recordset1['last_password_changed_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password_question:</td>
      <td><input type="text" name="password_question" value="<?php echo htmlentities($row_Recordset1['password_question'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password_answer:</td>
      <td><input type="text" name="password_answer" value="<?php echo htmlentities($row_Recordset1['password_answer'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Is_approved:</td>
      <td><input type="text" name="is_approved" value="<?php echo htmlentities($row_Recordset1['is_approved'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Deleted:</td>
      <td><input type="text" name="deleted" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last_lockout_date:</td>
      <td><input type="text" name="last_lockout_date" value="<?php echo htmlentities($row_Recordset1['last_lockout_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Failed_password_attempt_count:</td>
      <td><input type="text" name="failed_password_attempt_count" value="<?php echo htmlentities($row_Recordset1['failed_password_attempt_count'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Failed_password_attempt_window_start:</td>
      <td><input type="text" name="failed_password_attempt_window_start" value="<?php echo htmlentities($row_Recordset1['failed_password_attempt_window_start'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Failed_password_answer_attempt_count:</td>
      <td><input type="text" name="failed_password_answer_attempt_count" value="<?php echo htmlentities($row_Recordset1['failed_password_answer_attempt_count'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Failed_password_answer_attempt_window_start:</td>
      <td><input type="text" name="failed_password_answer_attempt_window_start" value="<?php echo htmlentities($row_Recordset1['failed_password_answer_attempt_window_start'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_user" value="<?php echo $row_Recordset1['id_user']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
