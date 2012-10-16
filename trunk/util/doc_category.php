<link href="YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="YUI/2.6.0/build/treeview/assets/skins/sam/treeview.css" rel="stylesheet" type="text/css" />
<script src="YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="YUI/2.6.0/build/treeview/treeview-min.js" type="text/javascript"></script>
<?php
mysql_select_db($database_pravo, $pravo);
$selected_id_doc_group = isset($_GET['id_doc_group']) ? $_GET['id_doc_group'] : '';
?>
<?php
function categorize($id_doc_type_Documents, $id_doc_group, $pravo, $recursion_level) {
		$query_Recordset = sprintf("SELECT * FROM doc_group WHERE id_doc_type = %s AND id_supergroup %s %s ORDER BY id_doc_group ASC", GetSQLValueString($id_doc_type_Documents, "int"),
 $id_doc_group == NULL || $id_doc_group == '' ? 'IS' : '=',																																					 GetSQLValueString($id_doc_group, "int"));
		$Recordset = mysql_query($query_Recordset, $pravo) or die(mysql_error());
		//$row_Recordset = mysql_fetch_assoc($Recordset);
		$totalRows_Recordset = mysql_num_rows($Recordset);
		$char_limits = array(27, 22, 17);

	while ($row_Recordset = mysql_fetch_assoc($Recordset)) {
		$category_id = $row_Recordset['id_doc_group'];
		$category_name = $row_Recordset['name'];
 		$category_array = explode(' ', $category_name);
 		$category_short_name = '';
 		$category_short_name_size = 0;
 		for ($i = 0; $i < count($category_array); $i++) {
	 		$current_word = $category_array[$i];
	 		$category_short_name_size += mb_strlen($current_word, 'UTF-8');
	 		if ($category_short_name_size + 3 > $char_limits[$recursion_level]) {
		 		$category_short_name .= '...';
				break;
	 		} else {
		 		$category_short_name .= ($category_short_name == '' ? '' : ' ').$current_word;
		 		$category_short_name_size++;
	 		}
 		}
		echo 'var o'.$category_id.' = {
			label: "'.$category_short_name.'",
			title: "'.$category_name.'",
			href: "?id_doc_group='.$category_id.'"
		};
		var tmpNode'.$category_id.' = new YAHOO.widget.TextNode(o'.$category_id.', '.($id_doc_group == NULL || $id_doc_group == '' ? 'yuitree1.getRoot()' : 'tmpNode'.$id_doc_group).', false);
		tmpNode'.$category_id.'.renderHidden = true;
		contextElements.push(tmpNode'.$category_id.'.labelElId);
		';
		categorize($id_doc_type_Documents, $category_id, $pravo, $recursion_level + 1);
	}
	mysql_free_result($Recordset);
}
?>
<div id="yuitree1" style="width:186px;">
</div>
<script type="text/javascript">
// BeginWebWidget YUI_TreeView: yuitree1 
function treeInit() {
    var yuitree1 = new YAHOO.widget.TreeView("yuitree1");
	var tt, contextElements = [];
	<?php categorize($id_doc_type_Documents, NULL, $pravo, 0); ?>
	tt = new YAHOO.widget.Tooltip("tt", {
								  context: contextElements,
								  showdelay: 100,
								  hidedelay: 100,
								  autodismissdelay: 10000,
								  xyoffset: [0, 10]
								  });
	yuitree1.render();
	<?php 
	if ($selected_id_doc_group != '') {
		echo 'var selectedNodeDepth = tmpNode'.$selected_id_doc_group.'.depth;
			  for (var i = 0; i < selectedNodeDepth; i++) {
		          tmpNode'.$selected_id_doc_group.'.getAncestor(i).expand();
		      }
		      tmpNode'.$selected_id_doc_group.'.expand();
			  tmpNode'.$selected_id_doc_group.'.focus();';
	}
	?>
}
YAHOO.util.Event.onDOMReady(treeInit); 
// EndWebWidget YUI_TreeView: yuitree1 
</script>