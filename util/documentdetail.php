<?php

//$colname_DetailRS1 = "-1";
//if (isset($_GET['id'])) {
//  $colname_DetailRS1 = $_GET['id'];
//}

if(isset($_GET['subscribe']) && $_GET['subscribe']==1){
		$insertSQL = sprintf("INSERT INTO subscription_by_doc (id_user, id_document) VALUES (%s, %s)",
                       	GetSQLValueString($_SESSION['MM_ID'], "int"),
					 	GetSQLValueString($id_document, "int"));
		$Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
		if($Result1){
			$MM_redirectLoginSuccess="?".substr($_SERVER['QUERY_STRING'],0,strpos($_SERVER['QUERY_STRING'],"&subscribe=1"));
    		//header("Location: " . $MM_redirectLoginSuccess );
			echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
			echo "<script>'Content-type: application/octet-stream'</script>";
		}
}

//Selecting the subsubgroup, subgroup and group for the document
$query_DocGroup=sprintf("SELECT id_doc_group, name
						FROM doc_group
						WHERE id_doc_group = (
							SELECT id_supergroup
							FROM doc_group
							WHERE id_doc_group = (
								SELECT id_supergroup
								FROM doc_group
								WHERE id_doc_group = %s
							)
						)						UNION
						SELECT id_doc_group, name
						FROM doc_group
						WHERE id_doc_group = (
							SELECT id_supergroup
							FROM doc_group
							WHERE id_doc_group = %s
						)UNION
						SELECT id_doc_group, name FROM doc_group
						WHERE id_doc_group = %s 
						",GetSQLValueString($id_group,"int"),GetSQLValueString($id_group,"int"),GetSQLValueString($id_group,"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
//$row_DocGroup = mysql_fetch_assoc($DocGroup);
$numRows_DocGroup = mysql_num_rows($DocGroup);
//print_r($row_DocGroup);

?>
<?php
function getSubDocuments($id_document, $id_document_type, $pravo, $database_pravo){
	mysql_select_db($database_pravo, $pravo);
	//$id_doc_type_Documents = "1";
	$query_SubDocuments = sprintf("SELECT * FROM document left join doc_meta on document.id_doc_meta = doc_meta.id_doc_meta WHERE document.id_doc_type = %s and document.id_superdoc is not null and document.id_superdoc=%s ORDER BY published_date ASC", GetSQLValueString($id_document_type, "int"),GetSQLValueString($id_document, "int"));
	$SubDocuments = mysql_query($query_SubDocuments, $pravo) or die(mysql_error());
	$row_SubDocuments = mysql_fetch_assoc($SubDocuments);
	$tmp_number=0;
?>

<?php if(mysql_num_rows($SubDocuments)!=0){ ?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
    <td colspan="4" style="border-bottom:1px solid #f5e6a2; background:#fbf7e0;"><strong>Измени и дополнувања</strong></td>
  <tr>
  <?php  
	  do { 	$timestamp = strtotime($row_SubDocuments['published_date']); ?>
    <tr onmouseover="this.className='on'" onmouseout="this.className='off'" style="cursor:default;">
      <td width="4%" valign="top">
       <?php if($tmp_number<mysql_num_rows($SubDocuments)-1) {?>
	      <img src="images/dot_cros1.png"/>
      <?php }else{ ?>
            <img src="images/dot1.gif"/>
      <?php }?>
      </td>
      <td width="61%" valign="top">&nbsp;<?php echo $row_SubDocuments['title']; ?><br>
      <span style="color:#666; font-size:11px">&nbsp;&nbsp;<?php echo date("d.m.Y", $timestamp); ?>&nbsp;<?php //|</span></span><span style="color:#666; font-size:10px"> Сл. весник/година:</span> <span style="font-size:10px;"><?php echo $row_SubDocuments['ordinal']."/".date("Y",strtotime($row_SubDocuments['date'])); ?></span></td>
      <td width="15%" align="right" valign="top">
       <div style="padding:3px;">
      <?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] =="admin"){ ?>
         <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
         <a href="admin/documents.php?id_document=<?php echo $row_SubDocuments['id_document']; ?>&id_doc_type=<?php echo $row_SubDocuments['id_doc_type']; ?>&id_doc_meta=<?php echo $row_SubDocuments['id_doc_meta']; ?>&delete=true" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="images/delete.png" border="0" title="Бриши" /></a></div><div style="float:left;">
         <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
      <a href="admin/documents.php?id_document=<?php echo $row_SubDocuments['id_document']; ?>&edit=true&superdocument=<?php echo $id_document; ?>" title="Измени"><img src="images/edit.png" border="0"  /></a
      ></div></div><?php } }  ?>
      </div>
      </td>
      <td width="20%" align="right"><a href="download.php?id=<?php echo $row_SubDocuments['id_document']; ?> "><?php if($row_SubDocuments['mimetype']=="application/msword"){ ?><img src="images/word_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /> <?php }elseif($row_SubDocuments['mimetype']=="text/plain"){ ?><img src="images/text_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php }else{ ?><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php } ?><br><span style="font-size:10px; color:#999;"><?php /*getNumDownloads($row_SubDocuments['id_document'], $pravo, $database_pravo);*/
	  echo (($row_SubDocuments['no_downloads'] == 0 ? 'Сеуште не е симнат' : ($row_SubDocuments['no_downloads'] == 1 ? 'Еднаш симнат' : $row_SubDocuments['no_downloads'].' пати симнат'))); ?></span></a></td>
    </tr>
    <?php $tmp_number+=1;} while ($row_SubDocuments = mysql_fetch_assoc($SubDocuments)); ?>
    <?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] == "admin"){ ?>
    <tr height="23" onmouseover="this.className='on'" onmouseout="this.className='off'" style="cursor:default;">
    	<td> <img src="images/dot1.gif"/></td>
        <td colspan="3" style="padding:3px;"> 
        <div style="width:26px; height:22px; padding-top:1.5px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="admin/documents.php?superdocument=<?php echo $id_document; ?>" ><img src="images/new.png" border="0"  align="absmiddle" /></a> </div> <a href="admin/documents.php?superdocument=<?php echo $id_document; ?>" >Додадете нови поддокументи</a></td>
    </tr>
    <?php }  } ?>
