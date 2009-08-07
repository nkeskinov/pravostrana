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



mysql_select_db($database_pravo, $pravo);
$query_RecordsetDocType = "SELECT * FROM doc_type";
$RecordsetDocType = mysql_query($query_RecordsetDocType, $pravo) or die(mysql_error());
$row_RecordsetDocType = mysql_fetch_assoc($RecordsetDocType);
$totalRows_RecordsetDocType = mysql_num_rows($RecordsetDocType);

mysql_select_db($database_pravo, $pravo);
$query_RecordsetDocGroup = "SELECT * FROM doc_group";
$RecordsetDocGroup = mysql_query($query_RecordsetDocGroup, $pravo) or die(mysql_error());
$row_RecordsetDocGroup = mysql_fetch_assoc($RecordsetDocGroup);
$totalRows_RecordsetDocGroup = mysql_num_rows($RecordsetDocGroup);

$colname_RecordsetDocCategoryEdit = "-1";
if (isset($_GET['id'])) {
  $colname_RecordsetDocCategoryEdit = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_RecordsetDocCategoryEdit = sprintf("SELECT * FROM doc_group WHERE id_doc_group = %s", GetSQLValueString($colname_RecordsetDocCategoryEdit, "int"));
$RecordsetDocCategoryEdit = mysql_query($query_RecordsetDocCategoryEdit, $pravo) or die(mysql_error());
$row_RecordsetDocCategoryEdit = mysql_fetch_assoc($RecordsetDocCategoryEdit);
$totalRows_RecordsetDocCategoryEdit = mysql_num_rows($RecordsetDocCategoryEdit);


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
						)UNION
						SELECT id_doc_group, name
						FROM doc_group
						WHERE id_doc_group = (
							SELECT id_supergroup
							FROM doc_group
							WHERE id_doc_group = %s
						)UNION
						SELECT id_doc_group, name FROM doc_group
						WHERE id_doc_group = %s 
						",GetSQLValueString($row_RecordsetDocCategoryEdit['id_doc_group'],"int"),GetSQLValueString($row_RecordsetDocCategoryEdit['id_doc_group'],"int"),GetSQLValueString($row_RecordsetDocCategoryEdit['id_doc_group'],"int"));
						
$DocGroup = mysql_query($query_DocGroup, $pravo) or die(mysql_error());
//$row_DocGroup = mysql_fetch_assoc($DocGroup);
$row_number =  mysql_num_rows($DocGroup);
$cat=-1;
$subcat=-1;
$subsubcat=-1;
if($row_number==3){
	$cat=mysql_result($DocGroup,0,'id_doc_group');
	$subcat=mysql_result($DocGroup,1,'id_doc_group');
	$subsubcat=mysql_result($DocGroup,2,'id_doc_group');
}elseif($row_number==2){
	$cat=mysql_result($DocGroup,0,'id_doc_group');
	$subcat=mysql_result($DocGroup,1,'id_doc_group');
}elseif($row_number==1){
	$cat=mysql_result($DocGroup,0,'id_doc_group');
}
//echo $cat."<br>";
//echo $subcat."<br>";
//echo $subsubcat."<br>";

$maxRows_RecordsetDocGroupSuper = 100;
$pageNum_RecordsetDocGroupSuper = 0;
if (isset($_GET['pageNum_RecordsetDocGroupSuper'])) {
  $pageNum_RecordsetDocGroupSuper = $_GET['pageNum_RecordsetDocGroupSuper'];
}
$startRow_RecordsetDocGroupSuper = $pageNum_RecordsetDocGroupSuper * $maxRows_RecordsetDocGroupSuper;

mysql_select_db($database_pravo, $pravo);
$query_RecordsetDocGroupSuper = "SELECT dg.id_doc_group, dg.name name, dg.forcesubscribe, dt.name dtname FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND id_supergroup is NULL";
$query_limit_RecordsetDocGroupSuper = sprintf("%s LIMIT %d, %d", $query_RecordsetDocGroupSuper, $startRow_RecordsetDocGroupSuper, $maxRows_RecordsetDocGroupSuper);
$RecordsetDocGroupSuper = mysql_query($query_RecordsetDocGroupSuper, $pravo) or die(mysql_error());
$row_RecordsetDocGroupSuper = mysql_fetch_assoc($RecordsetDocGroupSuper);

if (isset($_GET['totalRows_RecordsetDocGroupSuper'])) {
  $totalRows_RecordsetDocGroupSuper = $_GET['totalRows_RecordsetDocGroupSuper'];
} else {
  $all_RecordsetDocGroupSuper = mysql_query($query_RecordsetDocGroupSuper);
  $totalRows_RecordsetDocGroupSuper = mysql_num_rows($all_RecordsetDocGroupSuper);
}
$totalPages_RecordsetDocGroupSuper = ceil($totalRows_RecordsetDocGroupSuper/$maxRows_RecordsetDocGroupSuper)-1;

