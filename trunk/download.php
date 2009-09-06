<?php require_once('Connections/pravo.php'); ?>
<?php include('util/misc.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "user,admin";
$MM_donotCheckaccess = "true";



$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
  $MM_referrer .= "?" . $QUERY_STRING;
  $http_referrer = "";
  if (isset($_SERVER['HTTP_REFERER'])) {
  	$http_referrer = $_SERVER['HTTP_REFERER'];
  }
  //remove 'pravo.org.mk' from the accesscheck string
  $http_referrer_array = explode('/', $http_referrer);
  $http_referrer_array_count = count($http_referrer_array);
  if ($http_referrer_array_count > 1) {
	  if ($http_referrer_array[$http_referrer_array_count - 2] == 'admin') {
		  $http_referrer = 'admin/' . $http_referrer_array[$http_referrer_array_count - 1];
	  } else {
	  	$http_referrer = $http_referrer_array[$http_referrer_array_count - 1];
	  }
  }
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($http_referrer);
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
$query_recordset_document = sprintf("SELECT id_document, id_doc_type, filename, title, mimetype FROM `document` WHERE id_document = %s", GetSQLValueString($colname_recordset_document, "int"));
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
		if (!mysql_query(sprintf("INSERT INTO download (id_document, id_user, downloaded_date) VALUES (%s, %s, %s)", GetSQLValueString($row_recordset_document['id_document'], "int"), GetSQLValueString($_SESSION['MM_ID'], "int"), GetSQLValueString(date('Y-m-d H:i'), "date"))) || !mysql_query(sprintf("UPDATE document SET no_downloads = no_downloads + 1 WHERE id_document = %s", $row_recordset_document['id_document'])))
			die('Problem so registracijata na simnuvanjeto: ' . mysql_error());
		
		ob_start();
		header('Content-type: '.$row_recordset_document['mimetype']);
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
		
		mysql_close($pravo);
		exit;
		exit();
	} else {
		die('Problem so otvoranje na patekata: ' . $path);
	}
} else {
	die('Nepoznat dokument.');
}

?>
