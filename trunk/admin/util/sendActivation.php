<?php
	if(isset($_POST['send'])){
		$key=hash_hmac('ripemd160', $_POST['username'],'register');
			$to_email=$_POST['username'];
			$name= $_POST['name'];
			$surname= $_POST['surname'];
			$subject="Активација на корисничка сметка на Pravo.org.mk";
			$Message="Почитуван/а $name $surname, <br /><br />";
			$Message.="Го примивме вашето барање за регистрирање на вашата корисничка сметка на <strong>Pravo.org.mk</strong><br />";
			$Message.="За да ја активирате вашата корисничка сметка кликнете на следниот линк или копирајте ";
			$Message.="го истиот во полето за интернет адреса на вашиот прелистувач: <br /><br />";
			$Message.="<a href='http://pravo.org.mk/activate.php?key=$key&email=$to_email'>http://pravo.org.mk/activate.php?key=$key&email=$to_email</a>";
			$Message.="<br /><br />Со почит,<br />";
			$Message.="Pravo.org.mk тимот";
			
			//echo $Message;
			send_mail("Pravo.org.mk","no-reply@pravo.org.mk",$to_email,$subject,$Message);
			
			_show_message_color('Регистрацискиот код беше успешно пратен!','GREEN');
	}

?>
<?php if(!(isset($_POST['send']))) { ?>
<div style="padding:5px;">
<form name="form1" method="post" action="">
  <table width="400" border="0">
    <tr>
      <td>Име:</td>
      <td><label>
        <input name="name" type="text" id="name" size="30">
      </label></td>
    </tr>
    <tr>
      <td>Презиме:</td>
      <td><label>
        <input name="surname" type="text" id="surname" size="30">
      </label></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><label>
        <input name="username" type="text" id="username" size="40">
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="button" id="button" value="Прати">
        <input type="hidden" name="send" value="form1">
      </label></td>
    </tr>
  </table>
</form>
</div>
<?php } ?>