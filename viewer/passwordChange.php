<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    /* Custom styles for centering the card */
    .card-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .eye-icon {
      cursor: pointer;
    }
  </style>
</head>

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="admin_view.php">Home</a>
      </li>
    </ul>
    <form action="../controller/LogoutController.php" method="post" class="form-inline" style="margin:0;">
      <button class="btn btn-danger" type="submit" name="logout">Logout</button>
    </form>
  </div>
</nav>


  <?php
  $flag = isset($_GET['id']) ? $_GET['id'] : '';
  if ($flag == 1) {
    echo '<div class="alert alert-success" role="alert">Password changed successfully.</div>';
  } elseif ($flag == 0) {
    echo '<div class="alert alert-danger" role="alert">New password and confirm password do not match.</div>';
  } elseif ($flag == -1) {
    echo '<div class="alert alert-danger" role="alert">Your current password is incorrect. Please try again.</div>';
  }
  ?>

  <div class="card-container">
    <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 20rem;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Change Password</h2>
        <form action="../controller/passwordChangeController.php" method="post">
          <div class="mb-3">
            <label for="current_password" class="form-label">Current Password:</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required placeholder="Enter your current password">
          </div>
          <div class="mb-3">
            <label for="new_password" class="form-label">New Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="new_password" name="new_password" required placeholder="Enter the new password">
              <span class="input-group-text eye-icon" onclick="togglePassword('new_password')">
                <i class="fas fa-eye"></i>
              </span>
            </div>
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Enter the Confirm password">
              <span class="input-group-text eye-icon" onclick="togglePassword('confirm_password')">
                <i class="fas fa-eye"></i>
              </span>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" name="submit">Change Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

  <script>
    function togglePassword(inputId) {
      const passwordInput = document.getElementById(inputId);
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }
  </script>
</body>

</html>

