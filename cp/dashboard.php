<?php
session_start();
$page_title = "CP Dashboard";
if (isset($_SESSION["Username"])){
		include "init.php";
		?>

		<!-- Start Dashborad Page -->

			<div class="container stats text-center">
				<h1>Dashboard</h1>
				<div class="row">
					<div class="col-md-3">
						<div class="stat">
							<h4>Total Memmbers</h4>
							<span>1500</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stat">
							<h4>Peding Memmbers</h4>
							<span>10</span>
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
								Latest Users
							</div>
							<div class="panel-body">
								Test
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
								Test
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