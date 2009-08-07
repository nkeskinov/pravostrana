<?php
	
	if(isset($_POST['reset']) && ($_POST['reset']=="form1")){
		  mysql_select_db($database_pravo, $pravo);
		 $Query=sprintf("SELECT username, password,  name, surname FROM `user` WHERE username=%s OR email=%s",
		  GetSQLValueString($_POST['email'], "text"), GetSQLValueString($_POST['email'], "text")); 
		   
		  $Result = mysql_query($Query, $pravo) or die(mysql_error());
		  $FoundUser = mysql_num_rows($Result);
		  if ($FoundUser) {
			$username=mysql_result($Result,0,'username');
			$password=mysql_result($Result,0,'password');
			$name=mysql_result($Result,0,'name');
			$surname=mysql_result($Result,0,'surname');
			$to_email=$_POST['email'];
			
			$subject="Вашата лозинка за Pravo.org.mk";
			$Message="Почитувани, $name $surname <br /><br />";
			$Message.="Го примивме вашето барање за ресетрање на вашата <strong>Pravo.org.mk</strong> лозинка и ";
			$Message.="соодветно ви ги праќаме следниве информации: <br /><br />";
			$Message.="Корисничко име: <strong>$username</strong><br />";
			$Message.="Лозинка:<strong> $password</strong><br /><br />";
			$Message.="Ве молиме не давајте ги вашето корисничко име и лозинка на никој!<br />";
			$Message.="Ви благодариме што користевте Pravo.org.mk <br /><br />";
			$Message.="Со почит,<br />";
			$Message.="Pravo.org.mk тимот";
			
			//echo $Message;
			send_mail("Pravo.org.mk","no-reply@pravo.org.mk",$to_email,$subject,$Message);
			_show_message_color('Вашата лозинка е испратена на вашата email адреса!','GREEN');
		  }else{
			_show_message_color('Вашата email адреса не е најдена во нашата база!','RED');    
		  }
	}
   
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<?php if(!isset($_POST['reset'])) {?>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div style="padding-left:20px">
  <table border="0" cellpadding="3" cellspacing="2">
    <tr>
      <td colspan="2">Внесете ја вашата емаил адреса и лозинката ќе ви биде испратена</td>
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
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
//-->
</script>
