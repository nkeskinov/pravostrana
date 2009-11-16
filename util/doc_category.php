<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/treeview/assets/skins/sam/treeview.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/treeview/treeview-min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="YUI/2.6.0/build/treeview/assets/skins/sam/css/folders/tree.css" /> 
<?php
//$id_doc_type = "1";
if (isset($_POST['id_doc_type'])) {
  $colname_Recordset1 = $_POST['id_doc_type'];
}

mysql_select_db($database_pravo, $pravo);
$query_Recordset1 = sprintf("SELECT * FROM doc_group WHERE id_doc_type = %s AND id_supergroup is NULL ORDER BY id_doc_group ASC", GetSQLValueString($id_doc_type_Documents, "int"));
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$tmp_number=0;

$id_doc_group = isset($_GET['id_doc_group']) ? $_GET['id_doc_group'] : "";

?>

<?php function subCategory($id_category,$id_doc_type_Documents,$database_pravo, $pravo, $selected_doc_group){
	mysql_select_db($database_pravo, $pravo);
	$query_Recordset2 = sprintf("SELECT * FROM doc_group WHERE id_doc_type = %s AND id_supergroup=%s ORDER BY id_doc_group ASC", GetSQLValueString($id_doc_type_Documents, "int"),
	GetSQLValueString($id_category, "int")
);
	$Recordset2 = mysql_query($query_Recordset2, $pravo) or die(mysql_error());
	$row_Recordset2 = mysql_fetch_assoc($Recordset2);
	$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	
	
	if($totalRows_Recordset2>0){
	do{ ?>
		<li<?php echo ($row_Recordset2['id_doc_group'] == $selected_doc_group ? ' class="expanded"' : ''); ?>><a href="?id_doc_group=<?php echo $row_Recordset2['id_doc_group']; ?>"><?php echo $row_Recordset2['name']; ?></a>
        	<ul><?php subCategory($row_Recordset2['id_doc_group'],$id_doc_type_Documents,$database_pravo, $pravo, $selected_doc_group); ?></ul>
        </li>
	<?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	return 1;
	}}
?>
<?php /*?><table border="0" cellspacing="0" cellpadding="2px" width="100%">
  <tr onmouseover="this.className='on'" onmouseout="this.className='off'">
      <td style="border-bottom:1px dotted #CCC;">&raquo; <a href="<?php echo $page; ?>">Сите</a></td>
    </tr>
  <?php do { ?>
    <tr onmouseover="this.className='on'" onmouseout="this.className='off'">
      <td style="border-bottom:1px dotted #CCC;">&raquo; <a href="?id_doc_group=<?php echo $row_Recordset1['id_doc_group']; ?>"><?php echo $row_Recordset1['name']; ?></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table><?php */?>
<div id="yuitree1" style="width:186px;">
  <ul>
 <?php do { ?>
 <li<?php echo ($row_Recordset1['id_doc_group'] == $id_doc_group ? ' class="expanded"' : ''); ?>><a href="?id_doc_group=<?php echo $row_Recordset1['id_doc_group']; ?>"><?php echo $row_Recordset1['name']; ?></a> 
 	<ul><?php subCategory($row_Recordset1['id_doc_group'],$id_doc_type_Documents,$database_pravo, $pravo, $id_doc_group); ?></ul>
  </li>
 <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
 </ul>
 </div>
<?php
mysql_free_result($Recordset1);
?>
<script type="text/javascript">
// BeginWebWidget YUI_TreeView: yuitree1 
 
    var yuitree1 = new YAHOO.widget.TreeView("yuitree1");
    yuitree1.render();
    

// EndWebWidget YUI_TreeView: yuitree1 
</script>