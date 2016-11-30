<?php
	session_start(); // START THE SESSION

	session_unset();

	session_destroy();

	header("Location: index.php");

	exit();
