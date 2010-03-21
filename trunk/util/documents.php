<?php
$selfArray = explode('/',$_SERVER['PHP_SELF']);
$currentPage = $selfArray[count($selfArray)-1];
//$currentPage = $_SERVER["PHP_SELF"];

$sort_order="desc";
//to be replaced by a single call to $_REQUEST
if(isset($_REQUEST['asc'])) {
	$sort_order="asc";
}
//else
//	$sort_order="asc";
	
$sort="published_date";
$default_sort = false;
//to be replaced by a single call to $_REQUEST
if(isset($_REQUEST['sort']) && strcmp($_REQUEST['sort'], "")) {
	$sort=$_REQUEST['sort'];
} else {
	$default_sort = true;
}
$maxRows_Documents = 10;
$pageNum_Documents = 0;
if (isset($_GET['pageNum_Documents'])) {
  $pageNum_Documents = $_GET['pageNum_Documents'];
}
$startRow_Documents = $pageNum_Documents * $maxRows_Documents;

//$id_doc_type_Documents = "1";
if (isset($_GET['id_doc_group'])) {
  $id_doc_group_Documents = $_GET['id_doc_group'];
}
mysql_select_db($database_pravo, $pravo);
$id_doc_group=-1;
if(isset($_GET['subsubcategory']) && $_GET['subsubcategory']!=0 ){
	$id_doc_group=$_GET['subsubcategory'];
}elseif(isset($_GET['subcategory']) && $_GET['subcategory']!=0){
	$id_doc_group=$_GET['subcategory'];
}elseif(isset($_GET['category']) && $_GET['category']!=0)
	$id_doc_group=$_GET['category'];

if(isset($_GET['subcategory1']) && $_GET['subcategory1']!=0){
	$id_doc_group=$_GET['subcategory1'];
}elseif(isset($_GET['category1']) && $_GET['category1']!=0)
	$id_doc_group=$_GET['category1'];
	
if(isset($_GET['id_doc_group']))
	$id_doc_group=$_GET['id_doc_group'];
