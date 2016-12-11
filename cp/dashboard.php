<?php
session_start();
$page_title = "CP Dashboard";
if (isset($_SESSION["Username"])){
		include "init.php";
		echo "Welcome";

		include $templates . "footer.php";
} else {
	header("Location:index.php");
	exit();
}
?>