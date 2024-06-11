<?php
    session_start();
    if ($_SESSION['username'] && $_SESSION['role'] == "editor") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Create Post</h2>
        <form action="../controller/editorController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
            
            <div class="mb-3">
                <label for="article_title" class="form-label">Article Title:</label>
                <input type="text" class="form-control" name="article_title" required>
            </div>
            
            <div class="mb-3">
                <label for="article_body" class="form-label">Article Body:</label>
                <textarea class="form-control" name="article_body" rows="5" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="article_type" class="form-label">Article Type:</label>
                <input type="text" class="form-control" name="article_type" required>
            </div>
            
            <div class="mb-3">
                <label for="article_image" class="form-label">Article Image:</label>
                <input type="file" class="form-control" name="article_image" required>
            </div>
            
            <!-- Display Article Image -->
            <div class="mb-3">
                <?php
                    // Assuming $res['aimage'] contains the filename of the image
                    // Display the image if available
                    if (isset($res['aimage']) && !empty($res['aimage'])) {
                ?>
                        <img src="assets/<?php echo $res['aimage']; ?>" alt="Article Image" class="img-fluid">
                <?php
                    }
                ?>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submitPost">Submit</button>
            
            <?php
                $flag = isset($_GET['id']) ? $_GET['id'] : ''; 
                if ($flag) {
                    echo "Created successfully"; 
                }
            ?>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        header("location: login_form.php");
    }
?>

