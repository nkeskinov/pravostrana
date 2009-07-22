<?php

$maxRows_Post = 10;
$pageNum_Post = 0;
$id_post_category=2; //ID for news
if (isset($_GET['pageNum_Post'])) {
  $pageNum_Post = $_GET['pageNum_Post'];
}
$startRow_Post = $pageNum_Post * $maxRows_Post;

$id_document=$colname_DetailRS1;


mysql_select_db($database_pravo, $pravo);
$query_Post = sprintf("SELECT post.id_post, post.date_created, post.content, post.subject, post.date_modified, post.priority, post.archive FROM discussion, post, post_category WHERE discussion.id_discussion=post.id_discussion   AND post_category.id_post_category=discussion.id_post_category  AND post_category.id_post_category=%s",GetSQLValueString($id_post_category, "int"));

if(!isset($_SESSION['MM_UserGroup']) && ($_SESSION['MM_UserGroup']!="admin")) {
	$query_Post=sprintf("%s AND archive=0",$query_Post);
}
$query_limit_Post = sprintf("%s ORDER BY priority DESC LIMIT %d, %d", $query_Post, $startRow_Post, $maxRows_Post);
//echo $query_limit_Post;
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

if(isset($_POST['hide'])){
	//echo $_POST['hide'];
	$HidePost=sprintf("UPDATE post SET  archive=1 WHERE id_post=%s",
						 GetSQLValueString($_POST['hide'], "int"));
	$ResultPost = mysql_query($HidePost, $pravo) or die(mysql_error());
	if($ResultPost){
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
		echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
		echo "<script>'Content-type: application/octet-stream'</script>";
	}
		
}

if(isset($_POST['show'])){
		//echo $_POST['show'];
	$ShowPost=sprintf("UPDATE post SET  archive=0 WHERE id_post=%s",
						 GetSQLValueString($_POST['show'], "int"));
	$ResultPost = mysql_query($ShowPost, $pravo) or die(mysql_error());
	if($ResultPost){
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
		echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
		echo "<script>'Content-type: application/octet-stream'</script>";
	}	
}


