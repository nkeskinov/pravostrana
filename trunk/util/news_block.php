<?php
$maxRows_Post = 5;
$pageNum_Post = 0;
$id_post_category=2; //ID for news
if (isset($_GET['pageNum_Post'])) {
  $pageNum_Post = $_GET['pageNum_Post'];
}
$startRow_Post = $pageNum_Post * $maxRows_Post;

$id_document=$colname_DetailRS1;


mysql_select_db($database_pravo, $pravo);
$query_Post = sprintf("SELECT post.id_post, post.date_created, post.content, post.subject, post.date_modified, post.priority FROM discussion, post, post_category WHERE discussion.id_discussion=post.id_discussion   AND post_category.id_post_category=discussion.id_post_category  AND post_category.id_post_category=%s ORDER BY priority DESC",GetSQLValueString($id_post_category, "int"));
$query_limit_Post = sprintf("%s LIMIT %d, %d", $query_Post, $startRow_Post, $maxRows_Post);
$Post = mysql_query($query_limit_Post, $pravo) or die(mysql_error());
//$Post2 = mysql_query($query_limit_Post, $pravo) or die(mysql_error());
$row_Post = mysql_fetch_assoc($Post);
//$row_Post2 = mysql_fetch_assoc($Post2);
$num_of_posts=mysql_num_rows($Post);

if (isset($_GET['totalRows_Post'])) {
  $totalRows_Post = $_GET['totalRows_Post'];
} else {
  $all_Post = mysql_query($query_Post);
  $totalRows_Post = mysql_num_rows($all_Post);
}
$totalPages_Post = ceil($totalRows_Post/$maxRows_Post)-1;

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>

<table width="100%" cellspacing="0">
<?php do {
	$content_exp=explode(" ",$row_Post['content']);
	$content_arr=array();
	$n=10;
	if(sizeof($content_exp)<10)
		$n=sizeof($content_exp);
	for($i=0;$i<$n;$i++)
		$content_arr[$i]=$content_exp[$i];
	
	$content=implode(" ",$content_arr);
	$content= str_replace("<p>","",$content);
	$content= str_replace("</p>","",$content);
	?>
	<tr onmouseover="this.className='on'" onmouseout="this.className='off'">
	    <td style="border-bottom:1px dotted #CCC;">
		<span style="color:#C63; font-size:14px;"><?php echo $row_Post['subject']; ?></span>
        <span style="font-size:10px; color:#666;"><?php  echo date("d.m.Y H:i",strtotime($row_Post['date_created'])); ?> </span>
        <br />
		<?php echo $content; ?></td>
    </tr>
 <?php } while ($row_Post = mysql_fetch_assoc($Post)); ?>
</table>