<?php
include_once '../controller/include/DatabaseClass.php';
$db = new database();

// Check if the form is submitted and the update button is clicked

$pid = $_POST['pid'];
//var_dump($pid);
// Fetch existing data from the database
$sql = "SELECT * FROM shownposts WHERE pid= $pid";
$result = $db->display($sql);

if (count($result) > 0) {
    $row = $result[0];

    // Assign fetched data to variables
    $id = $row['pid'];  // Fetch the ID from the database
    $articleTitle = $row['atitle'];
    $articleBody = $row['abody'];
    $articleType = $row['atype'];
    $aimage = $row['aimage'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <h2 class="text-center mt-3 mb-4">Edit Post</h2>

    <div class="container">
        <form action="../controller/adminController.php" method="POST" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="article_title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="article_title" value="<?php echo $articleTitle; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="article_body" class="form-label">Body:</label>
                        <textarea class="form-control" id="body" name="article_body" rows="4" required><?php echo $articleBody; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="article_type" class="form-label">Type:</label>
                        <input type="text" class="form-control" id="type" name="article_type" value="<?php echo $articleType; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="article_image" class="form-label">Upload Image:</label>
                        <input class="form-control" type="file" name="article_image">
                        <img src="<?php echo $aimage; ?>" alt="Current Image" class="mt-2" style="max-width: 200px;">
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-outline-dark" name="editPosts">Update</button>
        </form>
    </div>

</body>

</html>