if ((isset($_POST["Down"])) && ($_POST["Down"] != "")) {
	//echo "VLEGUVA!!!!";
	$queryDown = sprintf("SELECT priority FROM post WHERE id_post=%s", GetSQLValueString($_POST["Down"], "int"));
	$DownPost = mysql_query($queryDown, $pravo) or die(mysql_error());
	if(mysql_num_rows($DownPost)>0)
		$priority=mysql_result($DownPost,0,'priority');
	else
		$priority=0;
	
	$queryDown1 = sprintf(" SELECT priority, id_post
							FROM post
							WHERE priority = (
							SELECT MAX( priority )
							FROM discussion d, post p, post_category pc
							WHERE d.id_discussion = p.id_discussion
							AND pc.id_post_category = d.id_post_category
							AND pc.id_post_category =%s
							AND p.priority < %s ) ",GetSQLValueString($id_post_category, "int"),GetSQLValueString($priority, "int"));
	$DownPost1 = mysql_query($queryDown1, $pravo) or die(mysql_error());
	if(mysql_num_rows($DownPost1)>0){
		$priority1=mysql_result($DownPost1,0,'priority');
		$id_post1=mysql_result($DownPost1,0,'id_post');
	}else
		$priority1=0;
		
	mysql_query("SET AUTOCOMMIT=0",$pravo);
  	mysql_query("begin",$pravo);
	
	if($priority!=0 && $piriority!=$priority1){
		$editPost=sprintf("UPDATE post SET  priority=%s WHERE id_post=%s",
						 GetSQLValueString($priority1, "int"),
						 GetSQLValueString($_POST['Down'], "int"));
		 $ResultPost = mysql_query($editPost, $pravo) or die(mysql_error());
		 
		 $editPost1=sprintf("UPDATE post SET  priority=%s WHERE id_post=%s",
						 GetSQLValueString($priority, "int"),
						 GetSQLValueString($id_post1, "int"));
		 $ResultPost1 = mysql_query($editPost1, $pravo) or die(mysql_error());
		 
		 if($ResultPost && $ResultPost1){
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
				//header("Location: " . $MM_redirectLoginSuccess );
				echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
				echo "<script>'Content-type: application/octet-stream'</script>";
			mysql_query("commit",$pravo);
		 }
		else
			mysql_query("rollback",$pravo);
	}
}

if ((isset($_POST["Up"])) && ($_POST["Up"] != "")) {

	$queryDown = sprintf("SELECT priority FROM post WHERE id_post=%s", GetSQLValueString($_POST["Up"], "int"));
	$DownPost = mysql_query($queryDown, $pravo) or die(mysql_error());
	if(mysql_num_rows($DownPost)>0)
		$priority=mysql_result($DownPost,0,'priority');
	else
		$priority=0;
	
	$queryDown1 = sprintf(" SELECT priority, id_post
							FROM post
							WHERE priority = (
							SELECT MIN( priority )
							FROM discussion d, post p, post_category pc
							WHERE d.id_discussion = p.id_discussion
							AND pc.id_post_category = d.id_post_category
							AND pc.id_post_category =%s
							AND p.priority > %s ) ",GetSQLValueString($id_post_category, "int"),GetSQLValueString($priority, "int"));
	$DownPost1 = mysql_query($queryDown1, $pravo) or die(mysql_error());
	if(mysql_num_rows($DownPost1)>0){
		$priority1=mysql_result($DownPost1,0,'priority');
		$id_post1=mysql_result($DownPost1,0,'id_post');
	}else
		$priority1=0;

	mysql_query("SET AUTOCOMMIT=0",$pravo);
  	mysql_query("begin",$pravo);
	
	if($priority!=0 && $piriority!=$priority1){
		$editPost=sprintf("UPDATE post SET  priority=%s WHERE id_post=%s",
						 GetSQLValueString($priority1, "int"),
						 GetSQLValueString($_POST['Up'], "int"));
		 $ResultPost = mysql_query($editPost, $pravo) or die(mysql_error());
		 
		 $editPost1=sprintf("UPDATE post SET  priority=%s WHERE id_post=%s",
						 GetSQLValueString($priority, "int"),
						 GetSQLValueString($id_post1, "int"));
		 $ResultPost1 = mysql_query($editPost1, $pravo) or die(mysql_error());
		 
		 if($ResultPost && $ResultPost1){
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
				//header("Location: " . $MM_redirectLoginSuccess );
				echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
				echo "<script>'Content-type: application/octet-stream'</script>";
			mysql_query("commit",$pravo);
		 }
		else
			mysql_query("rollback",$pravo);
	}
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
    		//header("Location: " . $MM_redirectLoginSuccess );
			echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
  	}
}

if ((isset($_POST["Comment_edit"])) && ($_POST["Comment_edit"] == "edit")) {
	mysql_select_db($database_pravo, $pravo);
	
	$editSQL=sprintf("UPDATE post SET  subject=%s, content=%s WHERE id_post=%s",
					 GetSQLValueString($_POST["subject"], "text"),					 
					 GetSQLValueString($_POST["content"], "text"),
					 GetSQLValueString($_POST['document_id'], "int"));
	 $ResultEdit = mysql_query($editSQL, $pravo) or die(mysql_error());
	 if($ResultEdit){
			_show_message_color('Постот е успешно изменет!','GREEN');  
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    		//header("Location: " . $MM_redirectLoginSuccess );
			echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
			
  	} 
}
if ((isset($_POST["Comment_insert"])) && ($_POST["Comment_insert"] == "insert")) {
   mysql_select_db($database_pravo, $pravo);
   
   	$query_Post = sprintf("SELECT MAX(post.priority) as priority FROM discussion, post, post_category WHERE discussion.id_discussion=post.id_discussion  AND post_category.id_post_category=discussion.id_post_category  AND post_category.id_post_category=%s",GetSQLValueString($id_post_category, "int"));
	$PostPriority = mysql_query($query_Post, $pravo) or die(mysql_error());

	$priority=mysql_result($PostPriority,0,'priority');
	if($priority==0 or $priority==NULL)
		$priority=1;
   
   $discussionName="Вести";
   
  $discussionSQL=sprintf("SELECT * from discussion where id_post_category=%s",GetSQLValueString($id_post_category, "int"));
  $discussionResult = mysql_query($discussionSQL, $pravo) or die(mysql_error());
  $discussionFound = mysql_num_rows($discussionResult);
  $id_discussion=-1;
  if($discussionFound)
  	$id_discussion = mysql_result($discussionResult,0,'id_discussion');
  
  if(!$discussionFound){
  	$insertSQL = sprintf("INSERT INTO discussion (name, id_post_category, id_user) VALUES (%s, %s, %s)",
                       GetSQLValueString($discussionName, "text"),
                       GetSQLValueString($id_post_category, "int"),
                       GetSQLValueString($_SESSION['MM_ID'], "int"));

	mysql_query("SET AUTOCOMMIT=0",$pravo);
  	mysql_query("begin",$pravo);
  	$Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
	
	$id_discussion=	mysql_insert_id();
	$insertPostSQL=sprintf("INSERT INTO post(id_user, subject, content, id_discussion, format, priority) VALUES(%s,%s,%s,%s,%s,%s)",
						GetSQLValueString($_SESSION['MM_ID'], "int"),
						GetSQLValueString($_POST['subject'], "text"),
						GetSQLValueString($_POST['content'], "text"),
						GetSQLValueString($id_discussion, "int"),
						GetSQLValueString("text", "text"),
						GetSQLValueString($priority, "int"));
	$Result2 = mysql_query($insertPostSQL, $pravo) or die(mysql_error());	
	if($Result2){
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    		//header("Location: " . $MM_redirectLoginSuccess );
			echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
  	}
	if (mysql_error())
		mysql_query('rollback',$pravo);
	else
		mysql_query('commit',$pravo);
		
  }else{
	$insertPostSQL=sprintf("INSERT INTO post(id_user, subject, content, id_discussion, format, priority) VALUES(%s,%s, %s,%s,%s,%s)",
						GetSQLValueString($_SESSION['MM_ID'], "int"),
						GetSQLValueString($_POST['subject'], "text"),						
						GetSQLValueString($_POST['content'], "text"),
						GetSQLValueString($id_discussion, "int"),
						GetSQLValueString("text", "text"),
						GetSQLValueString($priority+1, "int"));
	$Result2 = mysql_query($insertPostSQL, $pravo) or die(mysql_error());
	if($Result2){
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    		//header("Location: " . $MM_redirectLoginSuccess );
			echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
			mysql_query('commit',$pravo);
  	}else{
		mysql_query('rollback',$pravo);
	}
  }
  
  
}
?>
<script type="text/javascript" src="javaScripts/tiny_mce/plugins/swampy_browser_1.2/sb.js"></script>
<script type="text/javascript" src="javaScripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		theme : "advanced",
plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager",


		theme_advanced_buttons1 : "save,newdocument,|,mymenubutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,forecolor,backcolor",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,formatselect,fontselect,fontsizeselect,",
		theme_advanced_buttons3 : "undo,redo,emotions,|,link,unlink,anchor,image,cleanup,code,|,insertfile,insertimage",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Drop lists for link/image/media/template dialogs
		//template_external_list_url : "js/template_list.js",
		//external_link_list_url : "js/link_list.js",
		//external_image_list_url : "js/image_list.js",
		//media_external_list_url : "js/media_list.js",
		file_browser_callback : "openSwampyBrowser" /* you need this line for SwampyBrowser */

		
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
<?php if(isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup']="admin" ) { ?>
<div >
<form method="post" name="form_comment" action="<?php echo $editFormAction; ?>">
<?php if(isset($_POST['new']) || isset($_POST['EditPost'])){ ?>
<div style="padding:10px; border-bottom:1px solid #f5e6a2; background:#fbf7e0; width:96%;">
<table width="100%" border="0" >
	<tr>
	  <td align="right">Наслов:</td>
	  <td><label>
	    <input name="subject" type="text" id="subject" size="62" value="<?php if(isset($row_Post1['subject'])){ echo $row_Post1['subject']; }?>"  onkeyup="this.form.subject.value=toCyr(this.form.subject.value)">
	    </label></td>
	  </tr>
	<tr>
	  <td align="right" valign="top">Содржина:</td>
	  <td><textarea name="content" id="content"  class="mceEditor"  wrap='VIRTUAL'  cols="63" rows="4" style="border:1px solid #f5e6a2;"  onkeyup="this.form.content.value=toCyr(this.form.content.value)"><?php if(isset($row_Post1['content'])){ echo $row_Post1['content']; }?>
	  </textarea></td>
    </tr>
	<tr>
	  <td colspan="2"><div align="right">
	    <?php if(!isset($_POST['EditPost'])){ ?>
	    <input name="Submit" type="submit" style="background-color:#993300; color:#FFFFFF" value="Прати" />
	    <input type="hidden" name="Comment_insert" id="Comment_insert" value="insert" />
	    <?php }else{ ?>
	    <input name="Submit" type="submit" style="background-color:#993300; color:#FFFFFF" value="Измени">
	    <input type="hidden" name="document_id" value="<?php echo $row_Post1['id_post']; ?>" />
	    <input type="hidden" name="Comment_edit" id="Comment_edit" value="edit" />
	    <?php } ?>
	    </div></td>
	  </tr>
	<tr>
	  <td colspan="2">&nbsp;</td>
  </tr>
</table>
</div>
<?php } else { ?>
	<div align="left" style="height:22px;width:506px; margin-left:-3px; margin-top:2px;  border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
    <input type="image" src="images/new.png" />
    <input type="hidden" name="new" />
    </div>
<?php } ?>
</form>

</div> 
<br />
<?php } ?>
<div>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  
  <?php 
  do { 
  	if($num_of_posts){
  ?>
    <tr>
      <td width="82%" style=" padding:5px;background:#fbf7e0; border-bottom:1px solid #f5e6a2;" colspan="<?php if(isset($_SESSION['MM_UserGroup'])&& ($_SESSION['MM_UserGroup'] =="admin")){ echo 0; }else echo 2;
		?>">
      	<a name="<?php echo $row_Post['id_post']; ?>"></a>
	  	<span style="color:#C63; font-size:14px;"><strong><?php echo $row_Post['subject']; ?></strong></span>
      	<br /><span style="font-size:10px; color:#666;"> на
		<?php  echo date("d.m.Y H:i",strtotime($row_Post['date_created'])); ?> </span>
      </td>
      
      <?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] =="admin"){ 
		?>
        <td width="18%" align="right" valign="top" style="padding:5px;background:#fbf7e0; border-bottom:1px solid #f5e6a2;">
	<form method="post" name="form_post" action="<?php echo $editFormAction; ?>">
    <div style="vertical-align:middle; width:15px; height:15px; float:left;">
    <?php  if($row_Post['archive']==0){  ?>
    <input type="image" src="images/hide.gif" name="hide" title="Архивирај" value="<?php echo $row_Post['id_post']; ?>" />
    <?php } elseif($row_Post['archive']==1) { ?>
    <input type="image" src="images/show.gif" name="show" title="Одархивирај" value="<?php echo $row_Post['id_post']; ?>" />
    <?php } ?>
    </div>
     <div style="vertical-align:middle; width:15px; height:15px; float:left;"><input type="image" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Up1<?php echo $row_Post['id_post']; ?>','','images/move-up-b.png',1)"src="images/move-up-w.png" name="Up" border="0" id="Up1<?php echo $row_Post['id_post']; ?>" value="<?php echo $row_Post['id_post']; ?>" title="Помести нагоре"/></div>
     
    <div style="vertical-align:middle; width:15px; height:15px; float:left;"><input type="image" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Down1<?php echo $row_Post['id_post']; ?>','','images/move-down-b.png',1)"src="images/move-down-w.png" name="Down" border="0" id="Down1<?php echo $row_Post['id_post']; ?>" value="<?php echo $row_Post['id_post']; ?>" title="Помести надолу"/></div>
    
     <div style="vertical-align:middle; width:15px; height:15px; float:left;"><input type="image" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Edit1<?php echo $row_Post['id_post']; ?>','','images/edit-small.png',1)"src="images/edit-small1.png" name="EditPost" border="0" id="Edit1<?php echo $row_Post['id_post']; ?>" value="<?php echo $row_Post['id_post']; ?>" title="Измени"/></div>
      
      <div style="vertical-align:middle; width:15px; height:15px; float:left;"><input type="image" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1<?php echo $row_Post['id_post']; ?>','','images/delete-small.png',1)" src="images/delete-small1.png" name="DeletePost" border="0" id="Image1<?php echo $row_Post['id_post']; ?>" value="<?php echo $row_Post['id_post']; ?>" title="Бриши" onClick="return confirm('Дали навистина сакате да го избришете документот!')"/></div>
      </form>
       </td>
      <?php } } ?>
    
    </tr>
     <tr>
      <td colspan="<?php if(isset($_SESSION['MM_UserGroup'])&& ($_SESSION['MM_UserGroup'] =="admin")){ echo 2; }else echo 0; ?>" style="padding:5px; padding-top:0px;"><?php echo $row_Post['content'];?></td>
    </tr>
    <tr><td height="3" colspan="2" style="font-size:6px;"></td></tr>
    <?php }} while ($row_Post = mysql_fetch_assoc($Post)); ?>
