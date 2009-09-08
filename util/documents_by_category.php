<?php

$id_group=-1;
if(isset($_GET['gid']))
	$id_group=$_GET['gid'];
if(isset($_GET['tid']))
	$id_type=$_GET['tid'];
else
	$id_type=0;
$maxRows_Documents2 = 30;
$pageNum_Documents2 = 0;
if (isset($_GET['pageNum_Documents'])) {
  $pageNum_Documents = $_GET['pageNum_Documents'];
}
$startRow_Documents2 = $pageNum_Documents2 * $maxRows_Documents2;

mysql_select_db($database_pravo, $pravo);
$query_Documents2 = sprintf("SELECT id_document, id_doc_group, title, published_date FROM `document` WHERE id_doc_group=%s and id_doc_type=%s and id_superdoc is null",GetSQLValueString($id_group,"int"),GetSQLValueString($id_type,"int"));
$query_limit_Documents2 = sprintf("%s LIMIT %d, %d", $query_Documents2, $startRow_Documents2, $maxRows_Documents2);
$Documents2 = mysql_query($query_limit_Documents2, $pravo) or die(mysql_error());
$row_Documents2 = mysql_fetch_assoc($Documents2);

$Documents3 = mysql_query($query_limit_Documents2, $pravo) or die(mysql_error());
$row_Documents3 = mysql_fetch_assoc($Documents3);

if (isset($_GET['totalRows_Documents'])) {
  $totalRows_Documents2 = $_GET['totalRows_Documents'];
} else {
  $all_Documents2 = mysql_query($query_Documents2);
  $totalRows_Documents2 = mysql_num_rows($all_Documents2);
}
$totalPages_Documents2 = ceil($totalRows_Documents2/$maxRows_Documents2)-1;


?>
<link href="../YUI/2.6.0/build/fonts/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="../YUI/2.6.0/build/container/assets/skins/sam/container.css" rel="stylesheet" type="text/css" />
<script src="../YUI/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="../YUI/2.6.0/build/container/container-min.js" type="text/javascript"></script>


<table border="0" cellspacing="0" cellpadding="0" width="197">
  <?php do { 
  	$title_exp=explode(" ",$row_Documents2['title']);
	$title_arr=array();
	$n=10;
	if(sizeof($title_exp)<10)
		$n=sizeof($title_exp);
	for($i=0;$i<$n;$i++)
		$title_arr[$i]=$title_exp[$i];
	
	$title=implode(" ",$title_arr);
	//print_r($title_arr);
		
  ?>
    <tr onmouseover="this.className='on'" onmouseout="this.className='off'">
      <td style="border-bottom:1px dotted #CCC;">
	  &raquo; <a href="?id=<?php echo $row_Documents2['id_document']; ?>&gid=<?php echo $row_Documents2['id_doc_group']; ?>&tid=<?php echo $id_type; ?>&page=<?php echo $_GET['page']; ?>" title="<?php echo $row_Documents2['title']; ?>"><?php  if($n<10) echo $title; else echo $title." ..."; ?></a>
     
	  </td>
    </tr>
    <?php } while ($row_Documents2 = mysql_fetch_assoc($Documents2)); ?>
</table>
<?php mysql_free_result($Documents2); ?>

