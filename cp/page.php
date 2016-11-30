<?php
	
	$action = isset($_GET["action"]) ? $_GET["action"] : "manage";

	if ($action == "manage") {

		echo "Welcome in the manage page";
		
	} elseif ($action == "Add") {

		echo "Welcome in the Add page";

	} elseif ($action == "insert") {

		echo "Welcome in insert page";

	} else {

		echo "ERROR There\'s No page with this name";

	}

?>