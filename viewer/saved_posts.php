<?php
 session_start();
include_once '../controller/include/DatabaseClass.php';
$db = new database();

$searchPageUrl = 'search.php';
$sql = "SELECT * FROM savedposts";
$result = $db->display($sql);
$numrows = $db->check($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Post Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional styling can be added here */
        .post-container {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php foreach ($result as $res) { ?>
            <div class="post-container">
                <p class="fw-bold">Editor Name: <?php echo $res['username']; ?></p>
                <p class="fw-bold">Title: <?php echo $res['atitle']; ?></p>
                <p><strong>Body:</strong> <?php echo $res['abody']; ?></p>
                <p><strong>Creation Date:</strong> <?php echo $res['pdate']; ?></p>
                <p><strong>Type:</strong> <?php echo $res['atype']; ?></p>
                <p><strong>No. Viewers:</strong> <?php echo $res['viewno']; ?></p>
                <p><strong>IMG:</strong> <img src="assets/<?php echo $res['aimage']; ?>" width="90" height="90" alt="Post Image"></p>
            </div>
        <?php } ?>
    </div>
</body>

</html>
