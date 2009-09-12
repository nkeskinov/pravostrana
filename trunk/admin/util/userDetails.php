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

$currentPage = $_SERVER["PHP_SELF"];

$colname_User = "-1";
if (isset($_GET['id'])) {
  $colname_User = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_User = sprintf("SELECT * FROM `user` WHERE id_user = %s", GetSQLValueString($colname_User, "int"));
$User = mysql_query($query_User, $pravo) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);

mysql_select_db($database_pravo, $pravo);
$query_Organization = "SELECT * FROM user_organization";
$Organization = mysql_query($query_Organization, $pravo) or die(mysql_error());
$row_Organization = mysql_fetch_assoc($Organization);
$totalRows_Organization = mysql_num_rows($Organization);

mysql_select_db($database_pravo, $pravo);
$query_Occupation = "SELECT * FROM user_occupation";
$Occupation = mysql_query($query_Occupation, $pravo) or die(mysql_error());
$row_Occupation = mysql_fetch_assoc($Occupation);
$totalRows_Occupation = mysql_num_rows($Occupation);

mysql_select_db($database_pravo, $pravo);
$query_UserCategory = "SELECT * FROM user_category";
$UserCategory = mysql_query($query_UserCategory, $pravo) or die(mysql_error());
$row_UserCategory = mysql_fetch_assoc($UserCategory);
$totalRows_UserCategory = mysql_num_rows($UserCategory);

