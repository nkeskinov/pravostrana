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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table border="1" align="center">
  <tr>
    <td>id_document</td>
    <td><?php echo $row_DetailRS1['id_document']; ?></td>
  </tr>
  <tr>
    <td>id_doc_type</td>
    <td><?php echo $row_DetailRS1['id_doc_type']; ?></td>
  </tr>
  <tr>
    <td>path</td>
    <td><?php echo $row_DetailRS1['path']; ?></td>
  </tr>
  <tr>
    <td>title</td>
    <td><?php echo $row_DetailRS1['title']; ?></td>
  </tr>
  <tr>
    <td>uploaded_date</td>
    <td><?php echo $row_DetailRS1['uploaded_date']; ?></td>
  </tr>
  <tr>
    <td>id_doc_meta</td>
    <td><?php echo $row_DetailRS1['id_doc_meta']; ?></td>
  </tr>
  <tr>
    <td>id_doc_group</td>
    <td><?php echo $row_DetailRS1['id_doc_group']; ?></td>
  </tr>
  <tr>
    <td>description</td>
    <td><?php echo $row_DetailRS1['description']; ?></td>
  </tr>
  <tr>
    <td>extension</td>
    <td><?php echo $row_DetailRS1['extension']; ?></td>
  </tr>
  <tr>
    <td>filesize</td>
    <td><?php echo $row_DetailRS1['filesize']; ?></td>
  </tr>
  <tr>
    <td>mimetype</td>
    <td><?php echo $row_DetailRS1['mimetype']; ?></td>
  </tr>
  <tr>
    <td>forcesubscribe</td>
    <td><?php echo $row_DetailRS1['forcesubscribe']; ?></td>
  </tr>
  <tr>
    <td>published_date</td>
    <td><?php echo $row_DetailRS1['published_date']; ?></td>
  </tr>
  <tr>
    <td>id_superdoc</td>
    <td><?php echo $row_DetailRS1['id_superdoc']; ?></td>
  </tr>
  <tr>
    <td>created_by</td>
    <td><?php echo $row_DetailRS1['created_by']; ?></td>
  </tr>
</table>
</body>
</html><?php
mysql_free_result($DetailRS1);
?>