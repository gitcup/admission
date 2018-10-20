<?php

$host = "10.5.1.15";
$user = "online";
$passwd = "OnLine!@#$%";
$dbname = "radius";
/*
$host = "10.4.3.253";
$user = "assess2";
$passwd = "AssEss#";
$dbname = "polymath";
*/
/*$host = "localhost";
$user = "root";
$passwd = "123456";
$dbname = "polymath";*/

mysql_connect($host,$user,$passwd) or die ("ติดต่อฐานข้อมูลไม่ได้11111");
mysql_select_db($dbname) or die ("เลือกฐานข้อมูลไม่ได้");

mysql_query("set names utf8");

?>