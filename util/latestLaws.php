<?php
$maxRows_latestLawsRecordset = 5;
$pageNum_latestLawsRecordset = 0;
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

<table width="450" border="0" cellpadding="5">
    <?php do { 
				$timestamp = strtotime($row_latestLawsRecordset['uploaded_date']); ?>
   	<tr>
    	<td width="100"><?php echo date("d.m.Y", $timestamp); ?><br /><?php echo date("G:i", $timestamp); ?></td>
      	<td width="324"><?php echo $row_latestLawsRecordset['title']; ?></td>
    </tr>
      <?php } while ($row_latestLawsRecordset = mysql_fetch_assoc($latestLawsRecordset)); ?>
</table>
<?php
mysql_free_result($latestLawsRecordset);
?>
