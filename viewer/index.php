<?php
$file_path = realpath('../controller/include/DatabaseClass.php');
if ($file_path) {
    include_once $file_path;
    $db = new database();
    $sql = "SELECT * FROM shownposts";
    $result = $db->display($sql);
} else {
    echo "DatabaseClass.php not found at the specified path.";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Press Agency System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    <meta name="theme-color" content="#712cf9">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .posts-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px; /* Space between navigation and posts */
        }
        .post {
            margin: 10px;
            width: 100%; /* Full width of the container */
            max-width: 600px; /* Maximum width for readability */
        }
    </style>
</head>
<body>
    <ul class="nav nav-pills justify-content-center mb-4">
        <li class="nav-item"><a id="home" class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="login_form.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="registerForm.php">Register</a></li>
    </ul>

    <div class="container-fluid mt-4">
        <div class="posts-wrapper">
            <?php if (!empty($result)) { ?>
                <?php foreach ($result as $res) { 
                    $username = $res['username'];
                    $sql2 = "SELECT profileImg FROM users WHERE username = '" . $username . "'";
                    $result2 = $db->display($sql2);
                    $profileImg = !empty($result2) ? $result2[0]['profileImg'] : 'default.png';
                ?>
                    <div class="card post" style="display: none;">
                        <div class="card-header d-flex align-items-center">
                            <img src="<?php echo htmlspecialchars($profileImg); ?>" class="rounded-circle me-2" width="50" height="50" alt="Editor Image">
                            <div>
                                <h5 class="card-title mb-0">Editor Name: <?php echo htmlspecialchars($username); ?></h5>
                                <small class="text-muted">Creation Date: <?php echo htmlspecialchars($res['pdate']); ?></small>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Title: <?php echo htmlspecialchars($res['atitle']); ?></h6>
                            <p class="card-text"><?php echo htmlspecialchars($res['abody']); ?></p>
                            <p><strong>Type:</strong> <?php echo htmlspecialchars($res['atype']); ?></p>
                            <img src="assets/<?php echo htmlspecialchars($res['aimage']); ?>" class="img-fluid mt-2" alt="Post Image">
                            <a href="login_form.php" class="btn btn-primary mt-3">More</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>No posts found.</p>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".post").each(function(index) {
                $(this).delay(200 * index).slideDown(500);
            });
        });
    </script>
</body>
</html>