</table>
<?php	} else {?>
<?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] == "admin"){ ?>
<div style="float:left"><a href="admin/documents.php?superdocument=<?php echo $id_document; ?>" ><img src="images/new.png" border="0"  align="absmiddle" /></a> </div> <a href="admin/documents.php?superdocument=<?php echo $id_document; ?>">&nbsp;Додадете нови поддокументи</a>
<?php } }  ?>
<?php } ?>

<?php	}?>

<?php
function getDocumentCategory($id_document_group, $pravo, $database_pravo){
	mysql_select_db($database_pravo, $pravo);
	//$id_doc_type_Documents = "1";
	$query_GroupDocuments = sprintf("SELECT * FROM doc_group WHERE
									id_doc_group = %s ORDER BY id_doc_group ASC", 
							GetSQLValueString($id_document_group, "int"));
	$GroupDocuments = mysql_query($query_GroupDocuments, $pravo) or die(mysql_error());
	//$row_GroupDocuments = mysql_fetch_assoc($GroupDocuments);
	//$tmp_number=0;
	$row_number =  mysql_num_rows($GroupDocuments);
	if($row_number){
		echo mysql_result($GroupDocuments,0,'name');
	}
}
?>

<table border="0" align="center" width="100%" cellpadding="3" cellspacing="0">
  <tr>
  <?php
  if (isset($rs_into_force) && !$rs_into_force) {
	  $into_force = FALSE;
  } else {
	  $into_force = TRUE;
  }
  ?>
    <td colspan="<?php echo $into_force ? "3" : "2" ?>" style="border-bottom:1px solid #a25852; background:#f5d6d4; padding-top:8px; padding-bottom:8px;"><div style="float:left; font-size:15px; font-variant:small-caps;"><strong><?php echo $document_title; ?></strong></div>
    <div style="float:right;"> 
	<?php if(isset($_SESSION['MM_UserGroup'])) { ?>
		
		<?php if($_SESSION['MM_UserGroup'] =="admin"){ ?>
		<div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="?<?php echo $_SERVER['QUERY_STRING']; ?>&subscribe=1"><img src="images/subscribe.png" border="0" title="Претплатете се кон овој закон за да добивате информации по email"  /></a></div>
        <?php if($id_type == '1') { ?><div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
         <a href="admin/documents.php?id_document=<?php echo $id_document; ?>&id_doc_type=<?php echo $id_type; ?>&id_doc_meta=<?php echo $id_meta; ?>&into_force=<?php echo $into_force ? '0' : '1'; ?>" onClick="return confirm('<?php echo 'Стави во'.($into_force ? 'н' : '').' сила?'; ?>')"><img src="images/into_force.png" border="0" title="Промена на статус" /></a></div><?php } ?>
         <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="admin/documents.php?id_document=<?php echo $id_document; ?>&id_doc_type=<?php echo $id_type; ?>&id_doc_meta=<?php echo $id_meta; ?>&delete=true" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="images/delete.png" border="0" title="Бриши"  /></a></div>
        <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
   <a href="admin/documents.php?id_document=<?php echo $id_document; ?>&edit=true"><img src="images/edit.png" border="0" title="Измени" /> </a></div>
    <?php } }  ?></div>
    </td>
    <?php if (!$into_force) { ?>
    <td style="border-bottom:1px solid #a25852; background:#f5d6d4;" align="center">
			<div style="color: red;"><strong>вон сила</strong></div></td><?php }
	?>
  </tr>
  <tr>
    <td width="38%">Датум на објавување:</td>
    <td width="42%"><?php if(isset($published_date)) echo date("d.m.Y",strtotime($published_date)); ?></td>
    <td width="20%" <?php if ($id_type == '1') echo 'rowspan="4"'; else echo 'rowspan="2"'; ?> align="right"><a href="download.php?id=<?php echo $id_document; ?>"><?php if($mime_type=="application/msword"){ ?><img src="images/word_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /> <?php }elseif($mime_type=="text/plain"){ ?><img src="images/text_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php }else{ ?><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php } ?></a><br><span style="font-size:10px; color:#999;"><?php echo (($no_downloads == 0 ? 'Сеуште не е симнат' : ($no_downloads == 1 ? 'Еднаш симнат' : $no_downloads.' пати симнат'))); ?></span></td>
  </tr>
