<?php
	
	include "connect.php";

	
	$templates = "includes/templates/"; ## Template Directory
	$css	   = "layout/css/"; ## CSS FILES
	$js		   = "layout/js/"; ## Javascript Files
	$lang	   = "includes/lang/"; ## Languages File
	$function  = "includes/function/";

	include $lang . "en.php";
	include $function . "functions.php";
	include $templates . "header.php";
	if (!isset($no_Navbar)) {include $templates . "navbar.php"; }
?>