<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <?php
                    session_start();
                    ?>
                    <h5 class="card-title text-center">User Profile Information</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>First name:</strong> <?php echo isset($_SESSION['fname']) ? htmlspecialchars($_SESSION['fname']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong>Last name:</strong> <?php echo isset($_SESSION['lname']) ? htmlspecialchars($_SESSION['lname']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong>Username:</strong> <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong>Profile image:</strong> 
                            <?php 
                            $profileImg = isset($_SESSION['profileImg']) ? $_SESSION['profileImg'] : null;
                            if ($profileImg && file_exists( $profileImg)) {
                                echo '<img src="' . htmlspecialchars($profileImg) . '" alt="Profile Image" class="img-fluid">';
                            } else {
                                echo 'No image available';
                            }
                            ?>
                        </li>
                        <li class="list-group-item"><strong>User type:</strong> <?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong>Phone number:</strong> <?php echo isset($_SESSION['phoneNumber']) ? htmlspecialchars($_SESSION['phoneNumber']) : 'N/A'; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
