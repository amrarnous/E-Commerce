<!DOCTYPE html>
<html>
<head>
	<title><?php get_title(); ?></title>

<?php

	$css_files = array("bootstrap.min.css", "font-awesome.min.css","style.css");

	for($i=0; $i < count($css_files); $i++) {
		echo
		 "<link rel='stylesheet' type='text/css' href='"
		  . $css . $css_files[$i] . "'></link>\n";
	}

?>
</head>
<body>