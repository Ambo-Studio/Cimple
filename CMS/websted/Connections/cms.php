<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cms = "localhost";
$database_cms = "cms";
$username_cms = "root";
$password_cms = "";
$cms = mysql_pconnect($hostname_cms, $username_cms, $password_cms) or trigger_error(mysql_error(),E_USER_ERROR); 
?>