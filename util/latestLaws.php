<?php
$maxRows_latestLawsRecordset = 5;
$pageNum_latestLawsRecordset = 0;
$tmp_number=0;
if (isset($_GET['pageNum_latestLawsRecordset'])) {
  $pageNum_latestLawsRecordset = $_GET['pageNum_latestLawsRecordset'];
}
$startRow_latestLawsRecordset = $pageNum_latestLawsRecordset * $maxRows_latestLawsRecordset;

mysql_select_db($database_pravo, $pravo);
$query_latestLawsRecordset = "SELECT id_document, id_superdoc, title, published_date FROM `document` WHERE `document`.show_on_home = 1 ORDER BY `document`.uploaded_date desc";
$query_limit_latestLawsRecordset = sprintf("%s LIMIT %d, %d", $query_latestLawsRecordset, $startRow_latestLawsRecordset, $maxRows_latestLawsRecordset);
$latestLawsRecordset = mysql_query($query_limit_latestLawsRecordset, $pravo) or die(mysql_error());
$row_latestLawsRecordset = mysql_fetch_assoc($latestLawsRecordset);

if (isset($_GET['totalRows_latestLawsRecordset'])) {
  $totalRows_latestLawsRecordset = $_GET['totalRows_latestLawsRecordset'];
} else {
  $all_latestLawsRecordset = mysql_query($query_latestLawsRecordset);
  $totalRows_latestLawsRecordset = mysql_num_rows($all_latestLawsRecordset);
}
$totalPages_latestLawsRecordset = ceil($totalRows_latestLawsRecordset/$maxRows_latestLawsRecordset)-1;
?>

<link href="../style.css" rel="stylesheet" type="text/css">

<table width="100%" border="0" cellpadding="5" cellspacing="0">

    <?php
	do { 
		$timestamp = strtotime($row_latestLawsRecordset['published_date']);
		$id_superdoc = $row_latestLawsRecordset['id_superdoc']; 
		$id_document_link = '';
		if ($id_superdoc != '') {
			$id_document_link = $id_superdoc;
		} else {
			$id_document_link = $row_latestLawsRecordset['id_document'];
		}
		if ($id_superdoc != '') {
			mysql_select_db($database_pravo, $pravo);
			$query_latestLaw_superdoc = 'SELECT id_document, title FROM `document` WHERE id_doc_type = 1 AND id_document = ' . $id_superdoc;
			$latestLaw_superdoc = mysql_query($query_latestLaw_superdoc, $pravo) or die(mysql_error());
			$row_latestLaw_superdoc = mysql_fetch_assoc($latestLaw_superdoc);
			//echo ' - ' . $row_latestLaw_superdoc['title'];
		}	
	?>
   	<tr onmouseover="this.className='on'" onmouseout="this.className='off'">
      	<td width="94%" valign="top" <?php if($tmp_number<$maxRows_latestLawsRecordset-1) {?>style="border-bottom:1px dotted #CCC;"<?php }?>><a href="documentDetail.php?id=<?php echo $id_document_link; ?>" title="Детали за документот">
		<?php echo $row_latestLawsRecordset['title'] . ($id_superdoc != '' ? ' - ' . $row_latestLaw_superdoc['title'] : '');
		if(strtotime(date("d.m.Y", $timestamp)) > strtotime(date("d.m.Y",mktime(0, 0, 0, date("m"), date("d")-30, date("y"))))){
			echo "<sup><span style='color:#F00; font-size:xx-small;'><b>нов</b></span></sup>";
		}
		?>
        <br /><span style="color:#666; font-size:11px">&nbsp;<?php echo date("d.m.Y", $timestamp); ?></span>
        </a></td>
        <td width="5%" align="right" <?php if($tmp_number<$maxRows_latestLawsRecordset-1) {?>style="border-bottom:1px dotted #CCC;"<?php }?>><a href="documentDetail.php?id=<?php echo $id_document_link; ?>" title="Преземи го документот"><img src="images/pdf_icon_small3.png" alt="Преземи го документот" title="Преземи го документот" width="35" height="35" border="0" /></a></td>
    </tr>
      <?php $tmp_number+=1;} while ($row_latestLawsRecordset = mysql_fetch_assoc($latestLawsRecordset)); ?>
</table>
<?php
mysql_free_result($latestLawsRecordset);
if (isset($latestLaw_superdoc)) {
	mysql_free_result($latestLaw_superdoc);
}
?>
