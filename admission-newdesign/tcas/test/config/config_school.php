<?php

$host_school = "10.5.1.5";
$user_school = "kito";
$passwd_school = "vtwidHd^";
$dbname_school = "school";



/*$host = "10.4.3.214";
$user = "root";
$passwd = "1234";
$dbname = "school";*/

mysql_connect($host_school,$user_school,$passwd_school) or die ("ติดต่อฐานข้อมูลไม่ได้");
mysql_select_db($dbname_school) or die ("เลือกฐานข้อมูลไม่ได้");

mysql_query("set names utf8");

?>