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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE `document` SET title=%s, published_date=%s, `description`=%s, id_doc_type=%s, id_doc_group=%s, filename=%s, forcesubscribe=%s, id_superdoc=%s WHERE id_document=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['published_date'], "date"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['id_doc_type'], "int"),
                       GetSQLValueString($_POST['id_doc_group'], "int"),
                       GetSQLValueString($_POST['filename'], "text"),
                       GetSQLValueString(isset($_POST['forcesubscribe']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_superdoc'], "int"),
                       GetSQLValueString($_POST['id_document'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
}


$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = sprintf("SELECT * FROM `document` WHERE id_document = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_pravo, $pravo);
$query_DocumentGroups = "SELECT * FROM doc_group";
$DocumentGroups = mysql_query($query_DocumentGroups, $pravo) or die(mysql_error());
$row_DocumentGroups = mysql_fetch_assoc($DocumentGroups);
$totalRows_DocumentGroups = mysql_num_rows($DocumentGroups);

mysql_select_db($database_pravo, $pravo);
$query_DocumentTypes = "SELECT * FROM doc_type";
$DocumentTypes = mysql_query($query_DocumentTypes, $pravo) or die(mysql_error());
$row_DocumentTypes = mysql_fetch_assoc($DocumentTypes);
$totalRows_DocumentTypes = mysql_num_rows($DocumentTypes);


?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="100%" align="center">
    <tr valign="baseline">
      <td nowrap align="right">Име на документот:</td>
      <td><input type="text" name="title" value="<?php echo htmlentities($row_Recordset1['title'], ENT_COMPAT, 'UTF-8'); ?>" size="50"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Дата на публикување:</td>
      <td><input type="text" name="published_date" id="published_date" value="<?php echo htmlentities($row_Recordset1['published_date'], ENT_COMPAT, ''); ?>"  readonly="1" >
 <img src="../javaScripts/jscalendar/img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Краток опис:</td>
      <td><textarea name="description" cols="40" rows="5"><?php echo htmlentities($row_Recordset1['description'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Тип на документот:</td>
      <td><select name="id_doc_type">
        <?php 
do {  
?>
        <option value="<?php echo $row_DocumentTypes['id_doc_type']?>" <?php if (!(strcmp($row_DocumentTypes['id_doc_type'], htmlentities($row_Recordset1['id_doc_type'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_DocumentTypes['name']?></option>
        <?php
} while ($row_DocumentTypes = mysql_fetch_assoc($DocumentTypes));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">Група:</td>
      <td><select name="id_doc_group">
        <?php 
do {  
?>
        <option value="<?php echo $row_DocumentGroups['id_doc_group']?>" <?php if (!(strcmp($row_DocumentGroups['id_doc_group'], htmlentities($row_Recordset1['id_doc_group'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_DocumentGroups['name']?></option>
        <?php
} while ($row_DocumentGroups = mysql_fetch_assoc($DocumentGroups));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td rowspan="2" align="right" valign="top" nowrap>Документ:</td>
      <td><a href="download.php?id=<?php echo $row_Recordset1['id_document']; ?> "><img src="../images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a></td>
    </tr>
    <tr valign="baseline">
      <td><input type="text" name="filename" value="<?php echo htmlentities($row_Recordset1['filename'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Форсирај претплата:</td>
      <td><input type="text" name="forcesubscribe" value="<?php echo htmlentities($row_Recordset1['forcesubscribe'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Id_superdoc:</td>
      <td><input type="text" name="id_superdoc" value="<?php echo htmlentities($row_Recordset1['id_superdoc'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Измени"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_document" value="<?php echo $row_Recordset1['id_document']; ?>">
</form>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "published_date",     // id of the input field
        ifFormat       :    "%d.%m.%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);

mysql_free_result($DocumentGroups);

mysql_free_result($DocumentTypes);
?>