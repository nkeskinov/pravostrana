<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<?php require("../util/uploader.php"); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_pravo, $pravo);
$query_Oranization = "SELECT * FROM organization";
$Oranization = mysql_query($query_Oranization, $pravo) or die(mysql_error());
$row_Oranization = mysql_fetch_assoc($Oranization);
$totalRows_Oranization = mysql_num_rows($Oranization);

$colname_Banner = "-1";
if (isset($_GET['id'])) {
  $colname_Banner = $_GET['id'];
}
mysql_select_db($database_pravo, $pravo);
$query_Banner = sprintf("SELECT * FROM banner WHERE id_banner = %s", GetSQLValueString($colname_Banner, "int"));
$Banner = mysql_query($query_Banner, $pravo) or die(mysql_error());
$row_Banner = mysql_fetch_assoc($Banner);
$totalRows_Banner = mysql_num_rows($Banner);

mysql_select_db($database_pravo, $pravo);
$query_Banner_All = "SELECT * FROM banner";
$Banner_All = mysql_query($query_Banner_All, $pravo) or die(mysql_error());
$row_Banner_All = mysql_fetch_assoc($Banner_All);
$totalRows_Banner_All = mysql_num_rows($Banner_All);



?>

<div align="left" style="height:22px;  width:99%; border-bottom:1px solid #a25852; background:#f5d6d4;  padding:3px; padding-top:1px;">
  <table cellpadding="0" cellspacing="0">
  <tr></tr>
  <tr>
    <td><div style="width:26px; height:21px; padding-top:1.5px; float:left; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="banner.php?mode=new"><img src="../images/new.png" border="0" title="Нов банер" /></a></div></td>
    <td>
    <div style="width:26px; height:21px; padding-top:2px; float:left; text-align:center;" ONMOUSEOVER="this.className='picture-button-over'" ONMOUSEOUT="this.className='picture-button-out'">
        <a href="documentlaws.php?id=<?php echo $row_Banner['id_banner']; ?>&mode=delete" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="../images/delete.png" border="0" title="Бриши"  /></a></div>
    </td>
    <td><div style="width:26px; height:21px; padding-top:1.5px; text-align:center;" onmouseover="this.className='picture-button-over'" onmouseout="this.className='picture-button-out'"> <a href="#"><img src="../images/print.png" border="0" title="Печати страна" /></a></div></td>
  </tr>
  </table>
