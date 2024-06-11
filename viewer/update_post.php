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

    <h2>Edit Post</h2>

    <div class="container mt-5">
        <form action="../controller/editorController.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">

                <label for="article_title">Title:</label>
                <input type="text" id="title" name="article_title" value="<?php echo $articleTitle; ?>" required><br>
                <br> <label for="article_body">Body:</label>
                <textarea id="body" name="article_body" rows="4" required><?php echo $articleBody; ?></textarea><br>
                <br>
                <label for="article_type">Type:</label>
                <input type="text" id="type" name="article_type" value="<?php echo $articleType; ?>" required><br>
                <br>
                <input class="btn btn-outline-dark" type="file" name="article_image"><br>
                <img src="<?php echo $aimage; ?>" alt="Current Image"><br>
                <br>
                <br>
                

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="editPosts">Update</button>


            </div>
        </form>
    </div>
    <style>
        input {
            border: 1px solid black;
            border-radius: 10px;
        }
    </style>

</body>

</html>