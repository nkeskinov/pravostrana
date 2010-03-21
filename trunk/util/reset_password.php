<?php
	
	if(isset($_POST['reset']) && ($_POST['reset']=="form1")){
		  mysql_select_db($database_pravo, $pravo);
		 $Query=sprintf("SELECT username, password,  name, surname, sex FROM `user` WHERE username=%s OR email=%s",
		  GetSQLValueString($_POST['email'], "text"), GetSQLValueString($_POST['email'], "text")); 
		   
		  $Result = mysql_query($Query, $pravo) or die(mysql_error());
		  $FoundUser = mysql_num_rows($Result);
		  if ($FoundUser) {
			$username=mysql_result($Result,0,'username');
			$password=mysql_result($Result,0,'password');
			$name=mysql_result($Result,0,'name');
			$surname=mysql_result($Result,0,'surname');
			$sex = mysql_result($Result, 0, 'sex');
			$to_email=$_POST['email'];
			$key=hash_hmac('ripemd160', $username,'reset');
			
			$subject="Вашата лозинка за Pravo.org.mk";
			$Message="Почитуван".($sex == '0' ? '' : 'а')." $name $surname, <br /><br />";
			$Message.="Го примивме вашето барање за промена на вашата <strong>Pravo.org.mk</strong> лозинка. ";
			$Message.="<br />За да ја промените вашата лозинка кликнете на следниот линк или копирајте го истиот во полето за интернет адреса на вашиот прелистувач: <br /><br />";
			$Message.="<a href='http://pravo.org.mk/resetPassword.php?key=$key&email=$to_email'>http://pravo.org.mk/resetPassword.php?key=$key&email=$to_email</a>";
			$Message.="<br /><br />Ве молиме, не го делете корисничкото име и лозинката!<br />";
			$Message.="Ви благодариме што користевте Pravo.org.mk <br /><br />";
			$Message.="Со почит,<br />";
			$Message.="Pravo.org.mk тимот";
			
			//echo $Message;
			send_mail("Pravo.org.mk","no-reply@pravo.org.mk","$name $surname <$to_email>",$subject,$Message);
			_show_message_color("Инструкции за промена на вашата лозинка се пратени на ".$to_email,'GREEN');
		  }else{
			_show_message_color('Вашата email адреса не е најдена во нашата база!','RED');    
		  }
	}
	if(isset($_POST['changepass']) && $_POST['changepass']=="form2"){
		if(isset($_POST['key']))
			$key=$_POST['key'];
		else
			$key=NULL;
	
		if(isset($_POST['email']))
			$email=$_POST['email'];
		else
			$email=NULL;
		
		mysql_select_db($database_pravo, $pravo);
		$Query=sprintf("SELECT * FROM `user` where username = %s",GetSQLValueString($email,"text"));
		
		$Result = mysql_query($Query, $pravo) or die(mysql_error());
		if(mysql_num_rows($Result)>0){
			$id_user=mysql_result($Result,0,'id_user');
			$username=mysql_result($Result,0,'username');
			$key1=hash_hmac('ripemd160', $username,'reset');
			if($key1==$key){
				$updateQuery=sprintf("UPDATE `user` set password=password(%s) WHERE id_user=%s",
									 GetSQLValueString($_POST['password-new1'], "text"),
									 GetSQLValueString($id_user, "int"));
				$Result1 = mysql_query($updateQuery, $pravo) or die(mysql_error());
				if($Result1){
					_show_message_color('Вашата лозинка е успешно сменета. 
										Логирајте се со новата лозинка на следниов <u><a href="login.php">линк</a></u>.','GREEN');
				}else{
					_show_message_color('Настана проблем при промена на вашата лозинка.
										Обидете се уште еднаш или контактирајте не на support@pravo.org.mk','RED');	
				}
			}
		}
	}
   
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('.password-new1').pstrength();
});

</script>
<?php if(!isset($_POST['reset']) && !(isset($_GET['key'])) && !(isset($_POST['changepass']))) {?>
<form name="form1" method="post" action="<?php 
$selfArray = explode('/',$_SERVER['PHP_SELF']);
echo $selfArray[count($selfArray)-1];
?>">
  <div style="padding-left:20px">
  <table border="0" cellpadding="3" cellspacing="2">
    <tr>
      <td colspan="2">Внесете ја вашата e-mail адреса и ќе ви бидат испратени инструкции за промена на лозинката </td>
      </tr>
    <tr>
      <td align="right">E-mai:</td>
      <td><span id="sprytextfield1">
      <input name="email" type="text" id="email" size="50">
      <span class="textfieldRequiredMsg">Е-mail е задолжителен.</span><span class="textfieldInvalidFormatMsg">Неправилен формат на email адресата.</span></span></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="send" id="send" value="Прати">
        <input type="hidden" name="reset" value="form1" />
        </td>
      </tr>
  </table>
  </div>
</form>
<?php } ?>
<?php if(isset($_GET['key'])) { ?>
<form name="form2" method="post" action="<?php 
$selfArray = explode('/',$_SERVER['PHP_SELF']);
echo $selfArray[count($selfArray)-1]; 
?>">
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="2">Внесете нова лозинка</td>
    </tr>
    <tr>
      <td width="118">Нова лозинка:</td>
      <td width="372" align="left">
        <span id="sprypassword1">
        <input type="password" name="password-new1" id="password-new1" />
      <span class="passwordRequiredMsg">Лозинката е задолжителна.</span></span></td>
    </tr>
    <tr>
      <td>Поветорете ја лозинката:</td>
      <td align="left"><span id="spryconfirm1">
      <input type="password" name="password-new2" id="password-new2" />
      <span class="confirmRequiredMsg">Лозинката е задолжителна.</span><span class="confirmInvalidMsg">Лозинките не се совпаѓаат.</span></span>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="button" id="button" value="Внеси" />
      </label>
      <input type="hidden" name="changepass" value="form2" />
      <input type="hidden" name="key" value="<?php if(isset($_GET['key'])) echo $_GET['key']; ?>" />
      <input type="hidden" name="email" value="<?php if(isset($_GET['email'])) echo $_GET['email']; ?>" />
      </td>
    </tr>
  </table>
</form>
<?php } ?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
<?php if(isset($_GET['key'])) { ?>
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password-new1", {validateOn:["change"]});
<?php } ?>

//-->
</script>
