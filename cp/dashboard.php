<?php
session_start();
$page_title = "CP Dashboard";
	if (isset($_SESSION["Username"])){
			include "init.php";
			$user_limit = 5;
			$latest_users = get_latest_items("*", "shop.users", "userID", $user_limit);
		?>

		<!-- Start Dashborad Page -->

			<div class="container stats text-center">
				<h1>Dashboard</h1>
				<div class="row">
					<div class="col-md-3">
						<div class="stat">
							<h4>Total Memmbers</h4>
							<span>
							<?php echo count_items("username", "shop.users"); ?>
							</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stat">
							<h4>Peding Memmbers</h4>
							<span>
							<a href="memmbers.php?page=pending">
							<?php echo count_items("username", "shop.users", "WHERE regStatus = 0 AND groupID != 1"); ?>
							</a>
							</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stat">
							<h4>Total Comments</h4>
							<span>4500</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stat">
							<h4>Total items</h4>
							<span>4500</span>
						</div>
					</div>
				</div>
			</div>
			<div class="container latest">
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-users"></i>
								Latest <?php echo $user_limit; ?> Users
							</div>
							<div class="panel-body">
							<ul class="list-unstyled lastMemmbers">
								<?php
									foreach ($latest_users as $user) {
										echo "<li>";
											echo $user["username"];
											echo "<a href='memmbers.php?action=edit&userID='" . $user["userID"] . "'>";
												echo "<span class='btn btn-success pull-right'>";
													echo "<i class='fa fa-edit'>";
													echo "Edit</i>";
												echo "</span>";
											echo "</a>";
										if ($user["regStatus"] == 0){
											echo "<a class='btn btn-info active pull-right' href='memmbers.php?action=active&id=" . $user["userID"] . "'>Activate</a>";
										}
										echo "</li>";
									}
								?>
							</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-tag"></i>
								Latest items
							</div>
							<div class="panel-body">
								TEST
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Dashboard Page -->

		<?php
		include $templates . "footer.php";
} else {
	header("Location:index.php");
	exit();
}
?>