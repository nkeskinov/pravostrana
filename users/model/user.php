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

/* if (!isset($_SESSION)) {
  session_start();
} */


//echo strpos($_SERVER['PHP_SELF'],'profile.php');
//echo "od users ".isset($_SESSION['MM_ID']) ? $_SESSION['MM_ID'] : 0;

$editFormAction = $_SERVER['PHP_SELF']."?edit";

if (isset($_SERVER['QUERY_STRING']) && ($_SERVER['QUERY_STRING'] != "")) {
  $editFormAction .= "&" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_pravo, $pravo);
$RecordsetUsers = NULL;
$row_RecordsetUsers = NULL;
if(isset($_SESSION['MM_ID']) && strpos($_SERVER['PHP_SELF'],'profile.php') != false){
	$query_RecordsetUsers = sprintf("SELECT * FROM `user` where id_user = %s",GetSQLValueString($_SESSION['MM_ID'],"int"));
	
	//echo $query_RecordsetUsers;
	$RecordsetUsers = mysql_query($query_RecordsetUsers, $pravo) or die(mysql_error());
	$row_RecordsetUsers = mysql_fetch_assoc($RecordsetUsers);
	$totalRows_RecordsetUsers = mysql_num_rows($RecordsetUsers);
	//print_r($row_RecordsetUsers);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $data_na_raganje=$_POST['godina']."-".$_POST['mesec'].".".$_POST['den'];
  $updateSQL = sprintf("UPDATE `user` SET username=%s, name=%s, surname=%s, id_user_occupation=%s, email=%s, id_user_organization=%s, date_of_birth=%s, sex=%s, address=%s, city=%s, country=%s, phone=%s WHERE id_user=%s",
                       GetSQLValueString($_POST['username'], "text"),

                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['occupation'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['organization'], "int"),
                       GetSQLValueString($data_na_raganje, "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_SESSION['MM_ID'], "int"));

  mysql_select_db($database_pravo, $pravo);
  $Result2 = mysql_query($updateSQL, $pravo) or die(mysql_error());
  if($Result2){
			echo '<br />';
			_show_message_color('Вашите податоци се успешно изменети!','GREEN');

			
  }else{
	  echo '<br />';
	 _show_message_color('Настана грешка при измена на податоците!','RED');		
  }
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 	mysql_select_db($database_pravo, $pravo);
	
	$query1=sprintf("SELECT * from user WHERE username=%s",GetSQLValueString($_POST['username'], "text"));
	$username= mysql_query($query1, $pravo) or die(mysql_error());
	$totalRows2 = mysql_num_rows($username);
 	if($totalRows2>0){
		echo '<br />';
		_show_message_color("Корисничкото име ".$_POST['username']." веќе постои! Внесете ново корисничко име за успешно да се логирате!","RED");
		printInsertUser($_SERVER['PHP_SELF'],$row_RecordsetUsers,$pravo);
	}else{
	$data_na_raganje=$_POST['godina']."-".$_POST['mesec'].".".$_POST['den'];
 $insertSQL = sprintf("INSERT INTO `user` (name, surname, sex, date_of_birth, phone, id_user_occupation, id_user_organization, address, city, country, username, password, email, password_question, password_answer, is_approved) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($data_na_raganje, "date"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['occupation'], "int"),
                       GetSQLValueString($_POST['organization'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password_question'], "text"),
                       GetSQLValueString($_POST['password_answer'], "text"),
					   GetSQLValueString(isset($_POST['is_approved']) ? "true" : "", "defined","1","0"));
	
  
  if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
		// Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
		$Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
		if($Result1){
			$_SESSION['MM_Username'] = $_POST['username'];
			$_SESSION['MM_UserGroup'] = 'user';	
			$_SESSION['MM_Name'] = $_POST['name']." ".$_POST['surname'];
			$_SESSION['MM_ID'] = mysql_insert_id();
			
			echo '<br />';
			_show_message_color('Вашата регистрација беше успешно завршена!','GREEN');
			echo '<div align="center"><form action="index.php" method="get">
		 <input type="submit" name="button2" id="button2" value="Во ред" />
		 </form></div>';
		 	
		  }
		
		unset($_SESSION['security_code']);
   } else {
	   $_SESSION['prvpat'] = false;
		// Insert your code for showing an error message here
		echo '<br />';
		_show_message_color('Безбедносниот код е невалиден!','RED');
		printInsertUser($_SERVER['PHP_SELF'],$row_RecordsetUsers,$pravo);
   }
}
 /* $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  */
} else{
	//povikuvanje na funkcijata za pecatenje na formata
	//if(isset($_GET['new']))
	printInsertUser($_SERVER['PHP_SELF'],$row_RecordsetUsers,$pravo);
}


?>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script type="text/javascript" src="javaScripts/jquery.js"></script> 
<script type="text/javascript" src="javaScripts/jquery.pstrength-min.1.2.js">
</script>
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('.password').pstrength();
});

</script>
<?php function printInsertUser($editFormAction,$row_RecordsetUsers,$pravo){ 
//user_occupation select
//mysql_select_db($database_pravo, $pravo);
$query_Recordset2 = "SELECT * FROM user_occupation ORDER BY id_user_occupation ASC";
$Recordset2 = mysql_query($query_Recordset2, $pravo) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

//user_organization select
//mysql_select_db($database_pravo, $pravo);
$query_Recordset3 = "SELECT * FROM user_organization ORDER BY user_organization.id_user_organization ASC";
$Recordset3 = mysql_query($query_Recordset3, $pravo) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center" width="100%">
   <tr valign="baseline">
      <td colspan="3"><h4>1. Основни податоци</h4></td>
    </tr>
    <tr valign="baseline">
      <td width="192" align="right" nowrap>Име:</td>
      <td colspan="2"><span id="sprytextfield1">
        <input type="text" name="name" value="
			<?php 	if(isset($_POST['name'])) 
						echo $_POST['name'];
					elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['name'], ENT_COMPAT, 'utf-8'); 
					else echo "";?>" size="32">
      <span class="textfieldRequiredMsg">Името е задолжително.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Презиме:</td>
      <td colspan="2"><span id="sprytextfield2">
        <input name="surname" type="text" value="
			<?php if(isset($_POST['surname'])) 
					echo $_POST['surname'];
					elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['surname'], ENT_COMPAT, 'utf-8'); 
					else echo "";?>" size="32">
      <span class="textfieldRequiredMsg">Презимето е задолжително.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Пол:</td>
      <td colspan="2"><span id="spryselect1">
        <select name="sex">
          <option value="" >- Избери пол -</option>
          <option value="0" <?php if (!(strcmp(0, htmlentities($row_RecordsetUsers['sex'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Машки</option>
          <option value="1" <?php if (!(strcmp(1, htmlentities($row_RecordsetUsers['sex'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Женски</option>
        </select>
      <span class="selectRequiredMsg">Ве молиме изберете пол.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Дата на раѓање: <?php echo substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2); ?></td>
      <td colspan="2"><select name="den">
      	<option value="">Ден</option>
        <option value="1" <?php if (!(strcmp("01",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>1</option>
        <option value="2" <?php if (!(strcmp("02",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>2</option>
        <option value="3" <?php if (!(strcmp("03",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>3</option>
        <option value="4" <?php if (!(strcmp("04",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>4</option>
        <option value="5" <?php if (!(strcmp("05",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>5</option>
        <option value="6" <?php if (!(strcmp("06",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>6</option>
        <option value="7" <?php if (!(strcmp("07",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>7</option>
        <option value="8" <?php if (!(strcmp("08",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>8</option>
        <option value="9" <?php if (!(strcmp("09",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>9</option>
        <option value="10" <?php if (!(strcmp("10",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>10</option>
        <option value="11" <?php if (!(strcmp("11",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>11</option>
        <option value="12" <?php if (!(strcmp("12",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>12</option>
        <option value="13" <?php if (!(strcmp("13",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>13</option>
        <option value="14" <?php if (!(strcmp("14",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>14</option>
        <option value="15" <?php if (!(strcmp("15",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>15</option>
        <option value="16" <?php if (!(strcmp("16",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>16</option>
        <option value="17" <?php if (!(strcmp("17",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>17</option>
        <option value="18" <?php if (!(strcmp("18",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>18</option>
        <option value="19" <?php if (!(strcmp("19",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>19</option>
        <option value="20" <?php if (!(strcmp("20",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>20</option>        
        <option value="21" <?php if (!(strcmp("21",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>21</option>
        <option value="22" <?php if (!(strcmp("22",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>22</option>
        <option value="23" <?php if (!(strcmp("23",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>23</option>
        <option value="24" <?php if (!(strcmp("24",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>24</option>
        <option value="25" <?php if (!(strcmp("25",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>25</option>
        <option value="26" <?php if (!(strcmp("26",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>26</option>
        <option value="27" <?php if (!(strcmp("27",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>27</option>
        <option value="28" <?php if (!(strcmp("28",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>28</option>
        <option value="29" <?php if (!(strcmp("29",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>29</option>
        <option value="30" <?php if (!(strcmp("30",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>30</option>
        <option value="31" <?php if (!(strcmp("31",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),7,3))))) {echo "SELECTED";} ?>>31</option>                
      </select>
      <select name="mesec" style="width:80px">
      <option value="">Месец</option>
        <option value="1" <?php if (!(strcmp("01",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Јануари</option>
        <option value="2" <?php if (!(strcmp("02",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Февруари</option>
        <option value="3" <?php if (!(strcmp("03",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Март</option>
        <option value="4" <?php if (!(strcmp("04",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Април</option>
        <option value="5" <?php if (!(strcmp("05",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Мај</option>
        <option value="6" <?php if (!(strcmp("06",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Јуни</option>
        <option value="7" <?php if (!(strcmp("07",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Јули</option>
        <option value="8" <?php if (!(strcmp("08",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Август</option>
        <option value="9" <?php if (!(strcmp("09",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Септември</option>
        <option value="10" <?php if (!(strcmp("10",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Октомври</option>
        <option value="11" <?php if (!(strcmp("11",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Ноември</option>
        <option value="12" <?php if (!(strcmp("12",str_replace("-","",substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),5,2))))) {echo "SELECTED";} ?>>Декември</option>
      </select>
        <select name="godina">
        <option value="<?php echo substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),0,4); ?>"><?php echo substr(htmlentities($row_RecordsetUsers['date_of_birth'], ENT_COMPAT, 'utf-8'),0,4); ?></option>
        <option value="">Година</option>
        <option value="1990">1990</option>
        <option value="1989">1989</option>
        <option value="1988">1988</option>
        <option value="1987">1987</option>
        <option value="1986">1986</option>
        <option value="1985">1985</option>
        <option value="1984">1984</option>
        <option value="1983">1983</option>
        <option value="1982">1982</option>
        <option value="1981">1981</option>
        <option value="1980">1980</option>
        <option value="1982">1982</option>
        <option value="1981">1981</option>
        <option value="1980">1980</option>
        <option value="1979">1979</option>
        <option value="1978">1978</option>
        <option value="1977">1977</option>
        <option value="1976">1976</option>
        <option value="1975">1975</option>
        <option value="1974">1974</option>
        <option value="1973">1973</option>
        <option value="1972">1972</option>
        <option value="1971">1971</option>
        <option value="1970">1970</option>
        <option value="1969">1969</option>
        <option value="1968">1968</option>
        <option value="1967">1967</option>
        <option value="1966">1966</option>
        <option value="1965">1965</option>
        <option value="1964">1964</option>
        <option value="1963">1963</option>
        <option value="1962">1962</option>
        <option value="1961">1961</option>
        <option value="1960">1960</option>
        <option value="1959">1959</option>
        <option value="1958">1958</option>
        <option value="1957">1957</option>
        <option value="1956">1956</option>
        <option value="1955">1955</option>
        <option value="1954">1954</option>
        <option value="1953">1953</option>
        <option value="1952">1952</option>
        <option value="1951">1951</option>
        <option value="1950">1950</option>
        <option value="1949">1949</option>
        <option value="1948">1948</option>
        <option value="1947">1947</option>
        <option value="1946">1946</option>
        <option value="1945">1945</option>
        <option value="1944">1944</option>
        <option value="1943">1943</option>
        <option value="1942">1942</option>
        <option value="1941">1941</option>
        <option value="1940">1940</option>
        <option value="1939">1939</option>
        <option value="1938">1938</option>
        <option value="1937">1937</option>
        <option value="1936">1936</option>
        <option value="1935">1935</option>
        <option value="1934">1934</option>
        <option value="1933">1933</option>
        <option value="1932">1932</option>
        <option value="1931">1931</option>
        <option value="1930">1930</option>
        <option value="1929">1929</option>
        <option value="1928">1928</option>
        <option value="1927">1927</option>
        <option value="1926">1926</option>
        <option value="1925">1925</option>
        <option value="1924">1924</option>
        <option value="1923">1923</option>
        <option value="1922">1922</option>
        <option value="1921">1921</option>
        <option value="1920">1920</option>
        <option value="1919">1919</option>
        <option value="1918">1918</option>
        <option value="1917">1917</option>
        <option value="1916">1916</option>
        <option value="1915">1915</option>
        <option value="1914">1914</option>
        <option value="1913">1913</option>
        <option value="1912">1912</option>
        <option value="1911">1911</option>
        <option value="1910">1910</option>
        <option value="1909">1909</option>
        <option value="1908">1908</option>
        <option value="1907">1907</option>
        <option value="1906">1906</option>
        <option value="1905">1905</option>
        <option value="1904">1904</option>
        <option value="1903">1903</option>
        <option value="1902">1902</option>
        <option value="1901">1901</option>
        <option value="1900">1900</option>
      </select>
      <input type="hidden" name="date_of_birth" value="asd" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Телефон:</td>
      <td colspan="2"><input type="text" name="phone" value="<?php if(isset($_POST['phone'])) 
						echo $_POST['phone'];
					elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['phone'], ENT_COMPAT, 'utf-8'); 
					else echo "";?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Занимање:</td>
      <td colspan="2"><select name="occupation" size="1">
        <option value="" <?php if (!(strcmp("", $row_RecordsetUsers['id_user_occupation']))) {echo "selected=\"selected\"";} ?>>Одбери...</option>
        <?php
do {
?>
        <option value="<?php echo $row_Recordset2['id_user_occupation']?>"<?php if (!(strcmp($row_Recordset2['id_user_occupation'], $row_RecordsetUsers['id_user_occupation']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['name']?></option>
        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
	$rows = mysql_num_rows($Recordset2);
  	if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  	}
?>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Организација:</td>
      <td colspan="2"><select name="organization" size="1">
        <option value="" <?php if (!(strcmp("", $row_RecordsetUsers['id_user_organization']))) {echo "selected=\"selected\"";} ?>>Одбери...</option>
        <?php
do {  
?>
        <option value="<?php echo $row_Recordset3['id_user_organization']?>"<?php if (!(strcmp($row_Recordset3['id_user_organization'], $row_RecordsetUsers['id_user_organization']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset3['name']?></option>
        <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Адреса:</td>
      <td colspan="2"><textarea name="address" cols="40" rows="3"><?php if(isset($_POST['address'])) 
					echo $_POST['address'];
					elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['address'], ENT_COMPAT, 'utf-8'); 
					else echo "";?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Град:</td>
      <td colspan="2"><input type="text" name="city" value="<?php if(isset($_POST['city'])) 
					echo $_POST['city'];
					elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['city'], ENT_COMPAT, 'utf-8'); 
					else echo "";?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Држава:</td>
      <td colspan="2">
      <select name="country">
      <option value="">Избери држава...</option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="American Samoa">American Samoa</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
    
        <option value="Anguilla">Anguilla</option>
        <option value="Antarctica">Antarctica</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Aruba">Aruba</option>
    
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
    
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bermuda">Bermuda</option>
    
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Bouvet Island">Bouvet Island</option>
        <option value="Brazil">Brazil</option>
    
        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
        <option value="Brunei Darussalam">Brunei Darussalam</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cambodia">Cambodia</option>
    
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Cape Verde">Cape Verde</option>
        <option value="Cayman Islands">Cayman Islands</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
    
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Christmas Island">Christmas Island</option>
        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
    
        <option value="Congo">Congo</option>
        <option value="Cook Islands">Cook Islands</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Cote D'Ivoire">Cote D'Ivoire</option>
        <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
        <option value="Cuba">Cuba</option>
    
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
    
        <option value="East Timor">East Timor</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
    
        <option value="Estonia">Estonia</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
        <option value="Faroe Islands">Faroe Islands</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
    
        <option value="France">France</option>
        <option value="France; Metropolitan">France; Metropolitan</option>
        <option value="French Guiana">French Guiana</option>
        <option value="French Polynesia">French Polynesia</option>
        <option value="French Southern Territories">French Southern Territories</option>
        <option value="Gabon">Gabon</option>
    
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Gibraltar">Gibraltar</option>
        <option value="Greece">Greece</option>
    
        <option value="Greenland">Greenland</option>
        <option value="Grenada">Grenada</option>
        <option value="Guadeloupe">Guadeloupe</option>
        <option value="Guam">Guam</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guinea">Guinea</option>
    
        <option value="Guinea-Bissau">Guinea-Bissau</option>
        <option value="Guyana">Guyana</option>
        <option value="Haiti">Haiti</option>
        <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
        <option value="Honduras">Honduras</option>
        <option value="Hong Kong">Hong Kong</option>
    
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="India">India</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
        <option value="Iraq">Iraq</option>
    
        <option value="Ireland">Ireland</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
    
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati">Kiribati</option>
        <option value="Korea; Democratic People's Republic of">Korea; Democratic People's Republic of</option>
        <option value="Korea; Republic of">Korea; Republic of</option>
    
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>
        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Lesotho">Lesotho</option>
    
        <option value="Liberia">Liberia</option>
        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Macau">Macau</option>
    
        <option value="Македонија" selected="selected">Македонија</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malawi">Malawi</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
    
        <option value="Malta">Malta</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Martinique">Martinique</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mayotte">Mayotte</option>
    
        <option value="Mexico">Mexico</option>
        <option value="Micronesia; Federated States of">Micronesia; Federated States of</option>
        <option value="Moldova; Republic of">Moldova; Republic of</option>
        <option value="Monaco">Monaco</option>
        <option value="MN">Mongolia</option>
        <option value="Montserrat">Montserrat</option>
    
        <option value="Morocco">Morocco</option>
        <option value="Mozambique">Mozambique</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Namibia">Namibia</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
    
        <option value="Netherlands">Netherlands</option>
        <option value="Netherlands Antilles">Netherlands Antilles</option>
        <option value="New Caledonia">New Caledonia</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nicaragua">Nicaragua</option>
        <option value="Niger">Niger</option>
    
        <option value="Nigeria">Nigeria</option>
        <option value="Niue">Niue</option>
        <option value="Norfolk Island">Norfolk Island</option>
        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
        <option value="Norway">Norway</option>
        <option value="Oman">Oman</option>
    
        <option value="Pakistan">Pakistan</option>
        <option value="Palau">Palau</option>
        <option value="Palestine">Palestine</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
    
        <option value="Peru">Peru</option>
        <option value="Philippines">Philippines</option>
        <option value="Pitcairn">Pitcairn</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Puerto Rico">Puerto Rico</option>
    
        <option value="Qatar">Qatar</option>
        <option value="Reunion">Reunion</option>
        <option value="Romania">Romania</option>
        <option value="Russian Federation">Russian Federation</option>
        <option value="Rwanda">Rwanda</option>
        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    
        <option value="Saint Lucia">Saint Lucia</option>
        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
        <option value="Samoa">Samoa</option>
        <option value="San Marino">San Marino</option>
        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
    
        <option value="Senegal">Senegal</option>
        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Sierra Leone">Sierra Leone</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
    
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="Somalia">Somalia</option>
        <option value="South Africa">South Africa</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
    
        <option value="St. Helena">St. Helena</option>
        <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
        <option value="Sudan">Sudan</option>
        <option value="Suriname">Suriname</option>
        <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
        <option value="Swaziland">Swaziland</option>
    
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
        <option value="Taiwan">Taiwan</option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Tanzania; United Republic of">Tanzania; United Republic of</option>
    
        <option value="Thailand">Thailand</option>
        <option value="Togo">Togo</option>
        <option value="Tokelau">Tokelau</option>
        <option value="Tonga">Tonga</option>
        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
        <option value="Tunisia">Tunisia</option>
    
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
        <option value="Tuvalu">Tuvalu</option>
        <option value="Uganda">Uganda</option>
        <option value="Ukraine">Ukraine</option>
    
        <option value="United Arab Emirates">United Arab Emirates</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States of America">United States of America</option>
        <option value="Uruguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>
        <option value="Vanuatu">Vanuatu</option>
    
        <option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Vietnam">Vietnam</option>
        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
        <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
        <option value="Wales">Wales</option>
    
        <option value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
        <option value="Western Sahara">Western Sahara</option>
        <option value="Yemen">Yemen</option>
        <option value="Zaire">Zaire</option>
        <option value="Zambia">Zambia</option>
        <option value="Zimbabwe">Zimbabwe</option>
    </select>  
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="3" align="right" nowrap style="border-bottom:1px dotted #CCC;">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="3"><h4>2. Вашето корисничко име и лозинка</h4></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Корисничко име - E-mail:</td>
      <td colspan="2"><span id="sprytextfield3">
      <input type="text" name="username" value="<?php 
	  			if(isset($_POST['username'])) 
					echo $_POST['username'];
				elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['username'], ENT_COMPAT, 'utf-8'); 
				else echo "";?>	" size="32" />
      <span class="textfieldRequiredMsg">Е-mail е задолжителен.</span><span class="textfieldInvalidFormatMsg">Неправилен формат на email адресата.</span></span></td>
    </tr>
    <?php if(strpos($editFormAction,'profile.php') == false) { ?>
    <tr valign="baseline">
      <td nowrap align="right">Лозинка:</td>
      <td colspan="2"><span id="sprypassword1">
       <input class="password" type="password" id="password" name="password" value="" size="32">
      <span class="passwordRequiredMsg">Лозинката е задолжителна.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Повтори Лозинка:</td>
      <td colspan="2"><span id="spryconfirm1">
        <input type="password" name="password2" id="password2" value="" size="32" />
      <span class="confirmRequiredMsg">Лозинката е задолжителна.</span><span class="confirmInvalidMsg">Лозинките не се софпаѓаат.</span></span></td>
    </tr>
    <?php } ?>
    <tr valign="baseline">
      <td colspan="3" align="right" nowrap style="border-bottom:1px dotted #CCC;">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="3"><h4>3. Во случај да ги заборавите корисничкото име и лозинката...</h4></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Алтернативна E-mail:</td>
      <td colspan="2"><span id="sprytextfield4">
      <input type="text" name="email" value="<?php if(isset($_POST['email']))
	  						echo $_POST['email'];
						elseif(isset($_SESSION['MM_ID'])) 
							echo htmlentities($row_RecordsetUsers['email'], ENT_COMPAT, 'utf-8'); 
						else echo "";?>" size="32" />
      <span class="textfieldRequiredMsg">Алтернативната е-mail адреса е задолжителна.</span><span class="textfieldInvalidFormatMsg">Неправилен формат на email адресата.</span></span></td>
    </tr>
    <?php if(strpos($editFormAction,'profile.php') == false) { ?>
    <tr valign="baseline">
      <td nowrap align="right">Безбедносно прашање:</td>
      <td colspan="2"><span id="spryselect2">
        <select name="password_question">
          <option value="" >- Изберете едно - </option>
          <option value="Кое е името на Вашиот најстар братучед?" <?php if (!(strcmp("Кое е името на Вашиот најстар братучед?", ""))) {echo "SELECTED";} ?>>Кое е името на Вашиот најстар братучед?</option>
          <option value="Каде ја запознавте жена/маж ви?" <?php if (!(strcmp("Каде ја запознавте жена/маж ви?", ""))) {echo "SELECTED";} ?>>Каде ја запознавте жена/маж ви?</option>
          <option value="Каде бевте на меден месец?" <?php if (!(strcmp("Каде бевте на меден месец?", ""))) {echo "SELECTED";} ?>>Каде бевте на меден месец?</option>
          <option value="Кое е вашето омилено животно?" <?php if (!(strcmp("Кое е вашето омилено животно?", ""))) {echo "SELECTED";} ?>>Кое е вашето омилено животно?</option>
          <option value="Кое е името на вашата омилена тетка?" <?php if (!(strcmp("Кое е името на вашата омилена тетка?", ""))) {echo "SELECTED";} ?>>Кое е името на вашата омилена тетка?</option>
          <option value="Кое е името на вашиот најстар внук?" <?php if (!(strcmp("Кое е името на вашиот најстар внук?", ""))) {echo "SELECTED";} ?>>Кое е името на вашиот најстар внук?</option>
        </select>
      <span class="selectRequiredMsg">Изберете едно прашање.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Одговор:</td>
      <td colspan="2"><span id="sprytextfield5">
        <input type="text" name="password_answer" value="<?php if(isset($_POST['password_answer'])) echo $_POST['password_answer']; ?>" size="32" />
      <span class="textfieldRequiredMsg">Одговорот е задолжителен.</span></span></td>
    </tr>

    <tr valign="baseline">
      <td colspan="3" align="right" nowrap style="border-bottom:1px dotted #CCC;">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="3"><h4>4. Уште неколку детали...</h4></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Безбедносен код:</td>
      <td width="313"><span id="sprytextfield7">
      <span class="textfieldRequiredMsg">Безбедносниот код е задолжителен.</span>
        <input id="security_code" name="security_code" type="text" />
      </span></td>
      <td width="354"><span style="font-size:11px;">Ова ни помага да спречиме спам и лажни регистрации. </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"></td>
      <td colspan="2" valign="top"><img src="includes/captcha/CaptchaSecurityImages.php?width=100&amp;height=40&amp;characters=5" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="3" align="right" nowrap style="border-bottom:1px dotted #CCC;">&nbsp;</td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right">Дали се согласувате?</td>
      <td colspan="2">
        <span id="sprycheckbox1">
        
        <input name="is_approved" type="checkbox" value="" <?php if(isset($_POST['is_approved'])) if (!(strcmp(htmlentities($_POST['is_approved'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>  />
      Ги прочитав и се согласувам со <a href="#" >pravo.org.mk Услови на услугата</a> и <a href="#">Политика за приватност</a>. <span class="checkboxRequiredMsg">Мора да се согласите со полисата.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td colspan="2"><input type="submit" name="submit" value="Регистрирај ме!" />
      <a href="index.php">Откажи</a>
      </td>
    </tr>
   <?php } ?>
   <?php if(isset($_SESSION['MM_ID']) && strpos($editFormAction,'profile.php') != false) { ?>
   <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td colspan="2"><input type="submit" name="edit" value="Измени" />
      <a href="index.php">Откажи</a>
      </td>
    </tr>
    <?php } ?>
  </table>
  
  <?php if(isset($_SESSION['MM_ID']) && strpos($editFormAction,'profile.php') != false) { ?>
  <input type="hidden" name="MM_update" value="form1">
  <?php }else{ ?>
  <input type="hidden" name="MM_insert" value="form1">
  <?php } ?>
</form>

<?php       } ?>
<p>&nbsp;</p>

<?php
//mysql_free_result($RecordsetUsers);
?>
<?php if(!isset($_SESSION['MM_ID'])) { ?>
	<script type="text/javascript">
	<!--
		var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
		var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
		var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
		var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
		var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
		var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
		var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
		var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
		var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["change"]});
		var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
	//-->
	</script>

<?php } else{?>
<script type="text/javascript">
<!--
	var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
		var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
		var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
		var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
		var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
		var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
		var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
		var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
		var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");

		var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
//-->
</script>
<?php 
}

//TODO: ovie da se stavat na krajot od funkcijata
//mysql_free_result($Recordset2);
//mysql_free_result($Recordset3);
?>
