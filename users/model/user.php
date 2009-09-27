<?php

if (!isset($_SESSION)) {
  session_start();
}


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
	mysql_select_db($database_pravo, $pravo);
	$password = mysql_result($RecordsetUsers,0,'password');
	if(isset($_POST['changepass'])){
		if($password == $_POST['password-old']){
			$updateSQL1 = sprintf("UPDATE `user` SET password=password(%s) WHERE id_user=%s",
								  GetSQLValueString($_POST['password-new1'], "text"),
								  GetSQLValueString($_SESSION['MM_ID'], "int"));
			$Result3 = mysql_query($updateSQL1, $pravo) or die(mysql_error());	
			
		}else{
			echo '<br />';
	 		_show_message_color('Лозинките не се совпаѓаат!','RED');		
		}
		
	}
 
 	$data_na_raganje=$_POST['godina']."-".$_POST['mesec'].".".$_POST['den'];
 	$updateSQL = sprintf("UPDATE `user` SET username=%s, name=%s, surname=%s, id_user_occupation=%s, email=%s, id_user_organization=%s, date_of_birth=%s, sex=%s, address=%s, city=%s, country=%s, phone=%s WHERE id_user=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['occupation'], "int"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['organization'], "int"),
                       GetSQLValueString($data_na_raganje, "date"),
                       GetSQLValueString($_POST['sex'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_SESSION['MM_ID'], "int"));

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
		_show_message_color("Корисничкото име (e-mail адресата) ".$_POST['username']." веќе постои!<br/>Внесете ново корисничко име за успешно да се регистрирате.<br/>Доколку имате пристап до e-mail адресата пробајте да ја повратите на <a href='resetPassword.php'><u>овој линк</u></a>.","RED");
		printInsertUser($_SERVER['PHP_SELF'],$row_RecordsetUsers,$pravo);
	}else{
	$data_na_raganje=$_POST['godina']."-".$_POST['mesec'].".".$_POST['den'];
 $insertSQL = sprintf("INSERT INTO `user` (name, surname, sex, date_of_birth, phone, id_user_occupation, id_user_organization, address, city, country, username, password, email, is_approved, id_user_category) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, password(%s), %s, %s, %s)",
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
                       GetSQLValueString($_POST['username'], "text"),
					   GetSQLValueString(0,"int"),
					   GetSQLValueString(1,"int"));
	
  
  if( !empty($_SESSION['security_code']) && $_SESSION['security_code'] == $_POST['security_code'] ) {
		// Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
		$Result1 = mysql_query($insertSQL, $pravo) or die(mysql_error());
		if($Result1){
			//$_SESSION['MM_Username'] = $_POST['username'];
			//$_SESSION['MM_UserGroup'] = 'user';	
			//$_SESSION['MM_Name'] = $_POST['name']." ".$_POST['surname'];
			//$_SESSION['MM_ID'] = mysql_insert_id();
			
			echo '<br />';
			_show_message_color('<p style="font-size: 150%;">Вашата регистрација беше успешно завршена!<br />Проверете го вашиот e-mail за да ја комплетирате регистрацијата. Имајте во предвид дека треба да помине извесно време за пораката да стигне до вашето e-mail сандаче.</p><p style="font-weight: bold; font-size: 150%;">Не заборавајте да го проверите вашиот Spam фолдер!</p>','YELLOW');

			$key=hash_hmac('ripemd160', $_POST['username'],'register');
			$to_email=$_POST['username'];
			$name= $_POST['name'];
			$surname= $_POST['surname'];
			$sex = $_POST['sex'];
			$subject="Активација на корисничка сметка на Pravo.org.mk";
			$Message="Почитуван".($sex == '0' ? '' : 'а')." $name $surname, <br /><br />";
			$Message.="Го примивме вашето барање за регистрирање на вашата корисничка сметка на <strong>Pravo.org.mk</strong><br />";
			$Message.="За да ја активирате вашата корисничка сметка кликнете на следниот линк или копирајте ";
			$Message.="го истиот во полето за интернет адреса на вашиот прелистувач: <br /><br />";
			$Message.="<a href='http://pravo.org.mk/activate.php?key=$key&email=$to_email'>http://pravo.org.mk/activate.php?key=$key&email=$to_email</a>";
			$Message.="<br /><br />Со почит,<br />";
			$Message.="Pravo.org.mk тимот";
			
			//echo $Message;
			send_mail("Pravo.org.mk","no-reply@pravo.org.mk",$to_email,$subject,$Message);
			
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
        <input type="text" name="name" value="<?php 	
					if(isset($_POST['name'])) 
						echo $_POST['name'];
					elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['name'], ENT_COMPAT, 'utf-8'); 
					else echo "";?>" size="32" />
      <span class="textfieldRequiredMsg">Името е задолжително.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Презиме:</td>
      <td colspan="2"><span id="sprytextfield2">
        <input name="surname" type="text" value="<?php 
				if(isset($_POST['surname'])) 
					echo $_POST['surname'];
					elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['surname'], ENT_COMPAT, 'utf-8'); 
					else echo "";?>" size="32" />
      <span class="textfieldRequiredMsg">Презимето е задолжително.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Пол:</td>
      <td colspan="2"><span id="spryselect1">
        <select name="sex">
        <?php
			$actualUserSex = '';
			if (isset($_POST['sex'])){
				$actualUserSex = $_POST['sex'];
			} elseif (isset($_SESSION['MM_ID'])) {
				$actualUserSex = $row_RecordsetUsers['sex'];
			}
		?>
          <option value=""<?php echo ($actualUserSex == '' ? ' selected="selected" ' : ''); ?>>Избери пол</option>
          <option value="0"<?php echo ($actualUserSex == '0' ? ' selected="selected" ' : ''); ?>>Машки</option>
          <option value="1"<?php echo ($actualUserSex == '1' ? ' selected="selected" ' : ''); ?>>Женски</option>
        </select>
      <span class="selectRequiredMsg">Ве молиме изберете пол.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Датум на раѓање:</td>
      <td colspan="2"><select name="den">
      	<?php 
		$actualUserDay = '';
		if (isset($_POST['den'])){
			$actualUserDay = $_POST['den'];
		} elseif (isset($_SESSION['MM_ID'])) {
			$actualUserDay = date("j", strtotime($row_RecordsetUsers['date_of_birth']));
		}
		?>
      	<option value=""<?php echo ($actualUserDay == '') ? ' selected="selected" ' : ''; ?>>Ден</option>
        <?php
		for ($i = 1; $i <= 31; $i++) {
		?>
  			<option value="<?php echo $i; ?>"<?php echo ($actualUserDay == strval($i) ? ' selected="selected" ' : ''); ?>><?php echo $i; ?></option>
        <?php 
		}
		?>
      </select>
      <select name="mesec" style="width:100px">
      <?php 
		$actualUserMonth = '';
		if (isset($_POST['mesec'])){
			$actualUserMOnth = $_POST['mesec'];
		} elseif (isset($_SESSION['MM_ID'])) {
			$actualUserMonth = date("n", strtotime($row_RecordsetUsers['date_of_birth']));
		}
		?>
      <option value=""<?php echo ($actualUserMonth == '') ? ' selected="selected" ' : ''; ?>>Месец</option>
        <option value="1"<?php echo ($actualUserMonth == "1" ? ' selected="selected" ' : ''); ?>>Јануари</option>
        <option value="2"<?php echo ($actualUserMonth == "2" ? ' selected="selected" ' : ''); ?>>Февруари</option>
        <option value="3"<?php echo ($actualUserMonth == "3" ? ' selected="selected" ' : ''); ?>>Март</option>
        <option value="4"<?php echo ($actualUserMonth == "4" ? ' selected="selected" ' : ''); ?>>Април</option>
        <option value="5"<?php echo ($actualUserMonth == "5" ? ' selected="selected" ' : ''); ?>>Мај</option>
        <option value="6"<?php echo ($actualUserMonth == "6" ? ' selected="selected" ' : ''); ?>>Јуни</option>
        <option value="7"<?php echo ($actualUserMonth == "7" ? ' selected="selected" ' : ''); ?>>Јули</option>
        <option value="8"<?php echo ($actualUserMonth == "8" ? ' selected="selected" ' : ''); ?>>Август</option>
        <option value="9"<?php echo ($actualUserMonth == "9" ? ' selected="selected" ' : ''); ?>>Септември</option>
        <option value="10"<?php echo ($actualUserMonth == "10" ? ' selected="selected" ' : ''); ?>>Октомври</option>
        <option value="11"<?php echo ($actualUserMonth == "11" ? ' selected="selected" ' : ''); ?>>Ноември</option>
        <option value="12"<?php echo ($actualUserMonth == "12" ? ' selected="selected" ' : ''); ?>>Декември</option>
      </select>
        <select name="godina">
        <?php 
		$actualUserYear = '';
		if (isset($_POST['godina'])){
			$actualUserYear = $_POST['godina'];
		} elseif (isset($_SESSION['MM_ID'])) {
			$actualUserYear = date("Y", strtotime($row_RecordsetUsers['date_of_birth']));
		}
		?>
		<option value=""<?php echo ($actualUserYear == '') ? ' selected="selected" ' : ''; ?>>Година</option>;
        <?php
		$currentYear = intval(date("Y"));
		for ($i = $currentYear - 10; $i >= $currentYear - 100; $i--) {
		?>
			<option value="<?php echo $i; ?>"<?php echo ($actualUserYear == strval($i) ? ' selected="selected" ' : ''); ?>><?php echo $i; ?></option>
        <?php
		}
		?>
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
      <?php
	  $actualUserOccupation = '';
	  if (isset($_POST['occupation'])){
			$actualUserOccupation = $_POST['occupation'];
		} elseif (isset($_SESSION['MM_ID'])) {
			$actualUserOccupation = $row_RecordsetUsers['id_user_occupation'];
		}
	  ?>
        <option value=""<?php echo ($actualUserOccupation == '') ? ' selected="selected" ' : ''; ?>>Одбери...</option>
        <?php
do {
?>
        <option value="<?php echo $row_Recordset2['id_user_occupation']; ?>"<?php echo ($actualUserOccupation == $row_Recordset2['id_user_occupation'] ? ' selected="selected" ' : ''); ?>><?php echo $row_Recordset2['name']; ?></option>
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
        <?php
	  $actualUserOrganization = '';
	  if (isset($_POST['organization'])){
			$actualUserOrganization = $_POST['organization'];
		} elseif (isset($_SESSION['MM_ID'])) {
			$actualUserOrganization = $row_RecordsetUsers['id_user_organization'];
		}
	  ?>
        <option value=""<?php echo ($actualUserOrganization == '') ? ' selected="selected" ' : ''; ?>>Одбери...</option>
        <?php
do {
?>
        <option value="<?php echo $row_Recordset3['id_user_organization']; ?>"<?php echo ($actualUserOrganization == $row_Recordset3['id_user_organization'] ? ' selected="selected" ' : ''); ?>><?php echo $row_Recordset3['name']; ?></option>
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
    
        <option value="Македонија" selected='selected="selected"'>Македонија</option>
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
      <td colspan="3"><h4>2. Вашето корисничко име (e-mail) и лозинка</h4></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Корисничко име (<strong>валиден</strong> e-mail):</td>
      <td colspan="2"><span id="sprytextfield3">
        <input type="text" name="username" value="<?php
				if(isset($_POST['username'])) 
					echo $_POST['username'];
				elseif(isset($_SESSION['MM_ID'])) 
						echo htmlentities($row_RecordsetUsers['username'], ENT_COMPAT, 'utf-8'); 
				else echo "";?>" size="32" />
      <span class="textfieldRequiredMsg">Е-mail е задолжителен.</span><span class="textfieldInvalidFormatMsg">Неправилен формат на email адресата.</span></span></td>
    </tr>
    <?php if(strpos($editFormAction,'profile.php') == false) { ?>
    <tr valign="baseline">
      <td nowrap align="right">Лозинка:</td>
      <td colspan="2"><span id="sprypassword1">
       <input class="password" type="password" id="password" name="password" value="" size="32" />
      <span class="passwordRequiredMsg">Лозинката е задолжителна.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Повтори Лозинка:</td>
      <td colspan="2"><span id="spryconfirm1">
        <input type="password" name="password2" id="password2" value="" size="30" />
      <span class="confirmRequiredMsg">Лозинката е задолжителна.</span><span class="confirmInvalidMsg">Лозинките не се совпаѓаат.</span></span></td>
    </tr>
    <?php }else{ ?>	
    <?php if(isset($_GET['change']) && $_GET['change']=="password"){ ?>
    <tr valign="baseline">
      	<td nowrap align="right">Стара лозинка</td>
        <td colspan="2"><input type="password" name="password-old" id="password-old" value="" size="30" /></td>
    </tr>
    <tr valign="baseline">
      	<td nowrap align="right">Нова лозинка</td>
        <td colspan="2"><input type="password" name="password-new1" id="password-new1" value="" size="30" /></td>
    </tr>
    <tr valign="baseline">
      	<td nowrap align="right">Повтори лозинка</td>
        <td colspan="2"><input type="password" name="password-new2" id="password-new1" value="" size="30" />
        <input type="hidden" name="changepass" value="true" />
        </td>
    </tr>
    <?php }else{ ?>
    <tr valign="baseline">
      	<td nowrap align="right"></td>
        <td colspan="2"><a href="?change=password">Смени лозинка</a></td>
    </tr>
    <?php }} ?>
    <tr valign="baseline">
      <td colspan="3" align="right" nowrap style="border-bottom:1px dotted #CCC;">&nbsp;</td>
    </tr>
    <?php if(strpos($editFormAction,'profile.php') == false) { ?>
    <tr valign="baseline">
      <td colspan="3"><h4>3. Уште неколку детали...</h4></td>
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
		var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
		var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
		var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
		var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
		var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
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

		var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
//-->
</script>
<?php 
}

//TODO: ovie da se stavat na krajot od funkcijata
//mysql_free_result($Recordset2);
//mysql_free_result($Recordset3);
?>
