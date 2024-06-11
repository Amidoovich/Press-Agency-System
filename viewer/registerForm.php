<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Press Agency Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .center-text {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="center-text">
                    <h2>Press Agency Registration</h2>
                </div>
                <form method="post" action="accept.php" enctype="multipart/form-data">
                    <!-- Include the user ID -->
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" name="fname">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="lname">
                    </div>
                    <div class="form-group">
                        <label for="profileImg">Profile Image:</label>
                        <input type="file" class="form-control-file" id="profileImg" name="profileImg">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                    </div>
                    <div class="form-group">
                        <label for="userRole">User Role:</label>
                        <select class="form-control" id="userRole" name="userRole">
                            <option value="viewer">Viewer</option>
                            <option value="editor">Editor</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Register">
                    <?php $flag = isset($_GET['id']) ? $_GET['id'] : ''; 
                    if ($flag) {
                        echo '<p class="text-success text-center mt-3">Registered Successfully</p>';
                    }
                    else {
                        echo '<p class="text-danger text-center mt-3">Registration Failed</p>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional, for some functionalities) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
