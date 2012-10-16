<?php require_once('Connections/pravo.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO `document` (id_document, id_doc_type, filename, title, uploaded_date, id_doc_meta, id_doc_group, `description`, extension, filesize, mimetype, forcesubscribe, published_date, id_superdoc, created_by) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_document'], "int"),
                       GetSQLValueString($_POST['id_doc_type'], "int"),
                       GetSQLValueString($_POST['filename'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       //GetSQLValueString($_POST['uploaded_date'], "date"),
					   //current date (GoDaddy "now" date is a different timezone)
					   GetSQLValueString(date('Y-m-d H:i'), "date"),
                       GetSQLValueString($_POST['id_doc_meta'], "int"),
                       GetSQLValueString($_POST['id_doc_group'], "int"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['extension'], "text"),
                       GetSQLValueString($_POST['filesize'], "int"),
                       GetSQLValueString($_POST['mimetype'], "text"),
                       GetSQLValueString(isset($_POST['forcesubscribe']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['published_date'], "date"),
                       GetSQLValueString($_POST['id_superdoc'], "int"),
                       GetSQLValueString($_POST['created_by'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE `document` SET id_doc_type=%s, filename=%s, title=%s, uploaded_date=%s, id_doc_meta=%s, id_doc_group=%s, `description`=%s, extension=%s, filesize=%s, mimetype=%s, forcesubscribe=%s, published_date=%s, id_superdoc=%s, created_by=%s WHERE id_document=%s",
                       GetSQLValueString($_POST['id_doc_type'], "int"),
                       GetSQLValueString($_POST['filename'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['uploaded_date'], "date"),
                       GetSQLValueString($_POST['id_doc_meta'], "int"),
                       GetSQLValueString($_POST['id_doc_group'], "int"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['extension'], "text"),
                       GetSQLValueString($_POST['filesize'], "int"),
                       GetSQLValueString($_POST['mimetype'], "text"),
                       GetSQLValueString(isset($_POST['forcesubscribe']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['published_date'], "date"),
                       GetSQLValueString($_POST['id_superdoc'], "int"),
                       GetSQLValueString($_POST['created_by'], "int"),
                       GetSQLValueString($_POST['id_document'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
}

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = "SELECT * FROM `document`";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

mysql_select_db($database_pravo, $pravo);
$query_Recordset2 = "SELECT * FROM `document`";
$Recordset2 = mysql_query($query_Recordset2, $pravo) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="First.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="Previous.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="Next.gif" /></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="Last.gif" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_document:</td>
      <td><input type="text" name="id_document" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_doc_type:</td>
      <td><input type="text" name="id_doc_type" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Filename:</td>
      <td><input type="text" name="filename" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Title:</td>
      <td><input type="text" name="title" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Uploaded_date:</td>
      <td><input type="text" name="uploaded_date" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_doc_meta:</td>
      <td><input type="text" name="id_doc_meta" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_doc_group:</td>
      <td><input type="text" name="id_doc_group" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Description:</td>
      <td><input type="text" name="description" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Extension:</td>
      <td><input type="text" name="extension" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Filesize:</td>
      <td><input type="text" name="filesize" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mimetype:</td>
      <td><input type="text" name="mimetype" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Forcesubscribe:</td>
      <td><input type="checkbox" name="forcesubscribe" value="" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Published_date:</td>
      <td><input type="text" name="published_date" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_superdoc:</td>
      <td><input type="text" name="id_superdoc" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Created_by:</td>
      <td><input type="text" name="created_by" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_document:</td>
      <td><?php echo $row_Recordset2['id_document']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_doc_type:</td>
      <td><input type="text" name="id_doc_type" value="<?php echo htmlentities($row_Recordset2['id_doc_type'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Filename:</td>
      <td><input type="text" name="filename" value="<?php echo htmlentities($row_Recordset2['filename'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Title:</td>
      <td><input type="text" name="title" value="<?php echo htmlentities($row_Recordset2['title'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Uploaded_date:</td>
      <td><input type="text" name="uploaded_date" value="<?php echo htmlentities($row_Recordset2['uploaded_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_doc_meta:</td>
      <td><input type="text" name="id_doc_meta" value="<?php echo htmlentities($row_Recordset2['id_doc_meta'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_doc_group:</td>
      <td><input type="text" name="id_doc_group" value="<?php echo htmlentities($row_Recordset2['id_doc_group'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Description:</td>
      <td><input type="text" name="description" value="<?php echo htmlentities($row_Recordset2['description'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Extension:</td>
      <td><input type="text" name="extension" value="<?php echo htmlentities($row_Recordset2['extension'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Filesize:</td>
      <td><input type="text" name="filesize" value="<?php echo htmlentities($row_Recordset2['filesize'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mimetype:</td>
      <td><input type="text" name="mimetype" value="<?php echo htmlentities($row_Recordset2['mimetype'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Forcesubscribe:</td>
      <td><input type="checkbox" name="forcesubscribe" value=""  <?php if (!(strcmp(htmlentities($row_Recordset2['forcesubscribe'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Published_date:</td>
      <td><input type="text" name="published_date" value="<?php echo htmlentities($row_Recordset2['published_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_superdoc:</td>
      <td><input type="text" name="id_superdoc" value="<?php echo htmlentities($row_Recordset2['id_superdoc'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Created_by:</td>
      <td><input type="text" name="created_by" value="<?php echo htmlentities($row_Recordset2['created_by'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="id_document" value="<?php echo $row_Recordset2['id_document']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