//echo $id_doc_group;
$query_Documents = sprintf("SELECT DISTINCT document. * ,document.published_date as published_date2, doc_meta. *
							FROM document
							LEFT JOIN doc_meta ON document.id_doc_meta = doc_meta.id_doc_meta
							LEFT JOIN document_has_keyword dhk ON document.id_document = dhk.id_document
							LEFT JOIN keyword k ON k.id_keyword = dhk.id_keyword
							LEFT JOIN doc_group dg ON document.id_doc_group = dg.id_doc_group
							WHERE document.id_doc_type =%s
							AND document.id_superdoc IS NULL ", GetSQLValueString($id_doc_type_Documents, "int"));
if($id_doc_group!=-1 && $id_doc_group!=0){
		$query_Documents = sprintf("%s AND dg.id_doc_group =%s
									OR dg.id_supergroup =%s
									OR id_supergroup
									IN (
									SELECT id_doc_group
									FROM doc_group
									WHERE id_supergroup =%s
									)
								   ",$query_Documents,GetSQLValueString($id_doc_group, "int"),GetSQLValueString($id_doc_group, "int"),GetSQLValueString($id_doc_group, "int"));
}
if(isset($_GET['name']) && $_GET['name']!=""){
	$query_Documents = sprintf("%s AND lower(title) LIKE %s ",$query_Documents,GetSQLValueString("%".$_GET['name']."%", "text"));
}
if(isset($_GET['year']) && $_GET['year']!="" ){
	$query_Documents = sprintf("%s AND YEAR(doc_meta.`date`)=%s ",$query_Documents,GetSQLValueString($_GET['year'], "text"));
}
if(isset($_GET['year1']) && $_GET['year1']!="" ){
	$query_Documents = sprintf("%s AND YEAR(document.`published_date`)=%s ",$query_Documents,GetSQLValueString($_GET['year1'], "text"));
}
if(isset($_GET['number']) && $_GET['number']!=""){
	//echo"1".$_GET['number']."number";
	$query_Documents = sprintf("%s AND doc_meta.ordinal=%s ",$query_Documents,GetSQLValueString($_GET['number'], "int"));
}
if(isset($_GET['court']) && $_GET['court']!=0){
	//echo $_GET['court'];
	$query_Documents = sprintf("%s AND doc_meta.id_doc_meta=%s ",$query_Documents,GetSQLValueString($_GET['court'], "int"));
}
if(isset($_GET['starts_with'])){
	$query_Documents = sprintf("%s AND lower(idx)=%s ",$query_Documents,GetSQLValueString($_GET['starts_with'], "text"));
	//echo $query_Documents;
}
//echo lat2cyr($_GET['starts_with']);
//echo html_entity_decode($_GET['starts_with'],null,'UTF-8');
if(isset($_GET['keyword'])){
	$keywords_arr=explode(",", urldecode($_GET['keyword']));
//	print_r($keywords_arr);
	$keyQuery=" AND ";
	foreach($keywords_arr as $key){
		$key1=str_replace("\n","",str_replace("\t","",$key));
		//echo "pos ".strpos($key1," ");
		if(strpos($key1," ")==0 && strpos($key1," ")!=NULL){
			$key1=substr($key1,1);		
		}
		$keyQuery.=sprintf("lower(k.val) LIKE %s OR ",GetSQLValueString("%".$key1."%","text"));
	}
	$keyQuery=substr($keyQuery,0,-3);
	$query_Documents = sprintf("%s %s",$query_Documents,$keyQuery);
	
	//echo $query_Documents;
}
$query_limit_Documents = sprintf("%s ORDER BY ".($default_sort ? "document.title asc, " : "")."%s %s LIMIT %d, %d", $query_Documents, $sort,$sort_order,$startRow_Documents, $maxRows_Documents);

$Documents = mysql_query($query_limit_Documents, $pravo) or die(mysql_error());
$row_Documents = mysql_fetch_assoc($Documents);

if (isset($_GET['totalRows_Documents'])) {
  $totalRows_Documents = $_GET['totalRows_Documents'];
} else {
  $all_Documents = mysql_query($query_Documents);
  $totalRows_Documents = mysql_num_rows($all_Documents);
  	mysql_free_result($all_Documents);
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
function getSubDocuments($id_document, $pravo, $database_pravo,$gid, $page){
	mysql_select_db($database_pravo, $pravo);
	$id_doc_type_Documents = "1";
	$query_SubDocuments = sprintf("SELECT * FROM document left join doc_meta on document.id_doc_meta = doc_meta.id_doc_meta WHERE document.id_doc_type = %s and document.id_superdoc is not null and document.id_superdoc=%s ORDER BY published_date ASC", GetSQLValueString($id_doc_type_Documents, "int"),GetSQLValueString($id_document, "int"));
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
      <span style="color:#666; font-size:10px">&nbsp;&nbsp;<?php echo date("d.m.Y", $timestamp); ?>&nbsp; <?php //|</span><span style="color:#666; font-size:10px"> Сл. весник / година:</span> <span style="font-size:10px;"><?php echo $row_SubDocuments['ordinal']."/".date("Y",strtotime($row_SubDocuments['date'])); ?></span></td>
      
      <td width="5%" align="right"><a href="documentDetail.php?id=<?php echo $id_document; ?>" title="Преземи го документот"><?php if($row_SubDocuments['mimetype']=="application/msword"){ ?><img src="images/word_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /> <?php }elseif($row_SubDocuments['mimetype']=="text/plain"){ ?><img src="images/text_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php }else{ ?><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php } ?></a></td>
    </tr>
    <?php $tmp_number+=1;} while ($row_SubDocuments = mysql_fetch_assoc($SubDocuments)); ?>
</table>
<?php	}
	mysql_free_result($SubDocuments); ?>
<?php	}?>
<?php
function getDocumentCategory($id_document_group, $pravo, $database_pravo){
	
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
						",GetSQLValueString($id_document_group,"int"),GetSQLValueString($id_document_group,"int"),GetSQLValueString($id_document_group,"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
$row_DocGroup = mysql_fetch_assoc($DocGroup);
$row_number =  mysql_num_rows($DocGroup);
if($row_number){
	$i=0;
	do{ 
		echo "<a href='?id_doc_group=".$row_DocGroup['id_doc_group']."'>".$row_DocGroup['name']."</a> "; 
		if($i<$row_number-1){
			echo "&raquo;&nbsp;";
		}
	$i++;
	}while ($row_DocGroup = mysql_fetch_assoc($DocGroup));
}
mysql_free_result($DocGroup);
}
?>
   <div align="left" style="height:22px; margin-top:-15px; width:512px; border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
   <?php if(isset($_SESSION['MM_UserGroup'])) {
		if($_SESSION['MM_UserGroup'] =="admin"){ ?>
   <div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="admin/documents.php"><img src="images/new.png" border="0" title="Нов документ" /></a></div>
        <?php } }  ?>
        <div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="#" onclick="window.print() "><img src="images/print.png" border="0" title="Печати страна" /></a></div> 
   </div>
<br />
<?php if(mysql_num_rows($Documents)!=0){ ?>
<table border="0" width="100%" cellspacing="0">
	<tr>
    	<td width="45%" style="padding-bottom:5px; vertical-align:bottom;">Документи <?php echo ($startRow_Documents + 1) ?> до <?php echo min( $startRow_Documents + $maxRows_Documents, $totalRows_Documents) ?> од <?php echo $totalRows_Documents ?>
        </td>
        <td width="55%" align="right">
        <div style="float:right; width:100%; text-align:right;">
        <div style="float:right">
            <form method="post" action="<?php printf("%s?%s", $currentPage,$_SERVER['QUERY_STRING']); ?>">
            <table width="100%" align="right"><tr><td>
            <?php if(!$default_sort) { ?>
            <?php if(!strcmp($sort_order, "desc")){?>
            <input type="image" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','images/sort-up.png',1)" src="images/sort-down.png" name="asc" value="true" width="12" height="12" border="0" id="Image1" title="Подреди во растечки редослед"/><?php } ?><?php if(!strcmp($sort_order, "asc")){?>
             <input type="image" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/sort-down.png',1)" src="images/sort-up.png" name="desc" value="true" width="12" height="12" border="0" id="Image2" title="Подреди во опаѓачки редослед"/><?php } ?>
             <?php } ?>
            </td><td style="font-size:15px;">
              <select name="sort" id="sort" onchange="this.form.submit();">
                <option value="">подреди</option>
                <option value="title" <?php if(!$default_sort && !strcmp($sort,"title")) {echo 'selected="selected"';} ?>>наслов</option>
                <option value="published_date" <?php if(!$default_sort && !strcmp($sort,"published_date")) {echo 'selected="selected"';} ?>>датум на објавување</option>
                <?php if(!strcmp($page, "documentlaws.php")){ ?>
                <option value="published_date2" <?php if(!$default_sort && !strcmp($sort,"published_date2")) {echo 'selected="selected"';} ?>>сл. весник/година</option>
                <?php } ?>
              </select></td></tr></table></form>
          </div>
          <div style="float:right;">
            <table border="0" cellpadding="5" cellspacing="0" style="font-size:12px;" >
              <tr>
                <td>
                <?php //TODO!!! Fix the POST/GET discrepancy
					  if (isset($_GET['sort']) && isset($_POST['sort'])) {
					  	$queryString_Documents = str_replace('sort='.$_GET['sort'], 'sort='.$_POST['sort'], $queryString_Documents); 									
					  }
				      $sort_query_string = $default_sort || isset($_GET['sort']) ? '' : '&sort='.$sort;
					  if (isset($_GET['asc']) && isset($_POST['desc'])) {
						$queryString_Documents = str_replace('&asc=true', '', $queryString_Documents);
						$queryString_Documents = str_replace('asc=true', '', $queryString_Documents);
					  }
					  $sort_query_string .= !strcmp($sort_order, 'desc') || isset($_GET['asc']) ? '' : '&asc=true';
			    ?>
				<?php if ($pageNum_Documents > 0  ) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s".$sort_query_string, $currentPage, max(0, $pageNum_Documents - 1), $queryString_Documents); ?>"><img src="images/pPrev.png" border="0" width="19" height="19"/></a>
                  <?php }else{ // Show if not first page ?>
                  <img src="images/pPrevDisabled.png" border="0" width="19" height="19"/>
                  <?php } ?></td>
                <td><?php $l=$pageNum_Documents-4;
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
                  <a href="<?php printf("%s?pageNum_Documents=%d%s".$sort_query_string, $currentPage, 0, $queryString_Documents); ?>"><?php echo '<u>'; echo 1; echo '</u>';?></a>...
                  <?php }
					for($i=$l;$i<=$h; $i++){
						
						if($i == $pageNum_Documents){ 
							echo "<b>[";
							echo $i+1;
							echo "]</b>";
						}elseif($i<=$h){ ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s".$sort_query_string, $currentPage, $i, $queryString_Documents); ?>"><?php echo '<u>'; echo $i+1; echo '</u>';?></a>
                  <?php }
					}
				?>
                  <?php if ($pageNum_Documents < $totalPages_Documents && ($h-$l)>=7) { // Show if not last page ?>
                  ... <a href="<?php printf("%s?pageNum_Documents=%d%s".$sort_query_string, $currentPage, $totalPages_Documents, $queryString_Documents); ?>"><?php echo '<u>'; echo $totalPages_Documents+1; echo '</u>';?></a>
                  <?php } // Show if not last page ?></td>
                <td><?php if ($pageNum_Documents < $totalPages_Documents) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s".$sort_query_string, $currentPage, min($totalPages_Documents, $pageNum_Documents + 1), $queryString_Documents); ?>"><img src="images/pNext.png" border="0" width="19" height="19"/></a>
                  <?php }else{ ?>
                  <img src="images/pNextDisabled.png" border="0" width="19" height="19"/>
                  <?php }// Show if not last page ?></td>
              </tr>
            </table>
        </div>
        </div>
     </td>
    </tr>