?>
<?php function subCategory($id_category, $database_pravo, $pravo){
	mysql_select_db($database_pravo, $pravo);
	$query_RecordsetDocCategorySub = sprintf("SELECT dg.id_doc_group, dg.name name, dg.forcesubscribe, dt.name dtname FROM doc_group dg, doc_type dt WHERE dg.id_doc_type=dt.id_doc_type AND id_supergroup = %s", GetSQLValueString($id_category, "int"));
	$RecordsetDocCategorySub = mysql_query($query_RecordsetDocCategorySub, $pravo) or die(mysql_error());
	$row_RecordsetDocCategorySub = mysql_fetch_assoc($RecordsetDocCategorySub);
	$totalRows_RecordsetDocCategorySub = mysql_num_rows($RecordsetDocCategorySub);
	
	if($totalRows_RecordsetDocCategorySub>0){
?>
<table width="100%" cellspacing="0">
<?php $i=0; do { ?>
    <tr <?php if($i%2==0) echo "style='background:#fbf7e0'" ?>>
    	<td width="4%" valign="top">
       <?php if($i<$totalRows_RecordsetDocCategorySub-1) {?>
	      <img src="../images/dot_cros2.png"/>
      <?php }else{ ?>
            <img src="../images/dot_cros3.png"/>
      <?php }?>
      </td>
       <td><a href="document_category.php?id=<?php echo $row_RecordsetDocCategorySub ['id_doc_group']; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a></td>
      <td><a href="document_category.php?id=<?php echo $row_RecordsetDocCategorySub ['id_doc_group']; ?>&mode=delete&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>" onClick="return confirm('Дали навистина сакате да го избришете документот!')"><img src="../images/cross.png" border="0" /></a></td>
      <td><?php echo $row_RecordsetDocCategorySub ['name']; ?></td>
      <td><?php echo $row_RecordsetDocCategorySub ['dtname']; ?></td>
      <td align="center">
	  <input type="checkbox" name="forcesubscribe" value="1"  disabled <?php if (!(strcmp(htmlentities($row_RecordsetDocCategorySub['forcesubscribe'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
	  </td>
    </tr>
    <tr>
    	<td></td>
    	<td colspan="5">
        <?php subCategory($row_RecordsetDocCategorySub['id_doc_group'],$database_pravo, $pravo); ?>
        </td>
     </tr>
    <?php $i++;} while ($row_RecordsetDocCategorySub = mysql_fetch_assoc($RecordsetDocCategorySub)); ?>
</table>
<?php }} ?>


<div align="left" style="height:22px; margin-left:-5px;  margin-top:-15px; width:510px; border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table cellpadding="0" cellspacing="0">
  <tr></tr>
  <tr>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="document_category.php?mode=new"><img src="../images/new.png" border="0" title="Нов документ" /></a></div></td>
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
<?php 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
		$id_supergroup=NULL;
		if(isset($_POST['subcategory'])){
			$id_supergroup=$_POST['subcategory'];
		}elseif(isset($_POST['category']))
			$id_supergroup=$_POST['category'];
  $insertSQL = sprintf("INSERT INTO doc_group ( id_doc_type, id_supergroup, name, forcesubscribe) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_doc_type'], "int"),
                       GetSQLValueString($id_supergroup, "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString(isset($_POST['forcesubscribe']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
  if($Result1){
	_show_message_color('Категоријата е успешно додадена!','GREEN');  
	if(isset($_GET['url']))
		$MM_redirectLoginSuccess=$_GET['url'];
	else
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];
	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";
  }
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	$id_supergroup=NULL;
	if(isset($_POST['subcategory'])){
		$id_supergroup=$_POST['subcategory'];
	}elseif(isset($_POST['category']))
		$id_supergroup=$_POST['category'];
  $updateSQL = sprintf("UPDATE doc_group SET name=%s, id_doc_type=%s, id_supergroup=%s, forcesubscribe=%s WHERE id_doc_group=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['id_doc_type'], "int"),
                       GetSQLValueString($id_supergroup, "int"),
                       GetSQLValueString(isset($_POST['forcesubscribe']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_doc_group'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
  if($Result1){
	_show_message_color('Категоријата е успешно изменета!','GREEN');
	if(isset($_GET['url']))
		$MM_redirectLoginSuccess=$_GET['url'];
	else
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";
  }
}

if ((isset($_GET['id'])) && ($_GET['id'] != "") && (isset($_GET['mode'])) && ($_GET['mode']=="delete")) {
  $deleteSQL = sprintf("DELETE FROM doc_group WHERE id_doc_group=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($deleteSQL, $pravo) or die(mysql_error());
  if($Result1){
	_show_message_color('Категоријата е успешно избришана!','GREEN');
	if(isset($_GET['url']))
		$MM_redirectLoginSuccess=$_GET['url'];
	else
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";
  }
}
?>
<?php if(isset($_GET['mode']) && (($_GET['mode']=="edit") || ($_GET['mode']=="new"))){ ?>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center" width="100%">
    <tr valign="baseline">
      <td nowrap align="right">Име:</td>
      <td><input type="text" name="name" value="<?php if(isset($_GET['mode']) && ($_GET['mode']=="edit"))  echo htmlentities($row_RecordsetDocCategoryEdit['name'], ENT_COMPAT, 'UTF-8'); ?>" size="50"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Тип на документ:</td>
      <td><select name="id_doc_type">
          <option>тип на документ</option>
        <?php 
do {  
?>
        <option value="<?php echo $row_RecordsetDocType['id_doc_type']?>" <?php if (!(strcmp($row_RecordsetDocType['id_doc_type'], htmlentities($row_RecordsetDocCategoryEdit['id_doc_type'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php  echo $row_RecordsetDocType['name']?></option>
        <?php
} while ($row_RecordsetDocType = mysql_fetch_assoc($RecordsetDocType));
?>
      </select></td>
    <tr>
    <form name=sel>
  	<tr>
        <td align='right'>Супер Супер категорија: </td>
        <td>
            <font id=category><select style='width:300px;'>
            <option value='0'>Супер Супер категорија</option> 
            </select></font>
        </td>
  	</tr>
	<tr>
        <td align='right'>Супер категорија: </td>
        <td>
            <font id=subcategory><select style='width:300px;' disabled>
            <option value='0'>Супер категорија</option> 
            </select></font>
        </td>
  	</tr>
    </form>
    <tr valign="baseline">
      <td nowrap align="right">Форсирај претплата:</td>
      <td><input type="checkbox" name="forcesubscribe" value="1"  <?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) if (!(strcmp(htmlentities($row_RecordsetDocCategoryEdit['forcesubscribe'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>
      <?php if(isset($_GET['mode']) && ($_GET['mode']=="edit")) { ?>
      	<input type="submit" value="Измени">
        <input type="hidden" name="MM_update" value="form2">
      <?php }else{ ?>
      	<input type="hidden" name="MM_insert" value="form2">
      	<input type="submit" value="Зачувај">
      <?php } ?>
      <a href="<?php echo $_GET['url']; ?>">Откажи</a>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id_doc_group" value="<?php echo $row_RecordsetDocCategoryEdit['id_doc_group']; ?>">
</form>
<?php } else { $i=0;?>
<table border="0">
  <tr style="background:url(../images/yellow-title-middle.png);">
    <td colspan="2">Aкција</td>
    <td>Име</td>
    <td>Тип</td>
    <td>Претплата</td>
  </tr>  
  <?php do { ?>
   <tr <?php if($i%2==0) echo "style='background:#fbf7e0'" ?>>
       <td><a href="document_category.php?id=<?php echo $row_RecordsetDocGroupSuper['id_doc_group']; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a></td>
      <td><a href="document_category.php?id=<?php echo $row_RecordsetDocGroupSuper['id_doc_group']; ?>&mode=delete&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>" onClick="return confirm('Дали навистина сакате да го избришете документот!')"><img src="../images/cross.png" border="0" /></a></td>
      <td><?php echo $row_RecordsetDocGroupSuper['name']; ?></td>
      <td><?php echo $row_RecordsetDocGroupSuper['dtname']; ?></td>
      <td align="center">
	  <input type="checkbox" name="forcesubscribe" value="1"  disabled <?php if (!(strcmp(htmlentities($row_RecordsetDocGroupSuper['forcesubscribe'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
	  </td>
    </tr>
    <tr>
    	<td colspan="5">
        <?php subCategory($row_RecordsetDocGroupSuper['id_doc_group'],$database_pravo, $pravo); ?>
        </td>
     </tr>
    <?php $i++;} while ($row_RecordsetDocGroupSuper = mysql_fetch_assoc($RecordsetDocGroupSuper)); ?>
</table>
<?php } ?>
<script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val,sel) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //ÃÑº¤èÒ¡ÅÑºÁÒ
               } 
          }
     };
     req.open("GET", "util/categoryAjax.php?data="+src+"&val="+val+"&sel="+sel); //ÊÃéÒ§ connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
     req.send(null); //Êè§¤èÒ
}

	<?php if($subcat!=-1) { ?>
	window.onload=dochange('category',-1,<?php echo $cat; ?> );
	<?php }if($subsubcat!=-1) { ?>
	window.onload=dochange('subcategory',<?php echo $cat; ?>,<?php echo $subcat; ?>);
	<?php }if($cat==-1){ ?>
	window.onload=dochange('category',-1,-1 );
	<?php } ?>
</script>
<?php
mysql_free_result($RecordsetDocType);
mysql_free_result($RecordsetDocGroup);
mysql_free_result($RecordsetDocCategoryEdit);
?>