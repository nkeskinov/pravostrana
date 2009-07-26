<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Users = 20;
$pageNum_Users = 0;
if (isset($_GET['pageNum_Users'])) {
  $pageNum_Users = $_GET['pageNum_Users'];
}
$startRow_Users = $pageNum_Users * $maxRows_Users;

mysql_select_db($database_pravo, $pravo);
$query_Users = "SELECT  u.id_user, u.name, u.surname, u.email, u.is_approved, u.deleted, u.last_login_date, count( d.id_user ) , count( v.id_user )  FROM user u LEFT JOIN download d ON ( u.id_user = d.id_user ) LEFT JOIN visit v ON ( u.id_user = v.id_user ) GROUP BY u.id_user";
$query_limit_Users = sprintf("%s LIMIT %d, %d", $query_Users, $startRow_Users, $maxRows_Users);
$Users = mysql_query($query_limit_Users, $pravo) or die(mysql_error());
$row_Users = mysql_fetch_assoc($Users);

if (isset($_GET['totalRows_Users'])) {
  $totalRows_Users = $_GET['totalRows_Users'];
} else {
  $all_Users = mysql_query($query_Users);
  $totalRows_Users = mysql_num_rows($all_Users);
}
$totalPages_Users = ceil($totalRows_Users/$maxRows_Users)-1;

?>
<div align="left" style="height:22px; margin-left:-5px;  margin-top:-15px; width:510px; border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table cellpadding="0" cellspacing="0">
  <tr></tr>
  <tr>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="document_category.php?mode=new"><img src="../images/useradd.png" border="0" title="Нов документ" /></a></div></td>
    <?php if(isset($_GET['mode']) && (($_GET['mode']=="edit") || ($_GET['mode']=="new"))){ ?>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/save.png" border="0" title="Зачувај документ" /></a></div></td>
    <td>
    <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="document_category.php?id=<?php echo $row_RecordsetDocCategoryEdit['id_doc_group']; ?>&mode=delete" onClick="return confirm('Дали навистина сакате да го избришете документот!')"><img src="../images/delete.png" border="0" title="Бриши"  /></a></div>
    </td>
    <?php } ?>
    <td><div style="width:26px; height:21px; padding-top:1.5px; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/print.png" border="0" title="Печати страна" /></a></div></td>
  </tr>
  </table>
</div>
   <br />
<table border="0">
  <tr style="background:url(../images/yellow-title-middle.png);">
    <td colspan="2">Акција</td>
    <td>Име и презиме</td>
    <td>Последно логирање</td>
    <td>Одобрен</td>
    <td>Ибришан</td>
    <td>Симнувања</td>
    <td>Посети</td>
  </tr>
  <?php $i=0; do { ?>
    <tr <?php if($i%2==0) echo "style='background:#fbf7e0'" ?>>
      <td width="16"><a href="document_type.php?id=<?php echo $row_Users['id_users']; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a></td>
      <td width="16"><a href="document_type.php?id=<?php echo $row_Users['id_users']; ?>&mode=delete&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>" onClick="return confirm('Дали навистина сакате да го избришете документот!')"><img src="../images/cross.png" border="0" /></a></td>
      <td width="30%"><?php echo $row_Users['name']; ?> <?php echo $row_Users['surname']; ?></td>
      <td><?php echo  date("d.m.Y H:i:s",strtotime($row_Users['last_login_date'])); ?></td>
      <td align="center">
	   <input type="checkbox" name="forcesubscribe" value="1"  <?php if (!(strcmp(htmlentities( $row_Users['is_approved'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
	 </td>
      <td align="center"> <input type="checkbox" name="forcesubscribe" value="1"  <?php if (!(strcmp(htmlentities( $row_Users['deleted'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>></td>
      <td><?php echo $row_Users['count( d.id_user )']; ?></td>
      <td><?php echo $row_Users['count( v.id_user )']; ?></td>
    </tr>
    <?php $i++; } while ($row_Users = mysql_fetch_assoc($Users)); ?>
</table>

<?php
mysql_free_result($Users);
?>
