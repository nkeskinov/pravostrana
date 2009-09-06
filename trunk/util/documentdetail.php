<?php
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['id'])) {
  $colname_DetailRS1 = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_DetailRS1 = sprintf("SELECT * FROM document left join doc_meta on document.id_doc_meta = doc_meta.id_doc_meta WHERE document.id_document = %s", GetSQLValueString($colname_DetailRS1, "-1"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $pravo) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);


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
						",GetSQLValueString($row_DetailRS1['id_doc_group'],"int"),GetSQLValueString($row_DetailRS1['id_doc_group'],"int"),GetSQLValueString($row_DetailRS1['id_doc_group'],"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
$row_DocGroup = mysql_fetch_assoc($DocGroup);
//print_r($row_DocGroup);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?>
<?php
function getSubDocuments($id_document, $pravo, $database_pravo){
	mysql_select_db($database_pravo, $pravo);
	$id_doc_type_Documents = "1";
	$query_SubDocuments = sprintf("SELECT * FROM document left join doc_meta on document.id_doc_meta = doc_meta.id_doc_meta WHERE document.id_doc_type = %s and document.id_superdoc is not null and document.id_superdoc=%s ORDER BY published_date ASC", GetSQLValueString($id_doc_type_Documents, "int"),GetSQLValueString($id_document, "int"));
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
      <a href="admin/documents.php?id=<?php echo $row_SubDocuments['id_document']; ?>&edit=true&superdocument=<?php echo $id_document; ?>" title="Измени"><img src="images/edit.png" border="0"  /></a
      ></div></div><?php } }  ?>
      </div>
      </td>
      
      <td width="20%" align="right"><a href="download.php?id=<?php echo $row_SubDocuments['id_document']; ?> "><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><br><span style="font-size:10px; color:#999;"><?php getNumDownload($row_SubDocuments['id_document'], $pravo, $database_pravo); ?> пати спуштено</span></a></td>
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
	$id_doc_type_Documents = "1";
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
<?php
function getNumDownload($id_document, $pravo, $database_pravo){
	mysql_select_db($database_pravo, $pravo);
	$query_GroupDocuments = sprintf("SELECT count(*) as nb FROM download WHERE
									id_document = %s", 
							GetSQLValueString($id_document, "int"));
	$GroupDocuments = mysql_query($query_GroupDocuments, $pravo) or die(mysql_error());
	//$row_GroupDocuments = mysql_fetch_assoc($GroupDocuments);
	//$tmp_number=0;
	$row_number =  mysql_num_rows($GroupDocuments);
	if($row_number){
		echo mysql_result($GroupDocuments,0,'nb');
	}
}
?>

<table border="0" align="center" width="100%" cellpadding="3">
  <tr>
    <td colspan="3" style="border-bottom:1px solid #a25852; background:#f5d6d4;"><div style="float:left; font-size:15px; font-variant:small-caps; "><strong><?php echo $row_DetailRS1['title']; ?></strong></div>
    <div style="float:right;"> <?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] =="admin"){ ?>
       <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="admin/documents.php?id=<?php echo $row_DetailRS1['id_document']; ?>&id_doc_type=<?php echo $row_DetailRS1['id_doc_type']; ?>&id_doc_meta=<?php echo $row_DetailRS1['id_doc_meta']; ?>&delete=true" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="images/delete.png" border="0" title="Бриши"  /></a></div>
        <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
   <a href="admin/documents.php?id=<?php echo $row_DetailRS1['id_document']; ?>&edit=true"><img src="images/edit.png" border="0" title="Измени" /> </a></div>
    <?php } }  ?></div>
    </td>
  </tr>
  <tr>
    <td width="38%">Датум на објавување:</td>
    <td width="42%"><?php if(isset($row_DetailRS1['published_date'])) echo date("d.m.Y",strtotime($row_DetailRS1['published_date'])); ?></td>
    <td width="20%" <?php if ($row_DetailRS1['id_doc_type'] == '1') echo 'rowspan="4"'; else echo 'rowspan="2"'; ?> align="right"><a href="download.php?id=<?php echo $row_DetailRS1['id_document']; ?>"><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a><br><span style="font-size:10px; color:#999;"><?php getNumDownload($row_DetailRS1['id_document'], $pravo, $database_pravo); ?> пати спуштено</span></td>
  </tr>
  <tr>
    <td>Датум на закачување:</td>
    <td><?php if(isset($row_DetailRS1['uploaded_date'])) echo date("d.m.Y",strtotime($row_DetailRS1['uploaded_date'])); ?></td>
  </tr>
  <?php if ($row_DetailRS1['id_doc_type'] == '1') { ?>
  <tr>
    <td>Датум на стапување во сила:</td>
    <td><?php if(isset($row_DetailRS1['into_force_date'])) echo date("d.m.Y",strtotime($row_DetailRS1['into_force_date'])); ?>&nbsp;</td>
  </tr>
  <tr>
    <td>Сл. весник/година:</td>
    <td><?php if(isset($row_DetailRS1['ordinal'])) echo $row_DetailRS1['ordinal']; ?>/<?php echo date("Y",strtotime($row_DetailRS1['date'])); ?>&nbsp;</td>
  </tr>
  <tr>
  <?php } ?>
    <td valign="top">Категорија:</td>
    <td colspan="2"><?php do{ echo $row_DocGroup['name']." &raquo; "; }while ($row_DocGroup = mysql_fetch_assoc($DocGroup)); ?></td>
  </tr>
  <tr>
    <td>Забелешка:</td>
    <td colspan="2"><?php echo $row_DetailRS1['description']; ?></td>
  <tr>
    <td colspan="3"><?php getSubDocuments($row_DetailRS1['id_document'], $pravo, $database_pravo); ?></td>
  </tr>
</table>
<br /> <br />
<div align="center">
<div style="border-top:1px dotted #999; width:95%;" align="center">&nbsp;</div>
</div>
<?php include("document_discussion.php"); ?>
<?php
mysql_free_result($DetailRS1);
?>