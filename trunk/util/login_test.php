<?php include("util/login.php"); ?>
<?php if(!isset( $_SESSION['MM_Username'] ) || !isset($_SESSION['MM_UserGroup'])){  ?>
                <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="form1">
<div style="width:288px;" align="right">
<input name="username_login" size="15" placeholder="E-mail" >
<input name="password_login" type="password" size="15" placeholder="Лозинка">
</div>
<div align="right" style="padding-top:0px; width:288px">
<a href="resetPassword.php">Заборави лозинка?</a> | <a href="register.php?new">Регистрирај се!</a>
  <input type="submit" name="button" id="button" value="Внеси" style="background-color:#993300; color:#FFFFFF" />
                  </div>
                  <div align="right" class="down"></div>
<?php if(isset($loginFoundUser) && !$loginFoundUser && isset($loginUserNotActivated) && !$loginUserNotActivated) {?>
                        <div style="color:#F00; width:300px">Корисничкото име и лозинката не се совпаѓаат.</div>
                        <?php } elseif(isset($loginUserNotActivated) && $loginUserNotActivated) {?>
                        <div style="color:#F00;">Вашата корисничка сметка не е активирана!<br />Проверете го вашиот e-mail за активациската порака.</div>
                        <?php } ?>
</form>
<?php }elseif(isset( $_SESSION['MM_Username'] ) &&  isset($_SESSION['MM_UserGroup'])){ ?>
	<div class="login" style="border-bottom:1px solid #f5e6a2; width:288px; height:87px;">
             
                <div class="forms" >
                
                  <table width="98%" border="0" cellspacing="0">
              		<tr>
                        <td align="right" style=" padding-left:5px;"><a href="profile.php" title="Промени ги твоите лични податоци" alt="Промени ги твоите лични податоци"><strong>
                              <?php if(isset($_SESSION['MM_Name'])) echo $_SESSION['MM_Name']; ?></strong></a>&nbsp;[<a href="logout.php?doLogout=true">Одјави се</a>]</td>
                    </tr>
                      <tr>
                        <td align="right"><?php if(isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup']=="admin"){ ?>
                        	&nbsp;<span style="color:#FFF;">&raquo;</span>&nbsp;<a href="admin/">Администраторски панел</a>
                            <?php } ?>
                        </td>
                      </tr>
                    </table>
                    <br />
	</div>
</div>

<?php } ?>

