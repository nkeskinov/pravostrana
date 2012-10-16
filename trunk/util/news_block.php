<?php
$maxRows_Post = 3;
$pageNum_Post = 0;
$id_post_category=2; //ID for news
if (isset($_GET['pageNum_Post'])) {
  $pageNum_Post = $_GET['pageNum_Post'];
}
$startRow_Post = $pageNum_Post * $maxRows_Post;

//$id_document=$colname_DetailRS1;


mysql_select_db($database_pravo, $pravo);
$query_Post = sprintf("SELECT post.id_post, post.created_date, post.content, post.subject, post.modified_date, post.priority FROM discussion, post, post_category WHERE discussion.id_discussion=post.id_discussion   AND post_category.id_post_category=discussion.id_post_category  AND post_category.id_post_category=%s  AND archive!=1 ORDER BY priority DESC",GetSQLValueString($id_post_category, "int"));
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
<div style="margin-top:3px;">
<table width="248" cellspacing="0" cellpadding="5" height="250">
<?php do {
	$content1=$row_Post['content'];
	$subject1=$row_Post['subject'];
	$content1= str_replace("<p>","",$content1);
	$content1= str_replace("</p>","",$content1);
	if(strpos($content1,"<img")>0){
		$content1= str_replace(substr($content1, strpos($content1,"<img"), strpos($content1,"/>",strpos($content1,"<img"))-strpos($content1,"<img")+2),"",$content1);
	}
	$content_exp=explode(" ",$content1);
	$subject_exp=explode(" ",$subject1);
	$content_arr=array();
	$subject_arr=array();
	$n=10;
	$n1=15;
	if(sizeof($content_exp)<10)
		$n=sizeof($content_exp);
	if(sizeof($subject_exp)<15)
		$n1=sizeof($subject_exp);
	for($i=0;$i<$n;$i++)
		$content_arr[$i]=$content_exp[$i];
	for($i=0;$i<$n1;$i++)
		$subject_arr[$i]=$subject_exp[$i];
		
	$content=implode(" ",$content_arr);
	$subject=implode(" ",$subject_arr);
	
	//$content= 
	//echo substr($content, strpos($content,"<img"), strpos($content,"/>",strpos($content,"<img"))-strpos($content,"<img")+2)."<br>";
	
	?>
	<tr onmouseover="this.className='on'" onmouseout="this.className='off'">
	    <td style="border-bottom:1px dotted #CCC;  padding:5px;" align="center" valign="top" width="30%">
		<div style=" height:56px; width:55px; background:url(images/calendar1.png) no-repeat;" title="<?php echo date("d.m.Y",strtotime($row_Post['created_date'])); ?>">
        <div align="center" style="color:#FFF;"><?php  
		switch(date("m",strtotime($row_Post['created_date']))){ 
			case "01": echo "јан."; break; 
			case "02": echo "фев."; break; 
			case "03": echo "март"; break; 
			case "04": echo "апр."; break; 
			case "05": echo "маj"; break; 
			case "06": echo "јуни"; break; 
			case "07": echo "јули"; break; 
			case "08": echo "авг."; break; 
			case "09": echo "сеп."; break; 
			case "10": echo "окт."; break; 
			case "11": echo "ное."; break; 
			case "12": echo "дек."; break; 
		}?></div><div style="padding:8px;" align="center" ><span style="font-size:18px; font-weight:bold;"><?php echo date("d",strtotime($row_Post['created_date'])); ?></span></div></div>
        </td>
	    <td style="border-bottom:1px dotted #CCC;"><a href="news.php#<?php echo $row_Post['id_post']; ?>"><?php echo $row_Post['subject']; ?></a></td>
    </tr>
 <?php } while ($row_Post = mysql_fetch_assoc($Post)); ?>
</table>
</div>