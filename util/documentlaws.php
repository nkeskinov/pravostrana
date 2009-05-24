<?php



$currentPage = $_SERVER["PHP_SELF"];


$maxRows_Documents = 10;
$pageNum_Documents = 0;
if (isset($_GET['pageNum_Documents'])) {
  $pageNum_Documents = $_GET['pageNum_Documents'];
}
$startRow_Documents = $pageNum_Documents * $maxRows_Documents;

$id_doc_type_Documents = "1";
if (isset($_GET['id_doc_group'])) {
  $id_doc_group_Documents = $_GET['id_doc_group'];
}
mysql_select_db($database_pravo, $pravo);
$query_Documents = sprintf("SELECT * FROM `document` WHERE id_doc_type= %s and id_superdoc is null ", GetSQLValueString($id_doc_type_Documents, "int"));
if(isset($_GET['id_doc_group']) && $_GET['id_doc_group']!=0){
		$query_Documents = sprintf("%s and id_doc_group=%s",$query_Documents,GetSQLValueString($_GET['id_doc_group'], "int"));
}
if(isset($_GET['name'])){
	$query_Documents = sprintf("%s and title like %s",$query_Documents,GetSQLValueString("%".$_GET['name']."%", "text"));
}
$query_limit_Documents = sprintf("%s ORDER BY title ASC LIMIT %d, %d", $query_Documents, $startRow_Documents, $maxRows_Documents);
$Documents = mysql_query($query_limit_Documents, $pravo) or die(mysql_error());
$row_Documents = mysql_fetch_assoc($Documents);

if (isset($_GET['totalRows_Documents'])) {
  $totalRows_Documents = $_GET['totalRows_Documents'];
} else {
  $all_Documents = mysql_query($query_Documents);
  $totalRows_Documents = mysql_num_rows($all_Documents);
}
$totalPages_Documents = ceil($totalRows_Documents/$maxRows_Documents)-1;

$queryString_Documents = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Documents") == false && 
        stristr($param, "totalRows_Documents") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Documents = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Documents = sprintf("&totalRows_Documents=%d%s", $totalRows_Documents, $queryString_Documents);


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
      
      <td width="5%" align="right"><a href="download.php?id=<?php echo $row_SubDocuments['id_document']; ?> "><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a></td>
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

<?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] =="admin"){ ?>
   <div align="center">
   <form action="admin/documents.php">
   	<input type="submit" value="Внеси нов" />
   </form>
   </div>
    <?php } }  ?>

<table border="0" width="100%" cellspacing="0">
<tr>
    	<td width="70%">Закони <?php echo ($startRow_Documents + 1) ?> до <?php echo min($startRow_Documents + $maxRows_Documents, $totalRows_Documents) ?> од <?php echo $totalRows_Documents ?></td>
    	<td width="30%" align="right">
          <table border="0" style="font-size:11px;">
            <tr>
              <td><?php if ($pageNum_Documents > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, 0, $queryString_Documents); ?>">&lt;&lt;Прва</a>
                  <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_Documents > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, max(0, $pageNum_Documents - 1), $queryString_Documents); ?>">&lt;Претходна</a>
                  <?php } // Show if not first page ?></td>
                  
              <td><?php if ($pageNum_Documents < $totalPages_Documents) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, min($totalPages_Documents, $pageNum_Documents + 1), $queryString_Documents); ?>">Следна&gt;</a>
                  <?php } // Show if not last page ?></td>
              <td><?php if ($pageNum_Documents < $totalPages_Documents) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, $totalPages_Documents, $queryString_Documents); ?>">Последна&gt;&gt;</a>
                  <?php } // Show if not last page ?></td>
            </tr>
        </table></td>
    </tr>
</table>
<table border="0" width="100%" cellspacing="0">
	
  <?php do { 
  	$timestamp = strtotime($row_Documents['uploaded_date']); 
  ?>
    <tr>
      <td width="95%" style="border-bottom:1px solid #a25852; background:#f5d6d4;"><strong><a href="documentDetail.php?id=<?php echo $row_Documents['id_document']; ?>" title="Видете ги деталите за законот" alt="Видете ги деталите за законот"><?php echo $row_Documents['title']; ?></a></strong><br> <span style="color:#666; font-size:11px">&nbsp;<?php echo date("d.m.Y", $timestamp); ?>&nbsp;<?php echo date("G:i", $timestamp); ?></span></td>
      <td width="5%" align="right" style="border-bottom:1px solid #a25852; background:#f5d6d4;"><a href="download.php?id=<?php echo $row_Documents['id_document']; ?>"><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a></td>
    </tr>
    <tr>
    	<td colspan="2"><?php getSubDocuments($row_Documents['id_document'], $pravo, $database_pravo); ?></td>
    </tr>
    <tr>
    	<td  style="border-bottom:1px solid #f5e6a2; background:#fbf7e0;" colspan="2">категорија: <?php getDocumentCategory($row_Documents['id_doc_group'], $pravo, $database_pravo); ?></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <?php } while ($row_Documents = mysql_fetch_assoc($Documents)); ?>
    
</table>
<?php
mysql_free_result($Documents);
?>