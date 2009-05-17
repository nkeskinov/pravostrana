<?php require_once('Connections/pravo.php'); ?>
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
$query_Recordset1 = "SELECT * FROM doc_group";
$Recordset1 = mysql_query($query_Recordset1, $pravo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<script language="JavaScript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
  if(popUpWin)
  {
    if(!popUpWin.closed) popUpWin.close();
  }
  var wint=0;
  var winl=0;
  if(screen.width){
	  winl=(screen.width-width)/2;
	  wint=(screen.height-height)/2;
  }
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  
  popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=yes,width='+width+',height='+height+',left='+winl+', top='+wint+',screenX='+winl+',screenY='+wint+'');
}


</script>
<form action="documentlaws.php" method="get">
<table width="100%" border="0">
<tr>
    <td colspan="2" align="left"><div align="right" style="font-size:11px;"><a href="JavaScript:popUpWindow('help.php?id=1','','',450,'330');">совети за пребарување</a></div>
    <strong>Пребарувај по почетна буква на законот</strong>
    </td>
  </tr>
<tr>
    <td colspan="2" align="left"><div><a href="#">А</a> 
    <a href="#">Б</a> 
    <a href="#">В</a> 
    <a href="#">Г</a> 
    <a href="#">Д</a> 
    <a href="#">Ѓ</a> 
    <a href="#">Е</a> 
    <a href="#">Ж</a> 
    <a href="#">З</a> 
    <a href="#">Ѕ</a> 
    <a href="#">И</a> 
    <a href="#">Ј</a> 
    <a href="#">К</a> 
    <a href="#">Л</a> 
    <a href="#">Љ</a> 
    <a href="#">М</a> 
    <a href="#">Њ</a> 
    <a href="#">О</a> 
    <a href="#">П</a> 
    <a href="#">Р</a> 
    <a href="#">С</a> 
    <a href="#">Т</a> 
    <a href="#">Ќ</a> 
    <a href="#">У</a> 
    <a href="#">Ф</a> 
    <a href="#">Х</a> 
    <a href="#">Ц</a> 
    <a href="#">Џ</a> 
    <a href="#">Ш</a></div></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="76%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">Име на законот: </td>
    <td><input name="name" type="text" size="35" onkeyup="this.form.name.value=toCyr(this.form.name.value)"></td>
  </tr>
  <tr>
    <td align="left">Група: </td>
    <td>
    	<select name="id_doc_group">
        <option value="0">Изберете група</option>
        <?php 
do {  
?>
        <option value="<?php echo $row_Recordset1['id_doc_group']?>" ><?php echo $row_Recordset1['name']?></option>
        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
      </select>
    </td>
  </tr>
  <tr>
    <td align="left">Број / Година: </td>
    <td><label>
      <input name="number" type="text" id="number" size="4">
      /
      <input name="year" type="text" id="year" size="4">
    </label></td>
  </tr>
  <tr>
    <td align="left">Клучен збор: </td>
    <td><label>
      <input name="keyword" type="text" id="keyword" size="50">
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><label>
      <input type="submit" name="button" id="button" value="Барај">
    </label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
