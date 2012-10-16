<?php
ob_start();
$maxRows_Post = 10;
$pageNum_Post = 0;
if (isset($_GET['pageNum_Post'])) {
  $pageNum_Post = $_GET['pageNum_Post'];
}
$startRow_Post = $pageNum_Post * $maxRows_Post;

if(isset($_SESSION['MM_Name'])){
	$editBy=$_SESSION['MM_Name'];
	$edit_message="---<br />Изменето од: ".$editBy."<br />Оригинално внесен на: ";
}


mysql_select_db($database_pravo, $pravo);
$query_Post = sprintf("SELECT post.id_post, `user`.id_user, `user`.name, `user`.surname, post.created_date, post.content, post.subject, post.modified_date FROM discussion, post, post_category, `user` WHERE discussion.id_discussion=post.id_discussion   AND post_category.id_post_category=discussion.id_post_category AND post.id_user=`user`.id_user AND post.archive=0 AND post_category.id_post_category=1 AND discussion.id_document=%s ORDER BY created_date DESC",GetSQLValueString($id_document, "-1"));
$query_limit_Post = sprintf("%s LIMIT %d, %d", $query_Post, $startRow_Post, $maxRows_Post);
$Post = mysql_query($query_limit_Post, $pravo) or die(mysql_error());
$row_Post = mysql_fetch_assoc($Post);
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
$EditPost=array();

if ((isset($_POST["EditPost"])) && ($_POST["EditPost"] != "")) {
	$query_Post1 = sprintf("SELECT * FROM post WHERE id_post=%s",GetSQLValueString($_POST["EditPost"], "int"));
	$EditPost = mysql_query($query_Post1, $pravo) or die(mysql_error());
	$row_Post1 = mysql_fetch_assoc($EditPost); 
	
}

if ((isset($_POST["DeletePost"])) && ($_POST["DeletePost"] != "")) {
	mysql_select_db($database_pravo, $pravo);
	$deleteSQL=sprintf("DELETE FROM post WHERE id_post=%s",
						GetSQLValueString($_POST['DeletePost'], "int"));
	$ResultDelete = mysql_query($deleteSQL, $pravo) or die(mysql_error());
	 if($ResultDelete){
			_show_message_color('Постот е успешно избришан!','GREEN');  
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    		echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
  	}
}

if ((isset($_POST["Comment_edit"])) && ($_POST["Comment_edit"] == "edit")) {
	mysql_select_db($database_pravo, $pravo);
	
	$editSQL=sprintf("UPDATE post SET content=%s WHERE id_post=%s",
					 GetSQLValueString($_POST["content"], "text"),
					 GetSQLValueString($_POST['document_id'], "int"));
	 $ResultEdit = mysql_query($editSQL, $pravo) or die(mysql_error());
	 if($ResultEdit){
			_show_message_color('Постот е успешно изменет!','GREEN');  
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    		//header("Location: ".$MM_redirectLoginSuccess );
			echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
  	}
}
if ((isset($_POST["Comment_insert"])) && ($_POST["Comment_insert"] == "insert")) {
   mysql_select_db($database_pravo, $pravo);
   $discussionName=$row_DetailRS1['title'];
   
  $discussionSQL=sprintf("SELECT * from discussion where id_document=%s",GetSQLValueString($id_document, "-1"));
  $discussionResult = mysql_query($discussionSQL, $pravo) or die(mysql_error());
  $discussionFound = mysql_num_rows($discussionResult);
  $id_discussion=-1;
  if($discussionFound)
  	$id_discussion = mysql_result($discussionResult,0,'id_discussion');
  
  if(!$discussionFound){
  	$insertSQL = sprintf("INSERT INTO discussion (name, id_post_category, id_user, id_document) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($discussionName, "text"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString($_SESSION['MM_ID'], "int"),
                       GetSQLValueString($id_document, "int"));

	mysql_query("SET AUTOCOMMIT=0");
  	mysql_query("begin");
  	$Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
	
	$id_discussion=	mysql_insert_id();
	$insertPostSQL=sprintf("INSERT INTO post(id_user,content,id_discussion,format,created_date) VALUES(%s,%s,%s,%s,%s)",
						GetSQLValueString($_SESSION['MM_ID'], "int"),
						GetSQLValueString($_POST['content'], "text"),
						GetSQLValueString($id_discussion, "int"),
						GetSQLValueString("text", "text"),
						GetSQLValueString(date('Y-m-d H:i'), "date"));
	$Result2 = mysql_query($insertPostSQL, $pravo) or die(mysql_error());	
	if($Result2){
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    		//header("Location: " . $MM_redirectLoginSuccess );
			echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
  	}
	if (mysql_error())
		mysql_query('rollback');
	else
		mysql_query('commit');
		
  }else{
	$insertPostSQL=sprintf("INSERT INTO post(id_user,content,id_discussion,format,created_date) VALUES(%s,%s,%s,%s,%s)",
						GetSQLValueString($_SESSION['MM_ID'], "int"),
						GetSQLValueString($_POST['content'], "text"),
						GetSQLValueString($id_discussion, "int"),
						GetSQLValueString("text", "text"),
						GetSQLValueString(date('Y-m-d H:i'), "date"));
	$Result2 = mysql_query($insertPostSQL, $pravo) or die(mysql_error());
	if($Result2){
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
		echo "<script>'Content-type: application/octet-stream'</script>";
  	}
  }
  $to_email="contact@pravo.org.mk";
  $subject="Дискусија за ".$row_DetailRS1['title'];
  $Message=$_SESSION['MM_Name']." на ".date('d.m.Y H:i:s')."<br /><br />";
  $Message.=$_POST['content'];
  $Message.="<br /><a href='http://pravo.org.mk".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."'>http://pravo.org.mk".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."</a>";

  //newsletterByDocument( $row_DetailRS1['id_document'], $subject, $Message, $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'], $pravo, $database_pravo);
  send_mail("Pravo.org.mk","no-reply@pravo.org.mk",$to_email,$subject,$Message);
}
?>
<script type="text/javascript" src="javaScripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",


		theme_advanced_buttons1 : "mymenubutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,emotions,undo,redo,link,unlink",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : ""

		
		
	});
	
