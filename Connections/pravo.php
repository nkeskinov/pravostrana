<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_pravo = "pravodb.db.4351964.hostedresource.com"; //localhost
$database_pravo = "pravodb"; 
$username_pravo = "pravodb";
$password_pravo = "Pravoorgmk1";
$pravo = mysql_pconnect($hostname_pravo, $username_pravo, $password_pravo) or trigger_error(mysql_error(),E_USER_ERROR); 
# Enable UTF-8 transactions in MySQL < 5.0.7
mysql_query('set NAMES utf8'); 
# Enable UTF-8 transactions in MySQL >= 5.0.7
# mysql_set_charset('utf8');
?>