<!--  <tr>
    <td>Датум на закачување:</td>
    <td><?php if(isset($uploaded_date)) echo date("d.m.Y",strtotime($uploaded_date)); ?></td>
  </tr>
-->
  <?php if ($id_type == '1') { ?>
  <tr>
    <td>Датум на стапување во сила:</td>
    <td><?php if(isset($into_force_date)) echo date("d.m.Y",strtotime($into_force_date)); ?>&nbsp;</td>
  </tr>
  <tr>
    <td>Сл. весник/година:</td>
    <td><?php if(isset($meta_ordinal)) echo $meta_ordinal; ?>/<?php echo date("Y",strtotime($meta_date)); ?>&nbsp;</td>
  </tr>
  <tr></tr>
  <tr>
  <?php } ?>
    <td valign="top">Категорија:</td>
    <td colspan="2"><?php 
	for ($i = 0; $i < $numRows_DocGroup; $i++) {
		$row_DocGroup = mysql_fetch_assoc($DocGroup);
		echo "<a href='".$page."?id_doc_group=".$row_DocGroup['id_doc_group']."'>".$row_DocGroup['name']."</a>".($i < $numRows_DocGroup - 1 ? " &raquo; " : ""); 
	}
	?></td>
  </tr>
  <tr>
    <td>Забелешка:</td>
    <td colspan="2"><?php echo $document_description; ?></td>
  <tr>
  <tr>
    <td valign="top">Клучни зборови:</td>
    <td colspan="2"><?php foreach ($keywords as $keyword) {
		echo "<a href='".$page."?keyword=".urlencode($keyword)."'>".$keyword."</a>, ";
	} ?></td>
  <tr>
    <td colspan="3"><?php getSubDocuments($id_document, $id_type, $pravo, $database_pravo); ?></td>
  </tr>
</table>
<br /> <br />
<div align="center">
<div style="border-top:1px dotted #999; width:95%;" align="center">&nbsp;</div>
</div>
<?php include("document_discussion.php"); ?>
<?php
if(isset($_SESSION['download_id'])){
	$document_id_for_download = $_SESSION['download_id'];
	$_SESSION['download_id'] = NULL;
	unset($_SESSION['download_id']);
	echo "<script>document.location.href='download.php?id=".$document_id_for_download."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";	
	
}
?>