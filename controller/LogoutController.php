<?php
if (isset($_POST['logout'])){
		 include '../model/UsersClass.php';
		 $user = new users();
		 $user->logout();
		 header("Location: ../viewer/index.php");
	 }
     ?>