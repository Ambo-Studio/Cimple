<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
# http://www.php.net/manual/en/function.mysql-pconnect.php 
$hostname_cms = "localhost";
$database_cms = "cms";
$username_cms = "root";
$password_cms = "";
# https://stackoverflow.com/questions/13979210/mysqli-select-db-expects-parameter-1-to-be-mysqli-string-given
$cms = new mysqli($hostname_cms, $username_cms, $password_cms,$database_cms) or (mysqli_connect_error()); 

?>
