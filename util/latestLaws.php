<?php
$maxRows_latestLawsRecordset = 5;
$pageNum_latestLawsRecordset = 0;
$tmp_number=0;
if (isset($_GET['pageNum_latestLawsRecordset'])) {
  $pageNum_latestLawsRecordset = $_GET['pageNum_latestLawsRecordset'];
}
$startRow_latestLawsRecordset = $pageNum_latestLawsRecordset * $maxRows_latestLawsRecordset;

mysql_select_db($database_pravo, $pravo);
$query_latestLawsRecordset = "SELECT * FROM `document` WHERE `document`.id_doc_type = 1 ORDER BY `document`.uploaded_date desc";
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

    <?php do { 
				$timestamp = strtotime($row_latestLawsRecordset['uploaded_date']); ?>
   	<tr onmouseover="this.className='on'" onmouseout="this.className='off'" >
    	
      	<td width="94%" valign="top"  <?php if($tmp_number<$maxRows_latestLawsRecordset-1) {?>style="border-bottom:1px solid #CCC;"<?php }?>><?php echo $row_latestLawsRecordset['title']; ?>
        <br /><span style="color:#666; font-size:11px">&nbsp;<?php echo date("d.m.Y", $timestamp); ?>&nbsp;<?php echo date("G:i", $timestamp); ?></span>
        </td>
      	<td width="6%" valign="top" <?php if($tmp_number<$maxRows_latestLawsRecordset-1) {?>style="border-bottom:1px solid #CCC;"<?php }?>><a href="#"><img src="images/pdf_icon_small.png" alt="Преземи го документот" title="Преземи го документот" width="30" height="30" border="0" /></a></td>
    </tr>
      <?php $tmp_number+=1;} while ($row_latestLawsRecordset = mysql_fetch_assoc($latestLawsRecordset)); ?>
</table>
<?php
mysql_free_result($latestLawsRecordset);
?>