</table>
<table border="0" width="100%" cellspacing="0">
<tr>
    	<td width="50%">Вести <?php echo ($startRow_Post + 1) ?> до <?php echo min($startRow_Post + $maxRows_Post, $totalRows_Post) ?> од <?php echo $totalRows_Post ?></td>
    	<td width="50%" align="right">
          <table border="0" style="font-size:12px;">
            <tr>
              
              <td ><?php if ($pageNum_Post > 0  ) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Post=%d%s", $currentPage, max(0, $pageNum_Post - 1), $queryString_Post); ?>"><img src="images/pPrev.png" border="0"/></a>
                  <?php }else{ // Show if not first page ?> 
                  		<img src="images/pPrevDisabled.png" border="0"/>
                  <?php } ?></td>
              <td >
              	<?php $l=$pageNum_Post-4;
					  $h=$pageNum_Post+4;
					  //echo "l=".$l;
					  if($l<0) $l=0;
					  if($h<7 && $h<$totalPages_Post) $h=7;
					  if($h>$totalPages_Post){
						  $h=$totalPages_Post;
						  $l=$h-7;
						  if($l<0)$l=0;
					  }
					  if ($h >7 && $l>0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Post=%d%s", $currentPage, 0, $queryString_Post); ?>"><?php echo '<u>'; echo 1; echo '</u>';?></a>...
				  <?php }
					for($i=$l;$i<=$h; $i++){
						
						if($i == $pageNum_Post){ 
							echo "<b>[";
							echo $i+1;
							echo "]</b>";
						}elseif($i<=$h){ ?>
								<a href="<?php printf("%s?pageNum_Post=%d%s", $currentPage, $i, $queryString_Post); ?>"><?php echo '<u>'; echo $i+1; echo '</u>';?></a>
						
						<?php }
					}
				?>
                <?php if ($pageNum_Post < $totalPages_Post && ($h-$l)>=7) { // Show if not last page ?>...
                  <a href="<?php printf("%s?pageNum_Post=%d%s", $currentPage, $totalPages_Post, $queryString_Post); ?>"><?php echo '<u>'; echo $totalPages_Post+1; echo '</u>';?></a>
                  <?php } // Show if not last page ?></td>
              <td ><?php if ($pageNum_Post < $totalPages_Post) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Post=%d%s", $currentPage, min($totalPages_Post, $pageNum_Post + 1), $queryString_Post); ?>"><img src="images/pNext.png" border="0"/></a>
                  <?php }else{ ?>
					  <img src="images/pNextDisabled.png" border="0"/>
				 <?php }// Show if not last page ?></td>
              
            </tr>
        </table></td>
    </tr>
</table>
</div>
<?php
mysql_free_result($Post);
?>
