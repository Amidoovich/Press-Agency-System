<?php
	session_start();
	if ($_SESSION['username'] && $_SESSION['role'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel - Press Agency</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-color: #f0f2f5;
			padding-top: 60px; /* Adjusted padding for the fixed navbar */
		}
		.navbar {
			background-color: #3b5998; /* Facebook blue */
		}
		.navbar-text {
			font-weight: bold;
			color: #fff; /* White text color */
			margin-right: 20px;
		}
		.navbar-nav .nav-link {
			color: #fff; /* White text color */
		}
		.nav-link.active {
			font-weight: bold;
		}
		.navbar-toggler-icon {
			background-color: #fff; /* White color for the toggler icon */
		}
		.nav-link:hover {
			color: #e9ecef; /* Light grey on hover */
		}
		.btn-danger {
			background-color: #dc3545; /* Red for logout button */
			border-color: #dc3545;
		}
		.btn-danger:hover {
			background-color: #c82333; /* Darker red on hover */
			border-color: #bd2130;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-dark fixed-top">
		<div class="container">
			<p class="navbar-text">Welcome, <?php echo $_SESSION['username'];?></p>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" href="requestedposts.php">Requested Posts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="registeredUsers.php">Requested Users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="passwordChange.php">Change Password</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="delete_users.php">Delete Users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="adminposts.php">Manage Posts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="profile_info.php">Profile Info</a>
					</li>
				</ul>
				<form action="../controller/LogoutController.php" method="post" class="ms-auto">
					<button class="btn btn-danger" type="submit" name="logout">Logout</button>
				</form>
			</div>
		</div>
	</nav>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
	header("location: ../login_form.php");
}
?>
