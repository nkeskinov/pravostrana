<?php

mysql_select_db($database_pravo, $pravo);
$query_Court = "SELECT * FROM doc_meta WHERE id_doc_type=4";
$Court = mysql_query($query_Court, $pravo) or die(mysql_error());
$row_Court = mysql_fetch_assoc($Court);
$totalRows_Court = mysql_num_rows($Court);

mysql_select_db($database_pravo, $pravo);
$query_CourtCategory = "SELECT * FROM doc_group  where id_doc_type=4 ORDER BY id_doc_group ASC";
$CourtCategory = mysql_query($query_CourtCategory, $pravo) or die(mysql_error());
$row_CourtCategory = mysql_fetch_assoc($CourtCategory);
$totalRows_CourtCategory = mysql_num_rows($CourtCategory);


?>

<form action="courtpractice.php" method="get" name="practice">
<table width="96%" border="0" cellspacing="2" cellpadding="0">
 <tr>
    <td>&nbsp;</td>
    <td align="right">
      <a href="JavaScript:popUpWindow('help.php?id=2','','',450,'280');" class="search_advices">совети за пребарување</a>
    </td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td>Име:</td>
    <td>
      <input type="text" name="name" id="name" onkeyup="this.form.name.value=toCyr(this.form.name.value)" />
    </td>
  </tr>
  <tr>
    <td>Суд:</td>
    <td><select name="court">
      <option value="0">Избери суд</option>
      <?php
do {  
?>
      <option value="<?php echo $row_Court['id_doc_meta']?>"><?php echo $row_Court['name']?></option>
      <?php
} while ($row_Court = mysql_fetch_assoc($Court));
  $rows = mysql_num_rows($Court);
  if($rows > 0) {
      mysql_data_seek($Court, 0);
	  $row_Court = mysql_fetch_assoc($Court);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td>Категорија:</td>
    <td><select name="id_doc_group">
      <option value="0">Изберете категорија</option>
      <?php
do {  
?>
      <option value="<?php echo $row_CourtCategory['id_doc_group']?>"><?php echo $row_CourtCategory['name']?></option>
      <?php
} while ($row_CourtCategory = mysql_fetch_assoc($CourtCategory));
  $rows = mysql_num_rows($CourtCategory);
  if($rows > 0) {
      mysql_data_seek($CourtCategory, 0);
	  $row_CourtCategory = mysql_fetch_assoc($CourtCategory);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td>Година:</td>
    <td><input name="year1" type="text" size="3"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="button" id="button" value="Барај">
    </td>
  </tr>
</table>
</form>
<?php
mysql_free_result($Court);

mysql_free_result($CourtCategory);
?>
