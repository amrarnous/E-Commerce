<?php
	function lang( $phrase ) {
		static $lang = array(
			// Dashboard Page
			"admin" 			=> "CPanel",
			"sections" 			=> "Categories",
			"items" 			=> "Items",
			"memmbers" 			=> "Memmbers",
			"statistic" 		=> "Statistic",
			"logs" 				=> "Logs",
			"edit_profile"		=> "Edit Profile",
			"sett"				=> "Settings",
			"sign_out"			=> "Logout"

		);
		return $lang[$phrase];
	}
	
?>