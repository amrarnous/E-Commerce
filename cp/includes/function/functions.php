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
/*
***	Count items in DataBase function v1.0						***
***	function to check how many there's of type of this item 	***
***	$item = the item you want to count 							***
***	$table = the table you choose from 							***
*/
/*
	function count_items($item, $table, $where = "") {

		global $con;

		$stmt = $con->prepare("SELECT COUNT($item) FROM $table $where");

		$stmt->execute();

		return $stmt->fetchColumn();
	} 
*/
	/*
***	Count items in DataBase function v2.0						***
***	function to check how many there's of type of this item 	***
***	$item = the item you want to count 							***
***	$table = the table you choose from 							***
***	$where = if U need to excpect something 					***
	*/
		function count_items($item, $table, $where = "") {

		global $con;

		$stmt = $con->prepare("SELECT COUNT($item) FROM $table $where");

		$stmt->execute();

		return $stmt->fetchColumn();
	} 
/*
	*** Get Latest Items Function v1.0 
	*** $select = the field to select
	***	$table = the table you select from
	*** $order = the DECS ordering
	***	$limit = the limit items you want to get
*/
		function get_latest_items($select, $table, $order, $limit = 5) {
			global $con;

			$getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

			$getStmt->execute();

			$rows = $getStmt->fetchAll();

			return $rows;
		}
?>