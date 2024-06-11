<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Press Agency</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom styles for centering the card */
    .card-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(to top, rgba(253, 253, 253, 0.8), rgba(255, 255, 255, 0.8) 100%);
    }

    .login-card {
      max-width: 400px;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-header h1 {
      font-size: 2rem;
      font-weight: bold;
    }

    .form-label {
      font-weight: bold;
    }

    .btn-primary {
      background-color: #4267B2;
      border-color: #4267B2;
    }

    .btn-primary:hover {
      background-color: #365899;
      border-color: #365899;
    }

    .login-failed {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="card-container">
    <div class="card login-card">
      <div class="card-body">
        <div class="login-header">
          <h1>Press Agency</h1>
          <h5 class="card-title">Login Page</h5>
        </div>
        <form action="../controller/LoginController.php" method="post">
          <div class="mb-3">
            <label for="user" class="form-label">Username</label>
            <input id="user" class="form-control" type="text" name="username" required placeholder="Username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required placeholder="Password">
          </div>
          <div class="d-grid gap-2">
            <input class="btn btn-primary" type="submit" value="Login" name="Login">
          </div>
          <?php
          $param = isset($_GET['id']) ? $_GET['id'] : '';
          if ($param) {
            echo '<div class="login-failed">Login failed. Please try again.</div>';
          }
          ?>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
