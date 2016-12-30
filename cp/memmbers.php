<?php
session_start();
$page_title = "Memmbers";
if (isset($_SESSION["Username"])){
		include "init.php";
		$action = isset($_GET["action"]) ? $_GET["action"] : "manage";

		if ($action == "manage") { // Manage Memmbers Page 
				$query = "";
				if (isset($_GET["page"]) && $_GET["page"] == "pending"){

					$query = "AND regStatus = 0";

				}
				$stmt = $con->prepare("SELECT * FROM shop.users WHERE groupID != 1 $query");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				?>
			<h1 class="text-center heading">Manage Memmbers</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>ID</td>
							<td>Username</td>
							<td>Email</td>
							<td>Fullname</td>
							<td>Registerd Status</td>
							<td>Control</td>
						</tr>
						<?php
						foreach ($rows as $row) {
							echo "<tr>"; 
								echo "<td>" . $row["userID"] . "</td>";
								echo "<td>" . $row["username"] . "</td>";
								echo "<td>" . $row["email"] . "</td>";
								echo "<td>" . $row["fullName"] . "</td>";
								echo "<td>" . $row["Date"] . "</td>";
								echo "<td>
								<a class='btn btn-success' href='?action=Edit&id=" . $row["userID"] . "'>Edit</a>
								<a class='btn btn-danger confirm' href='?action=Delete&id=" . $row["userID"] . "'>Delete</a>";
								if ($row["regStatus"] == 0){
									echo "<a class='btn btn-info active' href='?action=active&id=" . $row["userID"] . "'>Activate</a>";
								}
								echo "</td>";
							echo "</tr>"; 
						}
						?>
					</table>
				</div>
			<a href='?action=Add' class="btn btn-info btn-block"><i class="fa fa-plus"></i>Add</a>
			</div>
		<?php } elseif ($action == 'Add') { // Add New Memmbers ?>
			<h1 class="text-center heading">Add Memmbers</h1>
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

		if ($_SERVER["REQUEST_METHOD"] == "POST"){

			echo "<h1 class='text-center'>Data Inserted</h1>";
			echo "<div class='container'>";
			// POST the Variables
			$user = $_POST["username"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			$full_name = $_POST["fullName"];

			## Password Trick
			$hpass = sha1($password);

			## Validate The Form

			$form_errors = array();

			if (empty($user)) {
				$form_errors[] = "Username Can't Be Empty";
			}
			if (empty($password)) {
				$form_errors[] = "Password Can't Be Empty";
			}
			if(empty($email)) {
				$form_errors[] = "Email Can't Be Empty";
			}
			if(empty($full_name)) {
				$form_errors[] = "Full Name Can't Be Empty";
			}

			foreach ($form_errors as $error) {
				echo "<h5 class='alert alert-danger'>" . $error . "</h5>" . "<br>";
			} if ($form_errors == FALSE) {

				$check = check_Items("username", "shop.users", $user);

				if ($check == 1){
					$errorMsg = "<h4>Sorry, This Username is Exist</h4>";

					redirect_page($errorMsg, 3, "Add Page", "memmbers.php?action=Add");
				} else {

				$stmt = $con->prepare("INSERT INTO 
						shop.users(username,password, email, fullName, regStatus, Date) 
						VALUES(:auser,:apass,:amail,:aname, 1 ,now())
					");
				$stmt->execute(array(
					"auser" => $user,
					"apass" => $hpass,
					"amail" => $email,
					"aname" => $full_name
				));
				$theMsg = "<h3 class='alert alert-success'>" . "<span style='color:red;'>" . $stmt->rowCount() . "</span>" . " Record Updated </h3>";
				redirect_page($theMsg, 3, "Add Memmbers", "memmbers.php?action=Add");

					}
			}
		} else {
			$theMsg = "<div class='alert alert-danger'>You Can't Use This Page Directly</div>";
				redirect_page($theMsg, 3, "Home Page", "index.php");
	}
}
		 elseif ($action == "Edit") { # Edit Page

			// SHOW IF THE ID IS NUMERIC TO SHOW PAGE

				$userID = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : 0;
					$stmt = $con -> prepare('SELECT * FROM shop.users WHERE userID = ? LIMIT 1');
				$stmt->execute(array($userID));
				$row = $stmt->fetch();
				$count = $stmt->rowCount();

				if ($count > 0) {

				 ?>
			<h1 class="text-center heading">Edit Profile</h1>
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
			$theMsg = "<div class='alert alert-danger'>Sorry There's No Such id !</div>";
			redirect_page($theMsg, 3, "To Manage Page", "memmbers.php");
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

			$theMsg = "<h3 class='alert alert-success'>" . "<span style='color:red;'>" . $stmt->rowCount() . "</span>" . " Record Updated :D </h3>";
			redirect_page($theMsg, 3, "Memmbers Page", "memmbers.php");
		}
}

	} elseif ($action == "Delete"){
		$userID = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : 0;

			$check = check_Items("userID", "shop.users", $userID);

		if ($check > 0) {
			$stmt = $con->prepare("DELETE FROM shop.users WHERE userID = :xuserid");
			$stmt->bindParam(":xuserid", $userID);
			$stmt->execute();
			echo "<h1 class='text-center'>Data Updated</h1>";
			echo "<div class='container'>";
			echo "<h3 class='alert alert-success'>" . "<span style='color:red;'>" . $stmt->rowCount() . "</span>" . " Record Deleted :D </h3>";
			echo "</div>";
				header("refresh:1;url=memmbers.php");
		} else {
			$theMsg = "<div class='alert alert-danger'>Sorry There Is No Such ID !</div>";
			redirect_page($theMsg, 3, "Memmbers", "memmbers.php");
		}
	} elseif ($action == "active"){
		$userID = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : 0;

			$check = check_Items("userID", "shop.users", $userID);

		if ($check > 0) {
			$stmt = $con->prepare("UPDATE shop.users SET regStatus = 1 WHERE userID = ?");
			$stmt->execute(array($userID));
			echo "<h1 class='text-center'>Data Updated</h1>";
			echo "<div class='container'>";
			echo "<h3 class='alert alert-success'>" . "<span style='color:red;'>" . $stmt->rowCount() . "</span>" . " User Activated</h3>";
			echo "</div>";
				header("refresh:1;url=memmbers.php");
		} else {
			$theMsg = "<div class='alert alert-danger'>Sorry There Is No Such ID !</div>";
			redirect_page($theMsg, 3, "Memmbers", "memmbers.php");
		}
	}
	 else {
		$theMsg = "You Can't Use This Page Directly";
		redirect_page($theMsg, 6, "Home", "index.php");
	}
		echo "</div>";
		include $templates . "footer.php";

} else {

	header("Locaion: index.php");

	exit();

}
?>