</div>
<?php

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$directory = "banners";
	
	$filetype = $_SESSION['filetype'];
	$filename = $_SESSION['filename'];
	$filesize = $_SESSION['filesize'];
	$ext =  substr(strrpos($filetype,"/"),3);
	$old = "../download/tmp/".$filename;
	$new = "../images/".$directory."/".$filename;
	$path = "images/".$directory."/".$filename;
	if(!file_exists($new)){
		rename($old,$new); //move the file from the tmp folder
		$message = " Банерот".$new." e закачен!";
		_show_message_color($message,'YELLOW');  	
	}
	
	$created_by = isset($_SESSION['MM_ID']) ? $_SESSION['MM_ID'] : 0 ;
	
	$checkSQL=sprintf("SELECT * FROM banner WHERE position = %s AND visible = 1",GetSQLValueString($_POST['position'], "int"));
	$Check = mysql_query($checkSQL, $pravo) or die(mysql_error());
	if(mysql_num_rows($Check)>0){
		$id_banner = mysql_result($Check,0,'id_banner');
		$updateVisible = sprintf("UPDATE banner SET visible=0 WHERE id_banner=%s",GetSQLValueString($id_banner, "int"));	
		$UpdateResult = mysql_query($updateVisible, $pravo) or die(mysql_error());
	}
	
  $insertSQL = sprintf("INSERT INTO banner (title, alt, id_organization, id_user, `path`, `position`, type, visible, mimetype, filesize, extension, url) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['alt'], "text"),
                       GetSQLValueString($_POST['id_organization'], "int"),
                       GetSQLValueString($created_by, "int"),
                       GetSQLValueString($path, "text"),
                       GetSQLValueString($_POST['position'], "int"),
                       GetSQLValueString($filetype, "text"),
                       GetSQLValueString(isset($_POST['visible']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($filetype, "text"),
                       GetSQLValueString($filesize, "int"),
                       GetSQLValueString($ext, "text"),
					   GetSQLValueString($_POST['url'], "text"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
  if($Result1){
		_show_message_color('Банерот е успешно додаден!','GREEN');  
		if(isset($_GET['url']))
			$MM_redirectLoginSuccess=$_GET['url'];
		else
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
		echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
		echo "<script>'Content-type: application/octet-stream'</script>";
  }
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$directory = "banners";
	if(isset($_GET['change']) && $_GET['change']=="true"){
		$filetype = $_SESSION['filetype'];
		$filename = $_SESSION['filename'];
		$filesize = $_SESSION['filesize'];
		$ext =  substr(strrpos($filetype,"/"),3);
		$old = "../download/tmp/".$filename;
		$new = "../images/".$directory."/".$filename;
		$path = "images/".$directory."/".$filename;
		if(!file_exists($new)){
			rename($old,$new); //move the file from the tmp folder
			$message = " Банерот".$new." e закачен!";
			_show_message_color($message,'YELLOW');  	
		}
	}else{
		$path = $_POST['path'];	
		$filetype = $_POST['mimetype'];
		$filesize = $_POST['filesize'];
		$ext = $_POST['extension'];
	}
	$created_by = isset($_SESSION['MM_ID']) ? $_SESSION['MM_ID'] : 0 ;
	

	mysql_select_db($database_pravo, $pravo);
	
	$checkSQL=sprintf("SELECT * FROM banner WHERE position = %s AND visible = 1",GetSQLValueString($_POST['position'], "int"));
	$Check = mysql_query($checkSQL, $pravo) or die(mysql_error());
	if(mysql_num_rows($Check)>0){
		$id_banner = mysql_result($Check,0,'id_banner');
		$updateVisible = sprintf("UPDATE banner SET visible=0 WHERE id_banner=%s",GetSQLValueString($id_banner, "int"));	
		$UpdateResult = mysql_query($updateVisible, $pravo) or die(mysql_error());
	}
	
  $updateSQL = sprintf("UPDATE banner SET title=%s, alt=%s, `position`=%s, visible=%s, id_organization=%s, type=%s, id_user=%s, `path`=%s, mimetype=%s, filesize=%s, extension=%s, url=%s WHERE id_banner=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['alt'], "text"),
                       GetSQLValueString($_POST['position'], "int"),
                       GetSQLValueString(isset($_POST['visible']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['id_organization'], "int"),
                       GetSQLValueString($filetype, "text"),
                       GetSQLValueString($created_by, "int"),
                       GetSQLValueString($path, "text"),
                       GetSQLValueString($filetype, "text"),
                       GetSQLValueString($filesize, "int"),
                       GetSQLValueString($ext, "text"),
					   GetSQLValueString($_POST['url'], "text"),
                       GetSQLValueString($_POST['id_banner'], "int"));

  
  $Result1 = mysql_query($updateSQL, $pravo) or die(mysql_error());
  if($Result1){
		_show_message_color('Банерот е успешно изменет!','GREEN');    
		if(isset($_GET['url']))
			$MM_redirectLoginSuccess=$_GET['url'];
		else
			$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
		echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
		echo "<script>'Content-type: application/octet-stream'</script>";
  }
}

if ((isset($_GET['id'])) && ($_GET['id'] != "") && (isset($_GET['mode'])) && ($_GET['mode']=="delete")) {
  $deleteSQL = sprintf("DELETE FROM banner WHERE id_banner=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result1 = mysql_query($deleteSQL, $pravo) or die(mysql_error());
  if($Result1){
	_show_message_color('Банерот е успешно избришан!','GREEN');
	if(isset($_GET['url']))
		$MM_redirectLoginSuccess=$_GET['url'];
	else
		$MM_redirectLoginSuccess=$_SERVER['PHP_SELF'];	
	echo "<script>document.location.href='".$MM_redirectLoginSuccess."'</script>";
	echo "<script>'Content-type: application/octet-stream'</script>";
  }
}


?>
<?php if(isset($_GET['mode']) && ($_GET['mode']=="new" || $_GET['mode']=="edit" ) || isset($_GET['id'])){ ?>

<?php if((isset($_GET['change']) && ($_GET['change']=="true")) || (!(isset($_GET['mode'])) && ($_GET['mode']="true"))) { ?>
<form method="post" name="form1" target="upload_iframe"
 action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
<table width="100%" align="center" >
<tr>
    <td width="28%" align="right" valign="top">Избери документ:</td>
    <td width="72%">
    <input type="hidden" name="fileframe" value="true">
    <input type="file" name="file" id="file" onChange="jsUpload(this)">
          <br />
    <input type="text" name="upload_status" id="upload_status" 
           value="Документот не е закачен" size="50" disabled>
      </td>
  </tr>
</table>
</form>
<script type="text/javascript">
/* This function is called when user selects file in file dialog */
function jsUpload(upload_field)
{
    // this is just an example of checking file extensions
    // if you do not need extension checking, remove 
    // everything down to line
    // upload_field.form.submit();

    var re_text = /\.gif|\.jpg|\.swf|\.pdf|\.png/i;
    var filename = upload_field.value;

    /* Checking file type */
    if (filename.search(re_text) == -1)
    {
        alert("File does not have text(gif, jpg, swf, png, pdf) extension");
        upload_field.form.reset();
        return false;
    }

    upload_field.form.submit();
	document.getElementById('upload_status').style.backgroundColor = "#EEFFEE";
	document.getElementById('upload_status').style.borderColor = "#00FF00";
    document.getElementById('upload_status').value = "uploading file...";
    upload_field.disabled = true;
    return true;
}
</script>
<iframe name="upload_iframe" style="width: 400px; height: 100px; display: none">
</iframe>
<!-- For debugging purposes, it's often useful to remove
     "display: none" from style="" attribute -->
<?php } ?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="100%" align="center">
    <tr valign="baseline">
      <td width="28%" align="right" nowrap>Наслов:</td>
      <td width="72%"><input type="text" name="title" id="title" value="<?php echo htmlentities($row_Banner['title'], ENT_COMPAT, 'utf-8'); ?>" size="32">
      <input name="filename" type="hidden" id="filename" />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Текст на mouse-over:</td>
      <td><input type="text" name="alt" value="<?php echo htmlentities($row_Banner['alt'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Url:</td>
      <td><input type="text" name="url" value="<?php echo htmlentities($row_Banner['url'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Позиција:</td>
      <td><select name="position">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_Banner['position'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>1</option>
        <option value="2" <?php if (!(strcmp(2, htmlentities($row_Banner['position'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>2</option>
        <option value="3" <?php if (!(strcmp(3, htmlentities($row_Banner['position'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>3</option>
        <option value="4" <?php if (!(strcmp(4, htmlentities($row_Banner['position'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>4</option>
        <option value="5" <?php if (!(strcmp(5, htmlentities($row_Banner['position'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>5</option>
        <option value="6" <?php if (!(strcmp(6, htmlentities($row_Banner['position'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>6</option>
        <option value="7" <?php if (!(strcmp(7, htmlentities($row_Banner['position'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>7</option>
      </select>
      <span style="color:#F00"> Внимание!!! Големината на банерот да одговара според позицијата долу на сликата. Големините и позициите се најдолу во табела</span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Видлив:</td>
      <td><input type="checkbox" name="visible" id="visible" value=""  <?php if (!(strcmp(htmlentities($row_Banner['visible'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Организација:</td>
      <td><select name="id_organization">
        <?php 
do {  
?>
        <option value="<?php echo $row_Oranization['id_organization']?>" <?php if (!(strcmp($row_Oranization['id_organization'], htmlentities($row_Banner['id_organization'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_Oranization['name']?></option>
        <?php
} while ($row_Oranization = mysql_fetch_assoc($Oranization));
?>
      </select></td></tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap>
      <input type="hidden" name="path" value="<?php echo $row_Banner['path']; ?>" />
      <input type="hidden" name="mimetype" value="<?php echo $row_Banner['mimetype']; ?>" />
      <input type="hidden" name="filesize" value="<?php echo $row_Banner['filesize']; ?>" />
      <input type="hidden" name="extension" value="<?php echo $row_Banner['extension']; ?>" />
      <?php if($row_Banner['mimetype'] == "image/jpeg" || $row_Banner['mimetype'] == "image/gif" || $row_Banner['mimetype'] == "image/png") {
		echo '<img src="../'.$row_Banner['path'].'"/>';
		}
		elseif($row_Banner['mimetype'] == "application/x-shockwave-flash"  ) { ?>		
		<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
          <param name="movie" value="../<?php echo $row_Banner['path']; ?>" />
          <param name="quality" value="high" />
          <param name="wmode" value="opaque" />
          <param name="swfversion" value="6.0.65.0" />
          <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
          <param name="expressinstall" value="Scripts/expressInstall.swf" />
          <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
          <!--[if !IE]>-->
          <object type="application/x-shockwave-flash" data="../<?php echo $row_Banner['path']; ?>" width="728" height="90">
            <!--<![endif]-->
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="6.0.65.0" />
            <param name="expressinstall" value="Scripts/expressInstall.swf" />
            <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
            <div>
              <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
              <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
            </div>
            <!--[if !IE]>-->
        </object>
          <!--<![endif]-->
        </object>
        <script type="text/javascript">
        <!--
        swfobject.registerObject("FlashID");
        //-->
        </script>
	<?php } ?>
      <a href="<?php echo "?".$_SERVER['QUERY_STRING']."&change=true" ?>">замени</a>
      </td>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>
      <?php if(isset($_GET['id'])){ ?>
      <input type="submit" name="button" value="Измени" >
      <input type="hidden" name="MM_update" value="form1" />
	  <?php }else{ ?>
      <input type="submit" id="upload_button" value="Зачувај" disabled>	
      <input type="hidden" name="MM_insert" value="form1" />
      <?php } ?>
      <a href="<?php echo $_GET['url']; ?>">Откажи</a>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id_banner" value="<?php echo $row_Banner['id_banner']; ?>">
</form>
<p>&nbsp;</p>
<div align="center"><img src="../images/marketing.jpg" /></div>
<table width="100%" border="0">
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">Опис</th>
    <th scope="col">Димензии</th>
    <th scope="col">Максимална големина</th>
    <th scope="col">Цена/неделно</th>
  </tr>
  <tr>
    <th scope="row">Позиција 1</th>
    <td align="center">Leaderboard</td>
    <td align="center">728 x 90</td>
    <td align="center">40 KB</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Позиција 2</th>
    <td align="center">Half Banner</td>
    <td align="center">234 x 60</td>
    <td align="center">40 KB</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Позиција 3</th>
    <td align="center">Medium Rectangle</td>
    <td align="center">250 x 250</td>
    <td align="center">40 KB</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Позиција 4</th>
    <td align="center">Medium Rectangle</td>
    <td align="center">250 x 250</td>
    <td align="center">40 KB</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Позиција 5</th>
    <td align="center">Wide Skyscraper</td>
    <td align="center">160 x 600</td>
    <td align="center">40 KB</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Позиција 6</th>
    <td align="center">Full Banner</td>
    <td align="center">468 x 60</td>
    <td align="center">40 KB</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Позиција 7</th>
    <td align="center">Full Banner</td>
    <td align="center">468 x 60</td>
    <td align="center">40 KB</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<?php } else{ ?>
<br />
<table width="100%" border="0">
  <tr style="background:url(../images/yellow-title-middle.png);">
    <td colspan="2">Акција</td>
    <td>Наслов</td>
    <td>Алт</td>
    <td>Позиција</td>
    <td>Видлив</td>
    <td>url</td>
    <td>Слика</td>    
  </tr>
  <?php $i=0; do { ?>
  <tr  <?php if($i%2==0) echo "style='background:#fbf7e0'" ?> valign="top">
  <td width="16"><a href="banner.php?id=<?php echo $row_Banner_All['id_banner']; ?>&mode=edit&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"><img src="../images/pencil.png" border="0" /></a></td>
      <td width="16"><a href="banner.php?id=<?php echo $row_Banner_All['id_banner']; ?>&mode=delete&url=<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>" onClick="return confirm('Дали навистина сакате да го избришете документот?')"><img src="../images/cross.png" border="0" /></a></td>
    <td><?php echo $row_Banner_All['title']; ?></td>
    <td><?php echo $row_Banner_All['alt']; ?></td>
    <td><?php echo $row_Banner_All['position']; ?></td>
    <td>
    <input type="checkbox" disabled <?php if (!(strcmp(htmlentities($row_Banner_All['visible'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
    </td>
    <td><?php echo $row_Banner_All['url']; ?></td>
    <td>
    <?php if($row_Banner_All['mimetype'] == "image/jpeg" || $row_Banner_All['mimetype'] == "image/gif" || $row_Banner_All['mimetype'] == "image/png") {
		echo '<img src="../'.$row_Banner_All['path'].'" width="250px"/>';
		} ?>
    </td>
  </tr>
  <?php $i++; } while ($row_Banner_All = mysql_fetch_assoc($Banner_All)); ?>
</table>
<?php } ?>
<?php
mysql_free_result($Oranization);
?>
<?php
mysql_free_result($Banner);

mysql_free_result($Banner_All);
?>
