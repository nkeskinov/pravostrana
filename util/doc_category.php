<?php
$colname_Recordset1 = "1";
if (isset($_POST['id_doc_type'])) {
  $colname_Recordset1 = $_POST['id_doc_type'];
}
mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = sprintf("SELECT * FROM doc_group WHERE id_doc_type = %s ORDER BY name ASC", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$tmp_number=0;
?>
<table border="0" cellspacing="0" cellpadding="2px">
  <?php do { ?>
    <tr onmouseover="this.className='on'" onmouseout="this.className='off'">
      <td style="border-bottom:1px dotted #CCC;"><a href="?id_doc_group=<?php echo $row_Recordset1['id_doc_group']; ?>"><strong><?php echo $row_Recordset1['name']; ?></strong></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<?php
mysql_free_result($Recordset1);
?>
