<?php
	
	if(isset($_GET['key']))
		$key=$_GET['key'];
	else
		$key=NULL;
	
	if(isset($_GET['email']))
		$email=$_GET['email'];
	else
		$email=NULL;
	
	
	mysql_select_db($database_pravo, $pravo);
	$Query=sprintf("SELECT * FROM `user` where username = %s",GetSQLValueString($email,"text"));
	
	$Result = mysql_query($Query, $pravo) or die(mysql_error());
	if(mysql_num_rows($Result)>0){
		$id_user=mysql_result($Result,0,'id_user');
		$username=mysql_result($Result,0,'username');
		$password=mysql_result($Result,0,'password');
		$key1=hash_hmac('ripemd160', $username,'register');
		if(!isset($_GET['reactivate'])){
			if($key1==$key){	
				$UpdateSQL=sprintf("UPDATE `user` SET is_approved=1 WHERE id_user=%s",
							   GetSQLValueString($id_user, "int"));
				$Result1 = mysql_query($UpdateSQL, $pravo) or die(mysql_error());
				if($Result1){
					_show_message_color('Вашата корисничка сметка е успешно активирана. 
										Кликнете на <u><a href="login.php">линкот</a></u> 
										за да се логирате и да почнете да ја користите услугата.','GREEN');
				}else{
					_show_message_color('Настана проблем при активација на вашата корисничка сметка.
										Обидете се уште еднаш или контактирајте не на support@pravo.org.mk','RED');	
				}
			}else{
				_show_message_color('Настана проблем при активација на вашата корисничка сметка. 
									Обидете се уште еднаш или контактирајте не на support@pravo.org.mk','RED');
			}
		}else{
			if(isset($_POST['reactivate'])){
				if($key1==$_POST['key']){
					$UpdateSQL=sprintf("UPDATE `user` SET is_approved=1, password=%s WHERE id_user=%s",
							   GetSQLValueString($_POST['password'], "text"),
							   GetSQLValueString($id_user, "int"));
					$Result1 = mysql_query($UpdateSQL, $pravo) or die(mysql_error());
					if($Result1){
						_show_message_color('Вашата корисничка сметка е успешно активирана. 
											Кликнете на на <u><a href="login.php">линкот</a></u> 
											за да се логирате и да почнете да ја користите услугата.','GREEN');
					}else{
						_show_message_color('Настана проблем при активација на вашата корисничка сметка.
											Обидете се уште еднаш или контактирајте не на 
											support@pravo.org.mk','RED');	
					}
				}else{
				_show_message_color('Настана проблем при активација на вашата корисничка сметка. 
									Обидете се уште еднаш или контактирајте не на support@pravo.org.mk','RED');
			}
			}
		}
		
	}
	
	
?>
<?php if(isset($_GET['reactivate']) && !isset($_POST['reactivate'])){ ?>
<p>Внесете нова лозинка за да ја активирате вашата корисничка сметка</p>
<div align="center">
<form id="form1" name="form1" method="post" action="">
  <label>Лозинка:
    <input type="password" name="password" id="password" />
  </label>
  <label>
    <input type="submit" name="button" id="button" value="Внеси" />
  </label>
  <input type="hidden" name="reactivate" />
  <input type="hidden" name="key" value="<?php if(isset($_GET['key'])) echo $_GET['key']; ?>" />
</form>
</div>
<p>
  <?php } ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
