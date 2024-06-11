<?php
	if (isset($_POST["Login"])) {
		include '../model/UsersClass.php';
		
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$user = new users();
			$true = $user->login($username, $password);

			if ($true == true) {
				@$role =  $_SESSION['role'];
				if ($role == 'admin') {
					header("location: ../viewer/admin_view.php");
				} elseif ($role == 'viewer') {
					header("location: ../viewer/viewer_view.php");
				} elseif($role == 'editor'){
					header("location: ../viewer/editor_view.php");
				}
			} else {
				$param = "false";
				header("location: ../viewer/login_form.php?id=$param");
			}
		}
	}
?>
