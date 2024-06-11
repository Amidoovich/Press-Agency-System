<?php
	session_start();
	if ($_SESSION['username'] && $_SESSION['role'] == "editor") {
?>
<html>
	<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  			<div class="container-fluid">
			  <p class="navbar-text text-white">Welcome, <?php echo $_SESSION['username'];?></p>
    			<ul class="navbar-nav">
      		<li class="nav-item">
        		<a class="nav-link active" href="passwordChange.php">change password</a>
      		</li>
      		<li class="nav-item">
        		<a class="nav-link active" href="createPosts.php">create post</a>
      		</li>
      		<li class="nav-item">
        		<a class="nav-link active" href="editorPosts.php">manage posts</a>
      		</li>
			  <li class="nav-item">
        		<a class="nav-link active" href="displayposts.php">wall page</a>
      		</li>
			  <li class="nav-item">
        		<a class="nav-link active" href="contact.php">contact us</a>
      		</li>
			  <li class="nav-item">
        		<a class="nav-link active" href="profile_info.php">profile info</a>
      		</li>
			<form action="../controller/LogoutController.php" method="post" class="form-inline" style="margin:0;">
				<button class="btn btn-danger" type="submit" name="logout">Logout</button>
			</form>
    		</ul>
  		</div>
		</nav>

		
	</body>
</html>

<?php
} else {
	header("location: ../login_form.php");
}
?>