<?php
session_start();
//echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

include_once("scripts/conecta.inc.php");
include_once("scripts/classLogin.php");
	
	$User 	= $_POST["usuario"];
	$Passwd = $_POST["passwd"];
	
	$Login = new Login();
		$Login -> Logon($User,$Passwd);
		
?>