</table>
<table border="0" width="100%" cellspacing="0">
  <?php do { 
	$timestamp = strtotime($row_Documents['published_date']);
  ?>
    <tr>
      <td width="100%" style="border-bottom:1px solid #a25852; background:#fae9e8; padding-left:5px;"><strong><a href="documentDetail.php?id=<?php echo $row_Documents['id_document']; ?>" title="Видете ги деталите за документот" ><span style="font-variant:small-caps; font-weight:bolder; font-size:15px; "><?php echo $row_Documents['title'].((isset($row_Documents['into_force']) && !$row_Documents['into_force']) ? '<span style="color: red;"> - вон сила</span>' : ""); ?></span></a></strong><br> <span style="color:#666; font-size:11px">&nbsp;<?php echo date($page == "courtpractice.php" || $page == "europeancourt.php" ? "Y" : "d.m.Y", $timestamp); ?></span> <?php if($page == "documentlaws.php") { echo '|<span style="color:#666; font-size:11px"> Сл. весник/година:</span> <span style="font-size:11px; font-weight:bold;">'.$row_Documents["ordinal"].' </span>/<span style="font-size:11px; font-weight:bold;"> '.date("Y",strtotime($row_Documents["date"])); }else if($page == "courtpractice.php" || $page == "europeancourt.php") { echo '|<span style="color:#666; font-size:11px"> Суд:</span> <span style="font-size:11px;">'.$row_Documents["name"].' </span>'; } ?></span></td>
      <td width="5%" align="right" style="border-bottom:1px solid #a25852; background:#fae9e8;;"><a href="documentDetail.php?id=<?php echo $row_Documents['id_document']; ?>" title="Преземи го документот"><?php if($row_Documents['mimetype']=="application/msword"){ ?><img src="images/word_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /> <?php }elseif($row_Documents['mimetype']=="text/plain"){ ?><img src="images/text_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php }else{ ?><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /><?php } ?></a></td>
    </tr>
    <tr>
    	<td colspan="2"><?php getSubDocuments($row_Documents['id_document'], $pravo, $database_pravo,$row_Documents['id_doc_group'], $page); ?></td>
    </tr>
    <tr>
    	<td  style="border-bottom:1px solid #f5e6a2; background:#fbf7e0;" colspan="2">категорија: <?php getDocumentCategory($row_Documents['id_doc_group'], $pravo, $database_pravo); ?></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <?php } while ($row_Documents = mysql_fetch_assoc($Documents)); ?>
</table>
<table border="0" width="100%" cellspacing="0">
<tr>
    	<td width="50%">Документи <?php echo ($startRow_Documents + 1) ?> до <?php echo min($startRow_Documents + $maxRows_Documents, $totalRows_Documents) ?> од <?php echo $totalRows_Documents ?></td>
    	<td width="50%" align="right">
          <table border="0" style="font-size:12px;">
            <tr>
              
              <td><?php if ($pageNum_Documents > 0  ) { // Show if not first page ?>
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
              <td ><?php if ($pageNum_Documents < $totalPages_Documents) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Documents=%d%s", $currentPage, min($totalPages_Documents, $pageNum_Documents + 1), $queryString_Documents); ?>"><img src="images/pNext.png" border="0"/></a>
                  <?php }else{ ?>
					  <img src="images/pNextDisabled.png" border="0"/>
				 <?php }// Show if not last page ?></td>
              
            </tr>
        </table></td>
    </tr>
</table>
<?php }else{ 
	_show_message_color('Пребарувањето не врати никакви резултати!','RED');  
	  echo  "<p>&nbsp;</p>
			<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
			<p>&nbsp;</p>
        	<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
        	<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			";
	
} ?>
<?php
mysql_free_result($Documents);
?>