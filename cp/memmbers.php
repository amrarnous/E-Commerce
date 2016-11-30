<?php
session_start();
$page_name = "Memmbers";
if (isset($_SESSION["Username"])){
		include "init.php";

		$action = isset($_GET["action"]) ? $_GET["action"] : "manage";

		if ($action == "manage") {

			echo "Hello World";
			echo "<a href='?action=Add'>Add</a>";

		} elseif ($action == 'Add') { // Add New Memmbers ?>
			<h1 class="text-center">Add Memmbers</h1>
			<div class="container">
			<form class="form-horizontal profile-edit" method="POST" action="?action=Insert">
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10 col-md-4">
						<input type="text" id='form-try' name="username" class="form-control" placeholder="Username To login" autocomplete="off" required='required'>
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10 col-md-4">
						<input type="password" name="password" class="form-control" placeholder="Password Should Be Hard" required="required">
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10 col-md-4">
						<input type="email" name="email" class="form-control" placeholder="Email Must Be Valid" autocomplete="off" required='required'>
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">FullName</label>
					<div class="col-sm-10 col-md-4">
						<input type="text" name="fullName" class="form-control" placeholder="Full Name Showing in Your Profile" autocomplete="off" required='required'>
					</div>
				</div>

				<div class="form-group form-group-lg">
					<div class="col-md-offset-2 col-sm-10 col-md-4">
						<input type="submit" value="Add!" class="btn btn-danger btn-lg btn-block">
					</div>
				</div>

			</form>
			</div>
		<?php
	} elseif ($action == "Insert") {
		echo $_POST['username'] . $_POST['password'] . $_POST['fullName'] . $_POST['email'];
	}

		 elseif ($action == "Edit") { # Edit Page

			// SHOW IF THE ID IS NUMERIC TO SHOW PAGE

		$userID = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : 0;



			$stmt = $con -> prepare('SELECT * FROM shop.users WHERE userID = ? LIMIT 1');
		$stmt->execute(array($userID));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		if ($stmt->rowCount() > 0) {

		 ?>
			<h1 class="text-center">Edit Profile</h1>
			<div class="container">
			<form class="form-horizontal profile-edit" method="POST" action="?action=update">
				<input type="hidden" name="userID" value="<?php echo $userID; ?>">
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10 col-md-4">
						<input type="text" id='form-try' name="username" value="<?php echo $row["username"]; ?>" class="form-control" placeholder="new username" autocomplete="off" required='required'>
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10 col-md-4">
						<input type="password" name="new_password" class="form-control" placeholder="Type New Password" autocomplete="new-password">
						<input type="hidden" name="old_password" value="<?php echo $row["password"]; ?>">
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10 col-md-4">
						<input type="email" name="email" value="<?php echo $row["email"]; ?>" class="form-control" placeholder="new email" autocomplete="off" required='required'>
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">FullName</label>
					<div class="col-sm-10 col-md-4">
						<input type="text" name="fullName" value="<?php echo $row["fullName"]; ?>" class="form-control" placeholder="new Full Name" autocomplete="off" required='required'>
					</div>
				</div>

				<div class="form-group form-group-lg">
					<div class="col-md-offset-2 col-sm-10 col-md-4">
						<input type="submit" value="save" class="btn btn-danger btn-lg btn-block">
					</div>
				</div>

			</form>
			</div>
			<?php

		} else {
			echo "Sorry There's No Such id !";
	}
} elseif ($action == "update") {

		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			echo "<h1 class='text-center'>Data Updated</h1>";
			echo "<div class='container'>";
			// POST the Variables
			$userid = $_POST["userID"];
			$user = $_POST["username"];
			$email = $_POST["email"];
			$full_name = $_POST["fullName"];

			## Password Trick
			$pass = '';

			if (empty($_POST["new_password"])) {
				$pass = $_POST["old_password"];
			} else {
				$pass = sha1($_POST["new_password"]);
			}

			## Validate The Form

			$form_errors = array();

			if (empty($user)) {
				$form_errors[] = "Username Can't Be Empty";
			}
			if(empty($email)) {
				$form_errors[] = "Email Can't Be Empty";
			}
			if(empty($full_name)) {
				$form_errors[] = "Full Name Can't Be Empty";
			}

			foreach ($form_errors as $error) {
				echo "<h5 class='alert alert-danger'>" . $error . "</h5>" . "<br>";
			}

			if($form_errors == FALSE) {

			$stmt = $con->prepare('UPDATE shop.users SET username = ?, email = ?, fullName = ?, password = ? WHERE userID = ?');
			$stmt->execute(array($user,$email,$full_name,$pass,$userid));

			echo "<h3 class='alert alert-success'>" . "<span style='color:red;'>" . $stmt->rowCount() . "</span>" . " Record Updated :D </h3>";
		}
}

	} else {
		echo "You Can't Use This Page Directly";
	}
		echo "</div>";
		include $templates . "footer.php";

} else {

	header("Locaion: index.php");

	exit();

}
?>