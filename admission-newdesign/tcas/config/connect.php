<?php

$objConnect = odbc_connect("avsreg","webreg","reg@rbru2551") or die("Error Connect to Database");  
//$objConnect = odbc_connect("avsreg","avsreg","123456") or die("Error Connect to Database");
//$acadyear = 2552;
//$semester = 2;

$globals_test = @ini_get('register_globals');
if ( isset($globals_test) && empty($globals_test) ) {
   if ( !empty($_GET) ) { extract($_GET, EXTR_SKIP); }
   if ( !empty($_POST) ) { extract($_POST, EXTR_SKIP); }
   if ( !empty($_COOKIE) ) { extract($_COOKIE, EXTR_SKIP); }
   if ( !empty($_SESSION) ) { extract($_SESSION, EXTR_SKIP); }
   if ( !empty($_SERVER) ) { extract($_SERVER, EXTR_SKIP); }
}

$path_attachFile = "../attachFile/";
$path_attachFile2 = "attachFile/";
?>
