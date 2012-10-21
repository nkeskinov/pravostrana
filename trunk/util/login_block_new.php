<?php include("util/login.php"); ?>
<?php if(!isset( $_SESSION['MM_Username'] ) || !isset($_SESSION['MM_UserGroup'])){  ?>
                <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="form1">
                  <table width="150" border="0" cellspacing="0" cellpadding="0">
              		  
                      <tr>
                        <td><input name="username_login" width="100" id="username_login" size="10" placeholder="Корисничко име (e-mail)" />
                        <input name="password_login" type="password" id="password_login" size="10" placeholder="Лозинка" /></td>
                      </tr>
                      
                      <tr>
                        <td><div align="right" style="padding-top:0px;">
                          <input type="submit" name="button" id="button" value="Логирај ме!" style="background-color:#993300; color:#FFFFFF" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><?php if(isset($loginFoundUser) && !$loginFoundUser && isset($loginUserNotActivated) && !$loginUserNotActivated) {?>
                        <div style="color:#F00;">Корисничкото име и лозинката не се совпаѓаат.</div>
                        <?php } elseif(isset($loginUserNotActivated) && $loginUserNotActivated) {?>
                        <div style="color:#F00;">Вашата корисничка сметка не е активирана!<br />Проверете го вашиот e-mail за активациската порака.</div>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td><div align="center" class="down"><a href="resetPassword.php">Заборави лозинка?</a> | <a href="register.php?new">Регистрирај се!</a></div></td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table>
                    </form>
<?php }elseif(isset( $_SESSION['MM_Username'] ) &&  isset($_SESSION['MM_UserGroup'])){ ?>
	<div class="login" style="border-bottom:1px solid #f5e6a2; width:150px; height:87px;">
              <div class="title" style="text-align:left; padding-left:10px;">Добредојде</div>
                <div class="forms" >
                
                  <table width="98%" border="0" cellspacing="0">
              		<tr>
                        <td align="left" style=" padding-left:5px;"><a href="profile.php" title="Промени ги твоите лични податоци" alt="Промени ги твоите лични податоци"><strong><?php if(isset($_SESSION['MM_Name'])) echo $_SESSION['MM_Name']; ?></strong></a>&nbsp;<span style="color:#FFF">[</span><a href="logout.php?doLogout=true">Одјави се</a><span style="color:#FFF">]</span></td>
                    </tr>
                      <tr>
                        <td><?php if(isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup']=="admin"){ ?>
                        	&nbsp;<span style="color:#FFF;">&raquo;</span>&nbsp;<a href="admin/">Администраторски панел</a>
                            <?php } ?>
                        </td>
                      </tr>
                    </table>
                    <br />
	</div>
</div>

<?php } ?>

