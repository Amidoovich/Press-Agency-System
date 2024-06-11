<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional styles for spacing and alignment */
        .post-container {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Pending Posts</h1>

        <?php
        include_once '../controller/include/DatabaseClass.php';
        $db = new Database ();

        $pendingPostsQuery = "SELECT * FROM pendingposts";
        $pendingPostsResult = $db->conn->query($pendingPostsQuery);

        if ($pendingPostsResult && $pendingPostsResult->num_rows > 0) {
            while ($row = $pendingPostsResult->fetch_assoc()) {
        ?>

            <div class="post-container">
                <h3><?= $row['atitle'] ?></h3>
                <p><?= $row['atype'] ?></p>
                <p><?= $row['abody'] ?></p>
                <img src="<?= $row['aimage'] ?>" alt="Post Image" class="img-fluid">
                <p>Editor: <?= $row['username'] ?></p>
                <form method="POST" action="../controller/adminController.php">
                    <input type="hidden" name="pid" value="<?= $row['pid'] ?>">
                    <button type="submit" name="acceptPost" class="btn btn-success mr-2">Accept</button>
                    <button type="submit" name="refusePost" class="btn btn-danger">Refuse</button>
                </form>
            </div>

        <?php
            }
        } else {
            echo "<p>No pending posts.</p>";
        }
        ?>
    </div>

    <!-- Bootstrap JS and jQuery (optional but required for Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
