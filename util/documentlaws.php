<?php



$currentPage = $_SERVER["PHP_SELF"];

$sort_order="asc";
if(isset($_POST['desc']))
	$sort_order="desc";
else
	$sort_order="asc";
	
$sort="title";
if(isset($_POST['sort']) && $_POST['sort']!=""){
	$sort=$_POST['sort'];
}
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
$query_Documents = sprintf("SELECT * FROM document left join doc_meta on document.id_doc_meta = doc_meta.id_doc_meta WHERE document.id_doc_type= %s and document.id_superdoc is null ", GetSQLValueString($id_doc_type_Documents, "int"));
if(isset($_GET['id_doc_group']) && $_GET['id_doc_group']!=0){
		$query_Documents = sprintf("%s and id_doc_group=%s",$query_Documents,GetSQLValueString($_GET['id_doc_group'], "int"));
}
if(isset($_GET['name'])){
	$query_Documents = sprintf("%s and title like %s",$query_Documents,GetSQLValueString("%".$_GET['name']."%", "text"));
}

$query_limit_Documents = sprintf("%s ORDER BY %s %s LIMIT %d, %d", $query_Documents, $sort,$sort_order,$startRow_Documents, $maxRows_Documents);

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

   <div align="left" style=" margin-left:-5px; height:22px; margin-top:-15px; width:512px;border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
   <?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] =="admin"){ ?>
   <div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="admin/documents.php"><img src="images/new.png" border="0" title="Нов документ" /></a></div>
        <?php } }  ?>
        <div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="#"><img src="images/print.png" border="0" title="Печати страна" /></a></div> 
   </div>
<br />
<table border="0" width="100%" cellspacing="0">
	<tr>
    	<td width="31%">Закони <?php echo ($startRow_Documents + 1) ?> до <?php echo min( $startRow_Documents + $maxRows_Documents, $totalRows_Documents) ?> од <?php echo $totalRows_Documents ?>
        </td>
        <td align="right">
        <div style="float:right">
        	<div style="float:left">
            <form method="post" action="<?php printf("%s?%s", $currentPage,$_SERVER['QUERY_STRING']); ?>">
            <table><tr><td>
            <?php if(isset($_POST['desc']) ){?>
            <input type="image" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','images/sort-up.png',1)"src="images/sort-down.png" name="Image1" width="12" height="12" border="0" id="Image1" title="Сортирај во растечки редослед"/>
            
            <input type="hidden" name="asc" />
            <?php } ?>
            <?php if(isset($_POST['asc']) || isset($_POST['sort1'])){?>
             <input type="image" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/sort-down.png',1)"src="images/sort-up.png" name="Image2" width="12" height="12" border="0" id="Image2" title="Сортирај во опаѓачки редослед"/>
            <input type="hidden" name="desc" />
            <?php } ?>
            </td><td>
              <select name="sort" id="sort" onchange="this.form.submit();">
                <option>сортирај</option>
                <option value="title" <?php if(isset($_POST['sort']) && !(strcmp($_POST['sort'],"title" ))) {echo "SELECTED";} ?>>наслов</option>
                <option value="uploaded_date" <?php if(isset($_POST['sort']) && !(strcmp($_POST['sort'],"uploaded_date" ))) {echo "SELECTED";} ?>>дата</option>
                
              </select>
              <?php if(!isset($_POST['sort'])){ ?>
              <input type="hidden" name="sort1" />
              <?php } ?>
              |
            </td></tr></table></form>
            </div><div style="float:left">
        	<table border="0" cellspacing="0" style="font-size:12px;">
            <tr>
              <td ><?php if ($pageNum_Documents > 0  ) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, max(0, $pageNum_Documents - 1), $queryString_Documents); ?>"><img src="images/pPrev.png" border="0"/></a>
                  <?php }else{ // Show if not first page ?>
                  
                  		<img src="images/pPrevDisabled.png" border="0"/>
                  <?php } ?>
              </td>
              <td>
              	<?php $l=$pageNum_Documents-4;
					  $h=$pageNum_Documents+4;
					  //echo "l=".$l;
					  if($l<0) $l=0;
					  if($h<7 && $h<$totalPages_Documents) $h=7;
					  if($h>$totalPages_Documents){
						  $h=$totalPages_Documents;
						  $l=$h-7;
						  if($l<0)$l=0;
					  }
					  if ($h >7 && $l>0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, 0, $queryString_Documents); ?>"><?php echo '<u>'; echo 1; echo '</u>';?></a>...

				  <?php }
					for($i=$l;$i<=$h; $i++){
						
						if($i == $pageNum_Documents){ 
							echo "<b>[";
							echo $i+1;
							echo "]</b>";
						}elseif($i<=$h){ ?>
								<a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, $i, $queryString_Documents); ?>"><?php echo '<u>'; echo $i+1; echo '</u>';?></a>
						
						<?php }
					}
				?>
                
                <?php if ($pageNum_Documents < $totalPages_Documents && ($h-$l)>=7) { // Show if not last page ?>...
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, $totalPages_Documents, $queryString_Documents); ?>"><?php echo '<u>'; echo $totalPages_Documents+1; echo '</u>';?></a>
                  <?php } // Show if not last page ?>
              </td>
              <td ><?php if ($pageNum_Documents < $totalPages_Documents) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, min($totalPages_Documents, $pageNum_Documents + 1), $queryString_Documents); ?>"><img src="images/pNext.png" border="0"/></a>
                  <?php }else{ ?>
					  <img src="images/pNextDisabled.png" border="0"/>
				 <?php }// Show if not last page ?>
              </td>
            </tr>
        </table>
        </div>
        </div>
     </td>
    </tr>
