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
mysql_select_db($database_pravo, $pravo);
$query_DocumentType = "SELECT * FROM doc_type";
$DocumentType = mysql_query($query_DocumentType, $pravo) or die(mysql_error());
$row_DocumentType = mysql_fetch_assoc($DocumentType);
$totalRows_DocumentType = mysql_num_rows($DocumentType);

$colname_DocumentTypeEdit = "-1";
if (isset($_GET['id'])) {
  $colname_DocumentTypeEdit = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_DocumentTypeEdit = sprintf("SELECT * FROM doc_type WHERE id_doc_type = %s", GetSQLValueString($colname_DocumentTypeEdit, "int"));
$DocumentTypeEdit = mysql_query($query_DocumentTypeEdit, $pravo) or die(mysql_error());
$row_DocumentTypeEdit = mysql_fetch_assoc($DocumentTypeEdit);
$totalRows_DocumentTypeEdit = mysql_num_rows($DocumentTypeEdit);
//print_r($row_DocumentTypeEdit);
?>



<div align="left" style="height:22px; width:99%; border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table cellpadding="0" cellspacing="0">
  <tr></tr>
  <tr>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="document_category.php?mode=new"><img src="../images/new.png" border="0" title="Нов документ" /></a></div></td>
    <?php if(isset($_GET['mode']) && (($_GET['mode']=="edit") || ($_GET['mode']=="new"))){ ?>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/save.png" border="0" title="Зачувај документ" /></a></div></td>
    <td>
    <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="document_category.php?id=<?php echo $row_RecordsetDocCategoryEdit['id_doc_group']; ?>&mode=delete" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="../images/delete.png" border="0" title="Бриши"  /></a></div>
    </td>
    <?php } ?>
    <td><div style="width:26px; height:21px; padding-top:1.5px; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/print.png" border="0" title="Печати страна" /></a></div></td>
  </tr>
  </table>
</div>
   <br />

<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO doc_type (name, directory) VALUES (%s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['directory'], "text"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
  if($Result1){
	_show_message_color('Категоријата е успешно изменета!','GREEN');
	if(isset($_GET['url']))
		$MM_redirectLoginSuccess=$_GET['url'];
	else
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";
  }
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE doc_type SET name=%s, directory=%s WHERE id_doc_type=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['directory'], "text"),
                       GetSQLValueString($_POST['id_doc_type'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
  if($Result1){
	_show_message_color('Категоријата е успешно изменета!','GREEN');
	if(isset($_GET['url']))
		$MM_redirectLoginSuccess=$_GET['url'];
	else
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";
  }
}

if ((isset($_GET['id'])) && ($_GET['id'] != "") && (isset($_GET['mode'])) && ($_GET['mode']=="delete")) {
  $deleteSQL = sprintf("DELETE FROM doc_type WHERE id_doc_group=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_pravo, $pravo);
  if($Result1){
	_show_message_color('Категоријата е успешно изменета!','GREEN');
	if(isset($_GET['url']))
		$MM_redirectLoginSuccess=$_GET['url'];
	else
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";
  }
}
?>



<?php if(isset($_GET['mode']) && (($_GET['mode']=="edit") || ($_GET['mode']=="new"))){ ?>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center" width="100%">
    <tr valign="baseline">
      <td nowrap align="right">Име:</td>
      <td><input type="text" name="name" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_DocumentTypeEdit['name'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Директориум:</td>
      <td><input type="text" name="directory" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_DocumentTypeEdit['directory'], ENT_COMPAT, 'UTF-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>
      <?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) { ?>
      	<input type="submit" value="Измени">
        <input type="hidden" name="MM_update" value="form2">
      <?php }else{ ?>
      	<input type="hidden" name="MM_insert" value="form2">
      	<input type="submit" value="Зачувај">
      <?php } ?>
      <a href="<?php echo $_GET['url']; ?>">Откажи</a>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id_doc_type" value="<?php echo $row_DocumentTypeEdit['id_doc_type']; ?>">
</form>
<?php }else{ ?>
<table border="0" width="100%">
  <tr style="background:url(../images/yellow-title-middle.png);">
    <td colspan="2">Акција</td>
    <td>Име</td>
    <td>Директориум</td>
  </tr>
  <?php $i=0; do { ?>
    <tr <?php if($i%2==0) echo "style='background:#fbf7e0'" ?>>
      <td width="16"><a href="document_type.php?id=<?php echo $row_DocumentType['id_doc_type']; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a></td>
      <td width="16"><a href="document_type.php?id=<?php echo $row_DocumentType['id_doc_type']; ?>&mode=delete&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="../images/cross.png" border="0" /></a></td>
      <td><?php echo $row_DocumentType['name']; ?></td>
      <td><?php echo $row_DocumentType['directory']; ?></td>
    </tr>
    <?php $i++;} while ($row_DocumentType = mysql_fetch_assoc($DocumentType)); ?>
</table>
<?php } ?>
<?php
mysql_free_result($DocumentType);

mysql_free_result($DocumentTypeEdit);
?>
