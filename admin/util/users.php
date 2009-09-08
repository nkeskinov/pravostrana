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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if((isset($_POST['MM_insert'])) && ($_POST['MM_insert']=="form1")){
	$birth_date = date("Y-m-d", strtotime($_POST['date_of_birth']));
  $insertSQL = sprintf("INSERT INTO `user`(name, surname, username, email, date_of_birth, sex, address, city, country, phone, id_user_occupation, id_user_organization, is_locked_out, is_approved, deleted, id_user_category) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($birth_date, "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['id_user_occupation'], "int"),
                       GetSQLValueString($_POST['id_user_organization'], "int"),
                       GetSQLValueString(isset($_POST['is_locked_out']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['is_approved']) ? "true" : "" , "defined","1","0"),
                       GetSQLValueString(isset($_POST['deleted']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_user_category'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
	
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$birth_date = date("Y-m-d", strtotime($_POST['date_of_birth']));
  $updateSQL = sprintf("UPDATE `user` SET name=%s, surname=%s, email=%s, date_of_birth=%s, sex=%s, address=%s, city=%s, country=%s, phone=%s, id_user_occupation=%s, id_user_organization=%s, is_locked_out=%s, is_approved=%s, deleted=%s,  id_user_category=%s WHERE id_user=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($birth_date, "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['id_user_occupation'], "int"),
                       GetSQLValueString($_POST['id_user_organization'], "int"),
                       GetSQLValueString(isset($_POST['is_locked_out']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['is_approved']) ? "true" : "" , "defined","1","0"),
                       GetSQLValueString(isset($_POST['deleted']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_user_category'], "int"),
                       GetSQLValueString($_POST['id_user'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
}

if(isset($_GET['mode']) && ($_GET['mode'] == "delete")){
	$deleteSQL = sprintf("UPDATE `user` SET deleted=1 WHERE id_user = %s", GetSQLValueString($_GET['id'], "int"));
	mysql_select_db($database_pravo, $pravo);
  	$Result1 = mysql_query($deleteSQL, $pravo) or die(mysql_error());
}

$maxRows_Users = 20;
$pageNum_Users = 0;
if (isset($_GET['pageNum_Users'])) {
  $pageNum_Users = $_GET['pageNum_Users'];
}
$startRow_Users = $pageNum_Users * $maxRows_Users;

mysql_select_db($database_pravo, $pravo);
$query_Users = "SELECT  u.id_user, u.name, u.surname, u.email, u.is_approved, u.deleted, u.last_login_date,
(select count( d.id_user ) from download d where d.id_user=u.id_user group by u.id_user) as downloads,
(select count( v.id_user ) from visit v where v.id_user=u.id_user group by u.id_user) as visits
FROM user u";
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

$colname_UserEdit = "-1";
if (isset($_GET['id'])) {
  $colname_UserEdit = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_UserEdit = sprintf("SELECT * FROM `user` WHERE id_user = %s", GetSQLValueString($colname_UserEdit, "int"));
$UserEdit = mysql_query($query_UserEdit, $pravo) or die(mysql_error());
$row_UserEdit = mysql_fetch_assoc($UserEdit);
$totalRows_UserEdit = mysql_num_rows($UserEdit);

?>
<script src="../jquery.ui-1.5.2/jquery-1.2.6.js" type="text/javascript"></script>
<script src="../jquery.ui-1.5.2/ui/ui.datepicker.js" type="text/javascript"></script>
<link href="../jquery.ui-1.5.2/themes/ui.datepicker.css" rel="stylesheet" type="text/css" />

<div align="left" style="height:22px; width:99%; border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table cellpadding="0" cellspacing="0">
  <tr></tr>
  <tr>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="users.php?mode=new"><img src="../images/useradd.png" border="0" title="Нов документ" /></a></div></td>
    <?php if(isset($_GET['mode']) && (($_GET['mode']=="edit") || ($_GET['mode']=="new"))){ ?>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/save.png" border="0" title="Зачувај документ" /></a></div></td>
    <td>
    <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="document_category.php?id=<?php echo $row_RecordsetDocCategoryEdit['id_doc_group']; ?>&mode=delete" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="../images/delete.png" border="0" title="Бриши"  /></a></div>
    </td>
    <?php } ?>
    <td><div style="width:26px; height:21px; padding-top:1.5px; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/print.png" border="0" title="Печати страна" /></a></div></td>
  </tr>
  </table>
</div>
<br />
<?php if(isset($_GET['mode']) && (($_GET['mode']=="edit") || ($_GET['mode']=="new"))){ ?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Име:</td>
      <td><input type="text" name="name" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['name'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Презиме:</td>
      <td><input type="text" name="surname" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['surname'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Корисничко име:</td>
      <td><input type="text"  name="username" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) { echo htmlentities($row_UserEdit['username'], ENT_COMPAT, 'UTF-8'); }?>" <?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo "disabled"; ?> size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['email'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"> Датум на раѓање:</td>
      <td><input type="text" name="date_of_birth" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo date("d.m.Y", strtotime(htmlentities($row_UserEdit['date_of_birth'], ENT_COMPAT, 'UTF-8'))); ?>" size="32" id="jQueryUICalendar1" />
      <script type="text/javascript">
		// BeginWebWidget jQuery_UI_Calendar: jQueryUICalendar1
		//jQuery("#jQueryUICalendar1").datepicker();
		jQuery("#jQueryUICalendar1").datepicker({ dateFormat: 'dd.mm.yy',  altField: '#actualDate' });
		
		
		// EndWebWidget jQuery_UI_Calendar: jQueryUICalendar1
       </script>      
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Пол:</td>
      <td><select name="sex">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_UserEdit['sex'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Женски</option>
        <option value="0" <?php if (!(strcmp(0, htmlentities($row_UserEdit['sex'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Машки</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Адреса:</td>
      <td><textarea name="address" cols="30" rows="5"><?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['address'], ENT_COMPAT, 'UTF-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Град:</td>
      <td><input type="text" name="city" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['city'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Држава:</td>
      <td><input type="text" name="country" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['country'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Телефон:</td>
      <td><input type="text" name="phone" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['phone'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Занимање:</td>
      <td><select name="id_user_occupation">
        <?php 
do {  
?>
        <option value="<?php echo $row_Occupation['id_user_occupation']?>" <?php if (!(strcmp($row_Occupation['id_user_occupation'], htmlentities($row_UserEdit['id_user_occupation'], ENT_COMPAT, 'UTF-8')))) {echo "SELECTED";} ?>><?php echo $row_Occupation['name']?></option>
        <?php
} while ($row_Occupation = mysql_fetch_assoc($Occupation));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Организација:</td>
      <td><select name="id_user_organization">
        <?php 
do {  
?>
        <option value="<?php echo $row_Organization['id_user_organization']?>" <?php if (!(strcmp($row_Organization['id_user_organization'], htmlentities($row_UserEdit['id_user_organization'], ENT_COMPAT, 'UTF-8')))) {echo "SELECTED";} ?>><?php echo $row_Organization['name']?></option>
        <?php
} while ($row_Organization = mysql_fetch_assoc($Organization));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Заклучен:</td>
      <td><input type="checkbox" name="is_locked_out" value=""  <?php if (!(strcmp(htmlentities($row_UserEdit['is_locked_out'], ENT_COMPAT, ''),"1"))) {echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Одобрен:</td>
      <td>
      <input type="checkbox" name="is_approved" value=""  <?php if (!(strcmp(htmlentities($row_UserEdit['is_approved'], ENT_COMPAT, ''),"1"))) {echo "checked=\"checked\"";} ?> />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Избришан:</td>
      <td>
      <input type="checkbox" name="deleted" value=""  <?php if (!(strcmp(htmlentities($row_UserEdit['deleted'], ENT_COMPAT, ''),"1"))) {echo "checked=\"checked\"";} ?> />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Датум на креирање:</td>
      <td><input type="text" disabled="disabled" name="create_date" id="create_date" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['create_date'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Датум на последно логирање:</td>
      <td><input type="text" disabled="disabled" name="last_login_date" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['last_login_date'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Датум на последно<br />
      менување лозинка:</td>
      <td><input type="text" disabled="disabled" name="last_password_changed_date" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) echo htmlentities($row_UserEdit['last_password_changed_date'], ENT_COMPAT, 'UTF-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Категорија:</td>
      <td><select name="id_user_category">
        <?php 
do {  
?>
        <option value="<?php echo $row_UserCategory['id_user_category']?>" <?php if (!(strcmp($row_UserCategory['id_user_category'], htmlentities($row_UserEdit['id_user_category'], ENT_COMPAT, 'UTF-8')))) {echo "SELECTED";} ?>><?php echo $row_UserCategory['name']?></option>
        <?php
} while ($row_UserCategory = mysql_fetch_assoc($UserCategory));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
       <?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) { ?>
      	<input type="submit" value="Измени">
        <input type="hidden" name="MM_update" value="form1">
      <?php }else{ ?>
      	<input type="hidden" name="MM_insert" value="form1">
      	<input type="submit" value="Зачувај">
      <?php } ?>
      <a href="<?php echo $_GET['url']; ?>">Откажи</a>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id_user" value="<?php echo $row_UserEdit['id_user']; ?>" />
</form>
<?php }else{ ?>
<table border="0" width="100%" cellspacing="0">
	<tr>
    	<td width="31%">Корисници <?php echo ($startRow_Users + 1) ?> до <?php echo min( $startRow_Users + $maxRows_Users, $totalRows_Users) ?> од <?php echo $totalRows_Users ?>
        </td>
        <td align="right">
        	<table border="0" cellspacing="0" style="font-size:12px;">
            <tr>
              <td ><?php if ($pageNum_Users > 0  ) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Users=%d%s", $currentPage, max(0, $pageNum_Users - 1), $queryString_Users); ?>"><img src="../images/pPrev.png" border="0"/></a>
                  <?php }else{ // Show if not first page ?>
                  
                  		<img src="../images/pPrevDisabled.png" border="0"/>
                  <?php } ?>
              </td>
              <td>
              	<?php $l=$pageNum_Users-4;
					  $h=$pageNum_Users+4;
					  //echo "l=".$l;
					  if($l<0) $l=0;
					  if($h<7 && $h<$totalPages_Users) $h=7;
					  if($h>$totalPages_Users){
						  $h=$totalPages_Users;
						  $l=$h-7;
						  if($l<0)$l=0;
					  }
					  if ($h >7 && $l>0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_Users=%d%s", $currentPage, 0, $queryString_Users); ?>"><?php echo '<u>'; echo 1; echo '</u>';?></a>...
				  <?php }
					for($i=$l;$i<=$h; $i++){
						
						if($i == $pageNum_Users){ 
							echo "<b>[";
							echo $i+1;
							echo "]</b>";
						}elseif($i<=$h){ ?>
								<a href="<?php printf("%s?pageNum_Users=%d%s", $currentPage, $i, $queryString_Users); ?>"><?php echo '<u>'; echo $i+1; echo '</u>';?></a>
						
						<?php }
					}
				?>
                
                <?php if ($pageNum_Users < $totalPages_Users && ($h-$l)>=7) { // Show if not last page ?>...
                  <a href="<?php printf("%s?pageNum_Users=%d%s", $currentPage, $totalPages_Users, $queryString_Users); ?>"><?php echo '<u>'; echo $totalPages_Users+1; echo '</u>';?></a>
                  <?php } // Show if not last page ?>
              </td>
              <td ><?php if ($pageNum_Users < $totalPages_Users) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_Users=%d%s", $currentPage, min($totalPages_Users, $pageNum_Users + 1), $queryString_Users); ?>"><img src="../images/pNext.png" border="0"/></a>
                  <?php }else{ ?>
					  <img src="../images/pNextDisabled.png" border="0"/>
				 <?php }// Show if not last page ?>
              </td>
            </tr>
        </table>
        </div>
        </div>
     </td>
    </tr>
</table>
<table width="100%" border="0">
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
    <tr <?php if($i%2==0) echo "style='background:#fbf7e0'"; if($row_Users['deleted']==1) echo "style='color:#999'"; ?>>
      <td width="16"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row_Users['id_user']; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a></td>
      <td width="16"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row_Users['id_user']; ?>&mode=delete&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="../images/cross.png" border="0" /></a></td>
      <td width="30%"><a href="/pravo.org.mk/admin/userDetails.php?id=<?php echo $row_Users['id_user']; ?>" ><?php echo $row_Users['name']; ?> <?php echo $row_Users['surname']; ?></a></td>
      <td><?php echo  date("d.m.Y H:i:s",strtotime($row_Users['last_login_date'])); ?></td>
      <td align="center">
	   <input type="checkbox" disabled="disabled" name="forcesubscribe" value="1"  <?php if (!(strcmp(htmlentities( $row_Users['is_approved'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
	 </td>
      <td align="center"> <input type="checkbox" disabled="disabled" name="forcesubscribe" value="1"  <?php if (!(strcmp(htmlentities( $row_Users['deleted'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>></td>
      <td><?php echo $row_Users['downloads']; ?></td>
      <td><?php echo $row_Users['visits']; ?></td>
    </tr>
    <?php $i++; } while ($row_Users = mysql_fetch_assoc($Users)); ?>
</table>
<?php } ?>
<?php
mysql_free_result($Users);

mysql_free_result($Organization);

mysql_free_result($Occupation);

mysql_free_result($UserCategory);

mysql_free_result($UserEdit);
?>
