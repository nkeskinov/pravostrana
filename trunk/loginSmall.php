<?php include("util/login.php"); ?>
<?php if((!isset( $_SESSION['MM_Username'] )) or (!isset($_SESSION['MM_UserGroup']))){  ?>
<div class="login">
              <div class="title">Најавување</div>
                <div class="forms">
                <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="form1">
                  <table width="100%" border="0" cellspacing="0">
              <tr>
                        <td>Корисничко име:</td>
                        <td ><input name="username_login" type="text" id="username_login" size="17" /></td>
                    </tr>
                      <tr>
                        <td>Лозинка:</td>
                        <td><input name="password_login" type="password" id="password_login" size="17" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><div align="right" style="padding-top:5px;">
                          <input type="submit" name="button" id="button" value="Логирај ме!" style="background-color:#993300; color:#FFFFFF" />
                        </div></td>
                      </tr>
                      <tr>
                        <td colspan="2"><?php if(isset($loginFoundUser) && !$loginFoundUser) {?>
                        <div style="color:#F00;">Корисничкото име и лозинката не се совпаѓаат</div>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><div align="center" class="down">Заборави лозинка? |<a href="register.php?new">Регистрирај се!</a></div></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>
                    </form>
	</div>
</div>
<?php }elseif((isset( $_SESSION['MM_Username'] )) and  (isset($_SESSION['MM_UserGroup']))){ ?>
	<div class="login">
              <div class="title">Успешно најавен</div>
                <div class="forms">
                
                  <table width="100%" border="0" cellspacing="0">
              		<tr>
                        <td colspan="2" align="right">Добредојде,  <a href="profile.php" title="Промени ги твоите лични податоци" alt="Промени ги твоите лични податоци"><?php if(isset($_SESSION['MM_Name'])) echo $_SESSION['MM_Name']; ?></a></td>
                    </tr>
                      <tr>
                        <td></td>
                        <td align="right">[<a href="logout.php?doLogout=true">Одјави се</a>]</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right">&nbsp;</td>
                      </tr>
                    </table>
                    <br />
	</div>
</div>

<?php } ?>

