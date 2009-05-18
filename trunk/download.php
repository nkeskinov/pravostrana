<?php require_once('Connections/pravo.php'); ?>
<?php include('util/misc.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "user";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
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
$colname_recordset_document = "-1";
if (isset($_GET['id'])) {
  $colname_recordset_document = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_recordset_document = sprintf("SELECT id_document, id_doc_type, filename, title FROM `document` WHERE id_document = %s", GetSQLValueString($colname_recordset_document, "int"));
$recordset_document = mysql_query($query_recordset_document, $pravo) or die(mysql_error());
$row_recordset_document = mysql_fetch_assoc($recordset_document);
$totalRows_recordset_document = mysql_num_rows($recordset_document);

$path = 'download/';

if ($totalRows_recordset_document == 1) {
	$id_doc_type = $row_recordset_document['id_doc_type'];
	$query_recordset_doc_type = sprintf("SELECT directory FROM doc_type WHERE id_doc_type = %s", GetSQLValueString($id_doc_type, "int"));
	$recordset_doc_type = mysql_query($query_recordset_doc_type, $pravo) or die(mysql_error());
	$row_recordset_doc_type = mysql_fetch_assoc($recordset_doc_type);
	$totalRows_recordset_doc_type = mysql_num_rows($recordset_doc_type);
	$path .= $row_recordset_doc_type['directory'] . '/' . $row_recordset_document['filename'];
	$file_size = filesize($path);
	
	if ($fp = fopen ($path, "r")) {
		ob_start();
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$row_recordset_document['filename'].'"');
		header('Content-length: '.$file_size);
		ob_end_flush();
	 
		while(!feof($fp)) {
			$file_buffer = fread($fp, 2048);
			echo $file_buffer;
		}
	
		fclose($fp);
		mysql_free_result($recordset_document);
		mysql_free_result($recordset_doc_type);

		exit;
		exit();
	}
}

?>
