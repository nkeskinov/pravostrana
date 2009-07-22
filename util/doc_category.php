<?php
//$id_doc_type = "1";
if (isset($_POST['id_doc_type'])) {
  $colname_Recordset1 = $_POST['id_doc_type'];
}
mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = sprintf("SELECT * FROM doc_group WHERE id_doc_type = %s AND id_supergroup is NULL ORDER BY name ASC", GetSQLValueString($id_doc_type_Documents, "int"));
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$tmp_number=0;
?>
<table border="0" cellspacing="0" cellpadding="2px" width="100%">
  <tr onmouseover="this.className='on'" onmouseout="this.className='off'">
      <td style="border-bottom:1px dotted #CCC;">&raquo; <a href="<?php echo $page; ?>">Сите</a></td>
    </tr>
  <?php do { ?>
    <tr onmouseover="this.className='on'" onmouseout="this.className='off'">
      <td style="border-bottom:1px dotted #CCC;">&raquo; <a href="?id_doc_group=<?php echo $row_Recordset1['id_doc_group']; ?>"><?php echo $row_Recordset1['name']; ?></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<?php
mysql_free_result($Recordset1);
?>
