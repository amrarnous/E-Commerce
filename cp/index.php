<?php
	session_start();
	$no_Navbar = "";
	$page_title = "CP Login";
	if (isset($_SESSION["Username"])) {
		header("Location:dashboard.php");
	}
	include "init.php";
	include $templates . "header.php";
	//include $lang . "en.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$hashedPass = sha1($password);

		// Check if the user exist in database

		$stmt = $con -> prepare('	SELECT
										 userID, username, password 
									FROM 
										shop.users 
									WHERE 
										username = ? 
									AND 
										password = ? 
									AND 
										groupID = 1
									LIMIT 1');
		$stmt->execute(array($username, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// check if him is admin say hello 		
	if ($count > 0) {
		
			$_SESSION["Username"] = $username;
			$_SESSION["ID"] 	  = $row["userID"];
			header("Location:dashboard.php");
			exit();
		
		}else {
			echo "<h5 class='error'>your password or username is wrong try again !</h5>";
		}

	}
?>
<form class="login" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
	<i class="fa fa-user-circle-o fa-4x text-center" aria-hidden="true"></i>
	<input class="form-control" type="text" name="username" placeholder="Username" >
	<input class="form-control" type="password" name="password" placeholder="Password">
	<input class="btn btn-primary btn-block" type="submit" value="SIGN IN">

</form>
<?php
	include $templates . "footer.php";
?>