</table>
<table border="0" width="100%" cellspacing="0">
	
  <?php do { 
  	$timestamp = strtotime($row_Documents['uploaded_date']); 
  ?>
    <tr>
      <td width="95%" style="border-bottom:1px solid #a25852; background:#f5d6d4;"><strong><a href="documentDetail.php?id=<?php echo $row_Documents['id_document']; ?>" title="Видете ги деталите за законот" alt="Видете ги деталите за законот"><?php echo $row_Documents['title']; ?></a></strong><br> <span style="color:#666; font-size:11px">&nbsp;<?php echo date("d.m.Y", $timestamp); ?>&nbsp;<?php echo date("G:i", $timestamp); ?></span> |<span style="color:#666; font-size:11px"> Сл. весник/година:</span> <span style="font-size:11px; font-weight:bold;"><?php echo $row_Documents['ordinal']; ?></span>/<span style="font-size:11px; font-weight:bold;"><?php echo date("Y",strtotime($row_Documents['date'])); ?></span></td>
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
<table border="0" width="100%" cellspacing="0">
<tr>
    	<td width="50%">Закони <?php echo ($startRow_Documents + 1) ?> до <?php echo min($startRow_Documents + $maxRows_Documents, $totalRows_Documents) ?> од <?php echo $totalRows_Documents ?></td>
    	<td width="50%" align="right">
          <table border="0" style="font-size:12px;">
            <tr>
              
              <td ><?php if ($pageNum_Documents > 0  ) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, max(0, $pageNum_Documents - 1), $queryString_Documents); ?>"><img src="images/pPrev.png" border="0"/></a>
                  <?php }else{ // Show if not first page ?>
                  
                  		<img src="images/pPrevDisabled.png" border="0"/>
                  <?php } ?></td>
              <td >
              	<?php $l=$pageNum_Documents-4;
					  $h=$pageNum_Documents+4;
					  //echo "l=".$l;
					  if($l<0) $l=0;
					  if($h<7 && $h<$totalPages_Documents) $h=7;
					  if($h>$totalPages_Documents){
						  $h=$totalPages_Documents;
						  $l=$h-7;
						  if($l<0)$l=0;
					  }
					  if ($h >7 && $l>0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, 0, $queryString_Documents); ?>"><?php echo '<u>'; echo 1; echo '</u>';?></a>...

				  <?php }
					for($i=$l;$i<=$h; $i++){
						
						if($i == $pageNum_Documents){ 
							echo "<b>[";
							echo $i+1;
							echo "]</b>";
						}elseif($i<=$h){ ?>
								<a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, $i, $queryString_Documents); ?>"><?php echo '<u>'; echo $i+1; echo '</u>';?></a>
						
						<?php }
					}
				?>
                <?php if ($pageNum_Documents < $totalPages_Documents && ($h-$l)>=7) { // Show if not last page ?>...
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, $totalPages_Documents, $queryString_Documents); ?>"><?php echo '<u>'; echo $totalPages_Documents+1; echo '</u>';?></a>
                  <?php } // Show if not last page ?></td>

            </td> 
              <td ><?php if ($pageNum_Documents < $totalPages_Documents) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, min($totalPages_Documents, $pageNum_Documents + 1), $queryString_Documents); ?>"><img src="images/pNext.png" border="0"/></a>
                  <?php }else{ ?>
					  <img src="images/pNextDisabled.png" border="0"/>
				 <?php }// Show if not last page ?></td>
              
            </tr>
        </table></td>
    </tr>
</table>
<?php
mysql_free_result($Documents);
?>
