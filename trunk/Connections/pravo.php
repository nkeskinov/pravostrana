<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_pravo = "localhost";
$database_pravo = "pravodb";
$username_pravo = "root";
$password_pravo = "milcevski";
$pravo = mysql_pconnect($hostname_pravo, $username_pravo, $password_pravo) or trigger_error(mysql_error(),E_USER_ERROR); 
?>