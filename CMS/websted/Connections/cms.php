<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
# http://www.php.net/manual/en/function.mysql-pconnect.php 
$hostname_cms = "localhost";
$database_cms = "cms";
$username_cms = "root";
$password_cms = "";
$cms = new mysqli($hostname_cms, $database_cms, $username_cms, $password_cms) or (mysqli_connect_error()); 

?>
