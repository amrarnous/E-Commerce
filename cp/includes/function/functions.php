<?php
	
	function get_title() {
			global $page_title;
		if (isset( $page_title )) {
			echo $page_title;
		} else {
			echo "Control Panel";
		}
	}
/*
	### Redirect To Home Page Function V2.0 ###
	** $theMsg = The Message You Want To Show Up
	** $sec = seconds to redirect
	** $place = Redirecting Page Name
	** $url = the url you want to redirect
*/
	function redirect_page($theMsg, $sec = 3, $place, $url) {
		echo 
		"<div class='container'>
			$theMsg
			<div class='alert alert-info'>
			You Will Be Redirect To $place After $sec Seconds
			</div>
		</div>";
		header("refresh:$sec;url=$url");
	}

/*
	## Check Items in database
*/
	function check_Items($select, $from, $value) {
		global $con;

		$statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

		$statment->execute(array($value));

		$count = $statment->rowCount();

		return $count;
	}
?>