$colname_DownloadCount = "-1";
if (isset($_GET['id'])) {
  $colname_DownloadCount = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_DownloadCount = sprintf("SELECT count(*) downloads FROM download WHERE id_user = %s", GetSQLValueString($colname_DownloadCount, "int"));
$DownloadCount = mysql_query($query_DownloadCount, $pravo) or die(mysql_error());
$row_DownloadCount = mysql_fetch_assoc($DownloadCount);
$totalRows_DownloadCount = mysql_num_rows($DownloadCount);

$maxRows_VisitedPages = 10;
$pageNum_VisitedPages = 0;
if (isset($_GET['pageNum_VisitedPages'])) {
  $pageNum_VisitedPages = $_GET['pageNum_VisitedPages'];
}
$startRow_VisitedPages = $pageNum_VisitedPages * $maxRows_VisitedPages;

mysql_select_db($database_pravo, $pravo);
$query_VisitedPages = sprintf("SELECT vis.id_visit, p.id_page, p.title page, p1.title from_page,visited_date, ip, browser, language, referrer, (select count( * ) from page_visit pvs   where pvs.id_page = p.id_page and pvs.id_visit = vis.id_visit group by p.id_page) as visits FROM visit vis, page p, page_visit pv LEFT JOIN page p1 on pv.id_from_page = p1.id_page where vis.id_visit = pv.id_visit AND pv.id_page = p.id_page AND id_user = %s GROUP BY vis.id_visit, p.id_page ORDER BY visited_date desc",GetSQLValueString($colname_DownloadCount, "int"));
$query_limit_VisitedPages = sprintf("%s LIMIT %d, %d", $query_VisitedPages, $startRow_VisitedPages, $maxRows_VisitedPages);
$VisitedPages = mysql_query($query_limit_VisitedPages, $pravo) or die(mysql_error());
$row_VisitedPages = mysql_fetch_assoc($VisitedPages);

if (isset($_GET['totalRows_VisitedPages'])) {
  $totalRows_VisitedPages = $_GET['totalRows_VisitedPages'];
} else {
  $all_VisitedPages = mysql_query($query_VisitedPages);
  $totalRows_VisitedPages = mysql_num_rows($all_VisitedPages);
}
$totalPages_VisitedPages = ceil($totalRows_VisitedPages/$maxRows_VisitedPages)-1;

$queryString_VisitedPages = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_VisitedPages") == false && 
        stristr($param, "totalRows_VisitedPages") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_VisitedPages = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_VisitedPages = sprintf("&totalRows_VisitedPages=%d%s", $totalRows_VisitedPages, $queryString_VisitedPages);




$maxRows_DownloadedDocuments = 10;
$pageNum_DownloadedDocuments = 0;
if (isset($_GET['pageNum_DownloadedDocuments'])) {
  $pageNum_DownloadedDocuments = $_GET['pageNum_DownloadedDocuments'];
}
$startRow_DownloadedDocuments = $pageNum_DownloadedDocuments * $maxRows_DownloadedDocuments;

mysql_select_db($database_pravo, $pravo);
$query_DownloadedDocuments = sprintf("SELECT  doc.id_document, doc.id_doc_group ,title,down.downloaded_date,
		(select count( * ) from download d where d.id_document=doc.id_document and d.id_user=down.id_user 
		group by doc.id_document) as downloads
		FROM document doc, download down
		where doc.id_document = down.id_document
		AND id_user = %s
		GROUP BY id_document 
		ORDER BY downloaded_date desc",GetSQLValueString($colname_DownloadCount, "int"));
$query_limit_DownloadedDocuments = sprintf("%s LIMIT %d, %d", $query_DownloadedDocuments, $startRow_DownloadedDocuments, $maxRows_DownloadedDocuments);
$DownloadedDocuments = mysql_query($query_limit_DownloadedDocuments, $pravo) or die(mysql_error());
$row_DownloadedDocuments = mysql_fetch_assoc($DownloadedDocuments);

if (isset($_GET['totalRows_DownloadedDocuments'])) {
  $totalRows_DownloadedDocuments = $_GET['totalRows_DownloadedDocuments'];
} else {
  $all_DownloadedDocuments = mysql_query($query_DownloadedDocuments);
  $totalRows_DownloadedDocuments = mysql_num_rows($all_DownloadedDocuments);
}
$totalPages_DownloadedDocuments = ceil($totalRows_DownloadedDocuments/$maxRows_DownloadedDocuments)-1;


$queryString_DownloadedDocuments = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_DownloadedDocuments") == false && 
        stristr($param, "totalRows_DownloadedDocuments") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_DownloadedDocuments = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_DownloadedDocuments = sprintf("&totalRows_DownloadedDocuments=%d%s", $totalRows_DownloadedDocuments, $queryString_DownloadedDocuments);

?>
<table width="100%" align="center">
    <tr valign="baseline">
      <td width="39%" align="right" nowrap="nowrap">Име:</td>
      <td width="61%"><strong><?php echo htmlentities($row_User['name'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Презиме:</td>
      <td><strong><?php echo htmlentities($row_User['surname'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Корисничко име:</td>
      <td><strong><?php echo htmlentities($row_User['username'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><strong><?php echo htmlentities($row_User['email'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"> Датум на раѓање:</td>
      <td><?php echo "<strong>".date("d.m.Y", strtotime(htmlentities($row_User['date_of_birth'], ENT_COMPAT, 'UTF-8')))."</strong>"; ?>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Пол:</td>
      <td><?php if (!(strcmp(1, htmlentities($row_User['sex'], ENT_COMPAT, '')))) {echo "<strong>Женски</strong>";} ?>
         <?php if (!(strcmp(0, htmlentities($row_User['sex'], ENT_COMPAT, '')))) {echo "<strong>Машки</strong>";} ?>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Адреса:</td>
      <td><strong><?php echo htmlentities($row_User['address'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Град:</td>
      <td><strong><?php echo htmlentities($row_User['city'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Држава:</td>
      <td><strong><?php echo htmlentities($row_User['country'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Телефон:</td>
      <td><strong><?php echo htmlentities($row_User['phone'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Занимање:</td>
      <td>
        <?php 
do {  
?>
        <strong>
        <?php if (!(strcmp($row_Occupation['id_user_occupation'], htmlentities($row_User['id_user_occupation'], ENT_COMPAT, 'UTF-8')))) {echo $row_Occupation['name'];} ?>
        </strong>
<?php
} while ($row_Occupation = mysql_fetch_assoc($Occupation));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Организација:</td>
      <td>
        <?php 
do {  
?>
        <strong>
        <?php if (!(strcmp($row_Organization['id_user_organization'], htmlentities($row_User['id_user_organization'], ENT_COMPAT, 'UTF-8')))) {echo $row_Organization['name'];} ?>
        </strong>
<?php
} while ($row_Organization = mysql_fetch_assoc($Organization));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Заклучен:</td>
      <td><input type="checkbox" disabled name="is_locked_out" value=""  <?php if (!(strcmp(htmlentities($row_User['is_locked_out'], ENT_COMPAT, ''),"1"))) {echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Одобрен:</td>
      <td>
      <input type="checkbox" disabled name="is_approved" value=""  <?php if (!(strcmp(htmlentities($row_User['is_approved'], ENT_COMPAT, ''),"1"))) {echo "checked=\"checked\"";} ?> />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Избришан:</td>
      <td>
      <input type="checkbox" disabled name="deleted" value=""  <?php if (!(strcmp(htmlentities($row_User['deleted'], ENT_COMPAT, ''),"1"))) {echo "checked=\"checked\"";} ?> />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Датум на креирање:</td>
      <td><strong><?php echo date("d.m.Y H:i:s",strtotime(htmlentities($row_User['create_date'], ENT_COMPAT, 'UTF-8'))); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Датум на последно логирање:</td>
      <td><strong><?php echo date("d.m.Y H:i:s",strtotime(htmlentities($row_User['last_login_date'], ENT_COMPAT, 'UTF-8'))); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Датум на последно<br />
      менување лозинка:</td>
      <td><strong><?php echo htmlentities($row_User['last_password_changed_date'], ENT_COMPAT, 'UTF-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Категорија:</td>
      <td>
        <?php 
do {  
?>
        <strong>
        <?php if (!(strcmp($row_UserCategory['id_user_category'], htmlentities($row_User['id_user_category'], ENT_COMPAT, 'UTF-8')))) {echo $row_UserCategory['name'];} ?>
        </strong>
<?php
} while ($row_UserCategory = mysql_fetch_assoc($UserCategory));
?>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
      
      </td>
    </tr>
  </table>
<br>
<?php if(mysql_num_rows($DownloadedDocuments)!=0){ ?>
<table border="0" width="100%" cellspacing="0">
	<tr>
    	<td width="46%">Симнати документи <?php echo ($startRow_DownloadedDocuments + 1) ?> до <?php echo min( $startRow_DownloadedDocuments + $maxRows_DownloadedDocuments, $totalRows_DownloadedDocuments) ?> од <?php echo $totalRows_DownloadedDocuments ?>
        </td>
        <td width="54%" align="right">
        	<table border="0" cellspacing="0" style="font-size:12px;">
            <tr>
            <td>
            <form action="util/export_excel.php" method="post">
	            <input type="image" name="query" value="<?php echo $query_DownloadedDocuments; ?>" src="../images/excel.png" title="Експортирајте ја статистиката во excel"/> |
            </form>
            </td>
              <td ><?php if ($pageNum_DownloadedDocuments > 0  ) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_DownloadedDocuments=%d%s", $currentPage, max(0, $pageNum_DownloadedDocuments - 1), $queryString_DownloadedDocuments); ?>"><img src="../images/pPrev.png" border="0"/></a>
                  <?php }else{ // Show if not first page ?>
                  
                  		<img src="../images/pPrevDisabled.png" border="0"/>
                  <?php } ?>
              </td>
              <td>
              	<?php $l=$pageNum_DownloadedDocuments-4;
					  $h=$pageNum_DownloadedDocuments+4;
					  //echo "l=".$l;
					  if($l<0) $l=0;
					  if($h<7 && $h<$totalPages_DownloadedDocuments) $h=7;
					  if($h>$totalPages_DownloadedDocuments){
						  $h=$totalPages_DownloadedDocuments;
						  $l=$h-7;
						  if($l<0)$l=0;
					  }
					  if ($h >7 && $l>0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_DownloadedDocuments=%d%s", $currentPage, 0, $queryString_DownloadedDocuments); ?>"><?php echo '<u>'; echo 1; echo '</u>';?></a>...
				  <?php }
					for($i=$l;$i<=$h; $i++){
						
						if($i == $pageNum_DownloadedDocuments){ 
							echo "<b>[";
							echo $i+1;
							echo "]</b>";
						}elseif($i<=$h){ ?>
								<a href="<?php printf("%s?pageNum_DownloadedDocuments=%d%s", $currentPage, $i, $queryString_DownloadedDocuments); ?>"><?php echo '<u>'; echo $i+1; echo '</u>';?></a>
						
						<?php }
					}
				?>
                
                <?php if ($pageNum_DownloadedDocuments < $totalPages_DownloadedDocuments && ($h-$l)>=7) { // Show if not last page ?>...
                  <a href="<?php printf("%s?pageNum_DownloadedDocuments=%d%s", $currentPage, $totalPages_DownloadedDocuments, $queryString_DownloadedDocuments); ?>"><?php echo '<u>'; echo $totalPages_DownloadedDocuments+1; echo '</u>';?></a>
                  <?php } // Show if not last page ?>
              </td>
              <td ><?php if ($pageNum_DownloadedDocuments < $totalPages_DownloadedDocuments) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_DownloadedDocuments=%d%s", $currentPage, min($totalPages_DownloadedDocuments, $pageNum_DownloadedDocuments + 1), $queryString_DownloadedDocuments); ?>"><img src="../images/pNext.png" border="0"/></a>
                  <?php }else{ ?>
					  <img src="../images/pNextDisabled.png" border="0"/>
				 <?php }// Show if not last page ?>
              </td>
            </tr>
        </table>
     </td>
    </tr>
</table>
<div align="left" style="height:22px;  border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table width="100%" cellpadding="0" cellspacing="0">
  <tr>
  	<td>Симнувања на документи</td>
  	<td align="right">Корисникот има симнато <?php echo $row_DownloadCount['downloads']; ?> пати</td>
  </tr>
  </table>
</div>
<table width="100%" border="0">
  <tr style="border-bottom:1px solid #f5e6a2; background:#edd59b">
    <td width="57%">Документ</td>
    <td width="27%">Датум на симнување</td>
    <td width="17%">Број на симнување</td>
  </tr>
  <?php $i=0; do { ?>
    <tr <?php if($i%2==0) echo "style='background:#fbf7e0'" ?>>
      <td><a href="../documentDetail.php?id=<?php echo $row_DownloadedDocuments['id_document']; ?>&gid=<?php echo $row_DownloadedDocuments['id_doc_group']; ?>&page=documentlaws.php"><?php echo $row_DownloadedDocuments['title']; ?></a></td>
      <td><?php echo date("d.m.Y H:m", strtotime(htmlentities($row_DownloadedDocuments['downloaded_date'], ENT_COMPAT, 'UTF-8'))); ?></td>
      <td><?php echo $row_DownloadedDocuments['downloads']; ?></td>
    </tr>
    <?php $i++;} while ($row_DownloadedDocuments = mysql_fetch_assoc($DownloadedDocuments)); ?>
</table>
<br />
<table border="0" width="100%" cellspacing="0">
	<tr>
    	<td width="46%">Посети <?php echo ($startRow_VisitedPages + 1) ?> до <?php echo min( $startRow_VisitedPages + $maxRows_VisitedPages, $totalRows_VisitedPages) ?> од <?php echo $totalRows_VisitedPages ?>
        </td>
        <td width="54%" align="right">
        	<table border="0" cellspacing="0" style="font-size:12px;">
            <tr>
            <td><form action="util/export_excel.php" method="post">
	            <input type="image" name="query" value="<?php echo $query_VisitedPages; ?>" src="../images/excel.png"title="Експортирајте ја статистиката во excel" /> |
            </form></td>
              <td ><?php if ($pageNum_VisitedPages > 0  ) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_VisitedPages=%d%s", $currentPage, max(0, $pageNum_VisitedPages - 1), $queryString_VisitedPages); ?>"><img src="../images/pPrev.png" border="0"/></a>
                  <?php }else{ // Show if not first page ?>
                  
                  		<img src="../images/pPrevDisabled.png" border="0"/>
                  <?php } ?>
              </td>
              <td>
              	<?php $l=$pageNum_VisitedPages-4;
					  $h=$pageNum_VisitedPages+4;
					  //echo "l=".$l;
					  if($l<0) $l=0;
					  if($h<7 && $h<$totalPages_VisitedPages) $h=7;
					  if($h>$totalPages_VisitedPages){
						  $h=$totalPages_VisitedPages;
						  $l=$h-7;
						  if($l<0)$l=0;
					  }
					  if ($h >7 && $l>0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_VisitedPages=%d%s", $currentPage, 0, $queryString_VisitedPages); ?>"><?php echo '<u>'; echo 1; echo '</u>';?></a>...
				  <?php }
					for($i=$l;$i<=$h; $i++){
						
						if($i == $pageNum_VisitedPages){ 
							echo "<b>[";
							echo $i+1;
							echo "]</b>";
						}elseif($i<=$h){ ?>
								<a href="<?php printf("%s?pageNum_VisitedPages=%d%s", $currentPage, $i, $queryString_VisitedPages); ?>"><?php echo '<u>'; echo $i+1; echo '</u>';?></a>
						
						<?php }
					}
				?>
                
                <?php if ($pageNum_VisitedPages < $totalPages_VisitedPages && ($h-$l)>=7) { // Show if not last page ?>...
                  <a href="<?php printf("%s?pageNum_VisitedPages=%d%s", $currentPage, $totalPages_VisitedPages, $queryString_VisitedPages); ?>"><?php echo '<u>'; echo $totalPages_VisitedPages+1; echo '</u>';?></a>
                  <?php } // Show if not last page ?>
              </td>
              <td ><?php if ($pageNum_VisitedPages < $totalPages_VisitedPages) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_VisitedPages=%d%s", $currentPage, min($totalPages_VisitedPages, $pageNum_VisitedPages + 1), $queryString_VisitedPages); ?>"><img src="../images/pNext.png" border="0"/></a>
                  <?php }else{ ?>
					  <img src="../images/pNextDisabled.png" border="0"/>
				 <?php }// Show if not last page ?>
              </td>
            </tr>
        </table>
     </td>
    </tr>
</table>
<div align="left" style="height:22px;  border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table width="100%" cellpadding="0" cellspacing="0">
  <tr>
  	<td>Посети на страници</td>
  	<td align="right">Корисникот има посетено <?php echo $row_DownloadCount['downloads']; ?> пати</td>
  </tr>
  </table>
</div>
<table border="0">
  <tr style="border-bottom:1px solid #f5e6a2; background:#edd59b;">
    <td>Страница</td>
    <td>Преминато од страницата</td>
    <td>Посотено на</td>
    <td>IP адреса</td>
    <td>Прелистувач</td>
    <td>Јазик</td>
    <td>referrer</td>
    <td>Бр. посети</td>
  </tr>
  <?php $i=0; do { ?>
    <tr valign="top" <?php if($i%2==0) echo "style='background:#fbf7e0'" ?>>
      <td><?php echo $row_VisitedPages['page']; ?></td>
      <td><?php echo $row_VisitedPages['from_page']; ?></td>
      <td><?php echo $row_VisitedPages['visited_date']; ?></td>
      <td><?php echo $row_VisitedPages['ip']; ?></td>
      <td><?php echo substr($row_VisitedPages['browser'],0,strpos($row_VisitedPages['browser'],' ')); ?></td>
      <td><?php echo substr($row_VisitedPages['language'],0,strpos($row_VisitedPages['language'],';')); ?></td>
      <td><?php echo '<a href ="'.$row_VisitedPages['referrer'].'">'.$row_VisitedPages['referrer'].'</a>'; ?></td>
      <td><?php echo $row_VisitedPages['visits']; ?></td>
    </tr>
    <?php $i++; } while ($row_VisitedPages = mysql_fetch_assoc($VisitedPages)); ?>
</table>
<?php } ?>
<?php
mysql_free_result($User);

mysql_free_result($DownloadCount);

mysql_free_result($VisitedPages);

mysql_free_result($DownloadedDocuments);
?>
