<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_pravo_local = "localhost";
$database_pravo_local = "pravodb";
$username_pravo_local = "root";
$password_pravo_local = "milcevski";
$pravo_local = mysql_pconnect($hostname_pravo_local, $username_pravo_local, $password_pravo_local) or trigger_error(mysql_error(),E_USER_ERROR); 
?>