</script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<?php if($num_of_posts){ ?>
	<div style="padding:10px;"><strong>Дискусии околу овој закон</strong></div>
<?php } ?>
<?php if(isset($_SESSION['MM_UserGroup'])) { ?>
<div style="margin-left:5px;">
<form method="post" name="form_comment" action="<?php echo $editFormAction; ?>">
<table width="80%" border="0" >
	<tr>
	  <td style="padding:10px; border-bottom:1px solid #f5e6a2; background:#fbf7e0;">
	    <textarea name="content" id="content" class="highlight expand demoTextarea" cols="50" rows="4" style="border:1px solid #f5e6a2;"><?php if(isset($row_Post1['content'])){ echo $row_Post1['content']; echo '<i><span style="font-size:10px; color:#666;">'.$edit_message.''.date("d.m.Y H:i",strtotime($row_Post1['created_date'])).'</span></i>';}?></textarea>
        <br />       
      <div align="right"><?php if(!isset($_POST['EditPost'])){ ?>
      <input name="Submit" type="submit" style="background-color:#993300; color:#FFFFFF" value="Коментирај" />
	  <input type="hidden" name="Comment_insert" id="Comment_insert" value="insert" /><?php }else{ ?>
      <input name="Submit" type="submit" style="background-color:#993300; color:#FFFFFF" value="Измени">
      <input type="hidden" name="document_id" value="<?php echo $row_Post1['id_post']; ?>" />
	  <input type="hidden" name="Comment_edit" id="Comment_edit" value="edit" /><?php } ?>
      </div>
      </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
</table>
</form>
</div> 
<?php } ?>
<div style="margin-left:5px; margin-right:5px;">
<table border="0" width="100%" cellspacing="0" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px;"><?php 
	$isAdmin = isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup'] == "admin";
  do { 
  	if($num_of_posts){ ?><tr>
      <td width="92%" style=" padding:5px;background:#fbf7e0;">
	  	<span style="color:#C63"><?php echo ($isAdmin ? '<a href="admin/userDetails.php?id='.$row_Post['id_user'].'">' : '').$row_Post['name']; ?>&nbsp;<?php echo $row_Post['surname'].($isAdmin ? '</a>' : ''); ?></span>
      	<span style="font-size:10px; color:#666;"> на <?php  echo date("d.m.Y H:i",strtotime($row_Post['created_date'])); ?></span>
      </td>
      <td width="8%" align="right" style="padding:5px;background:#fbf7e0;"><?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] =="admin"){ 
		?><form method="post" name="form_post" action="<?php echo $editFormAction; ?>">
     <div style="vertical-align:middle; width:15px; height:15px; float:left;"><input type="image" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Edit1<?php echo $row_Post['id_post']; ?>','','images/edit-small.png',1)"src="images/edit-small1.png" name="EditPost" border="0" id="Edit1<?php echo $row_Post['id_post']; ?>" value="<?php echo $row_Post['id_post']; ?>" title="Измени"/></div>
      <div style="vertical-align:middle; width:15px; height:15px; float:left;"><input type="image" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1<?php echo $row_Post['id_post']; ?>','','images/delete-small.png',1)" src="images/delete-small1.png" name="DeletePost" border="0" id="Image1<?php echo $row_Post['id_post']; ?>" value="<?php echo $row_Post['id_post']; ?>" title="Бриши" onClick="return confirm('Дали навистина сакате да ја избришете дискусијата?')"/></div>
      </form><?php } } ?></td>
     </tr>
     <tr>
      <td colspan="2" style="padding:5px; padding-top:0px; background:#fbf7e0;"><div style="width:468px; overflow:auto;"><?php echo $row_Post['content'];?></div></td>
    </tr>
    <tr><td height="3" colspan="2" style="font-size:6px;"></td></tr><?php }} while ($row_Post = mysql_fetch_assoc($Post)); ?>
</table>
</div>
<?php mysql_free_result($Post);?>