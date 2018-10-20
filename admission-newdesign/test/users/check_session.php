<?php
session_start();
if(!isset($_SESSION['username'])){
    //require("index.php");
	echo  "<meta http-equiv=\"refresh\" content=\"0;url=index.php?p=login\"> ";
    exit();
}
?>