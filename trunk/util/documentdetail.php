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
$query_DetailRS1 = sprintf("SELECT * FROM `document` WHERE id_document = %s", GetSQLValueString($colname_DetailRS1, "-1"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $pravo) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

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
	$query_SubDocuments = sprintf("SELECT * FROM `document` WHERE id_doc_type = %s and id_superdoc is not null and id_superdoc=%s ORDER BY title ASC", GetSQLValueString($id_doc_type_Documents, "int"),GetSQLValueString($id_document, "int"));
	$SubDocuments = mysql_query($query_SubDocuments, $pravo) or die(mysql_error());
	$row_SubDocuments = mysql_fetch_assoc($SubDocuments);
	$tmp_number=0;
?>
<?php if(mysql_num_rows($SubDocuments)!=0){ ?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
    <td colspan="3" style="border-bottom:1px solid #f5e6a2; background:#fbf7e0;"><strong>Измени и дополнувања</strong></td>
  <tr>
  <?php  
	  do { 	$timestamp = strtotime($row_SubDocuments['published_date']); ?>
    <tr onmouseover="this.className='on'" onmouseout="this.className='off'" style="cursor:default;">
      <td width="4%" valign="top">
       <?php if($tmp_number<mysql_num_rows($SubDocuments)-1) {?>
	      <img src="images/dot_cros.png"/>
      <?php }else{ ?>
            <img src="images/dot1.gif"/>
      <?php }?>
      </td>
      <td width="91%">&nbsp;<?php echo $row_SubDocuments['title']; ?><br>
      <span style="color:#666; font-size:11px">&nbsp;&nbsp;<?php echo date("d.m.Y", $timestamp); ?>&nbsp;</span></td>
      
      <td width="5%" align="right"><a href="util/download.php?id=<?php echo $row_SubDocuments['id_document']; ?> "><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a></td>
    </tr>
    <?php $tmp_number+=1;} while ($row_SubDocuments = mysql_fetch_assoc($SubDocuments)); ?>
</table>
<?php	} ?>
<?php	}?>

<?php
function getDocumentCategory($id_document_group, $pravo, $database_pravo){
	mysql_select_db($database_pravo, $pravo);
	$id_doc_type_Documents = "1";
	$query_GroupDocuments = sprintf("SELECT * FROM doc_group WHERE
									id_doc_group = %s", 
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

<table border="0" align="center" width="100%">
  <tr>
    <td colspan="3" style="border-bottom:1px solid #a25852; background:#f5d6d4;"><strong><?php echo $row_DetailRS1['title']; ?></strong></td>
    
  </tr>
  <tr>
    <td width="27%">Дата на публикување:</td>
    <td width="53%"><?php if(isset($row_DetailRS1['published_date'])) echo date("d.m.Y",strtotime($row_DetailRS1['published_date'])); ?></td>
    <td width="20%" rowspan="4" align="right"><a href="download.php?id=<?php echo $row_DetailRS1['id_document']; ?>"><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a><br><span style="font-size:10px; color:#999;">12312 пати спуштено</span></td>
  </tr>
  <tr>
    <td>Дата на закачување:</td>
    <td><?php echo date("d.m.Y",strtotime($row_DetailRS1['uploaded_date'])); ?></td>
  </tr>
  <tr>
    <td>Категорија</td>
    <td><?php getDocumentCategory($row_DetailRS1['id_doc_group'], $pravo, $database_pravo); ?></td>
  </tr>
  <tr>
    <td>Краток опис:</td>
    <td><?php echo $row_DetailRS1['description']; ?></td>
  <tr>
    <td colspan="3"><?php getSubDocuments($row_DetailRS1['id_document'], $pravo, $database_pravo); ?></td>
  </tr>
</table>
<br /> <br />
<table width="80%" border="0" >
	<tr>
    	<td style="padding-left:10px;"><strong>Дискусии околу овој закон</strong></td>
    </tr>
	<tr>
	  <td style="padding:10px; border-bottom:1px solid #f5e6a2; background:#fbf7e0;"><label>
	    <textarea name="textarea" id="textarea" cols="50" rows="4" style="border:1px solid #f5e6a2;"></textarea>
        <br>        
	  </label>
      <div><input type="button" value="Коментирај" style="background-color:#993300; color:#FFFFFF"></div>
      </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
</table>
<?php
mysql_free_result($DetailRS1);
?>