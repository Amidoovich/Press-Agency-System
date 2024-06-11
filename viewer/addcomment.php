<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Comment</title>
    <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Add Comment</h2>

        <?php
        // Include your database connection file
        include_once '../controller/include/DatabaseClass.php';

        // Function to add a new comment to the database
        function addComment($post_id, $username, $comment_text, $db)
        {
            $sql = "INSERT INTO comments (post_id, username, comment_text) VALUES (?, ?, ?)";
            $params = [$post_id, $username, $comment_text];
            $db->insert($sql, $params);
            echo "Comment added successfully!";
        }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id = $_POST['post_id'] ?? '';
            $username = $_POST['username'] ?? '';
            $comment_text = $_POST['comment_text'] ?? '';

            // Validate and sanitize inputs as needed

            // Create a new instance of the Database class
            $db = new Database();

            // Add the comment to the database
            addComment($post_id, $username, $comment_text, $db);
        }
        ?>

        <form action="" method="POST">
            <input type="hidden" name="post_id" value="1"> <!-- Replace with the actual post ID -->
            
            <label for="username">Your Name:</label>
            <input type="text" name="username" required>

            <label for="comment_text">Comment:</label>
            <textarea name="comment_text" rows="4" required></textarea>

            <br>
            <br>
            <button class="btn btn-outline-info" type="submit">Submit Comment</button>
        </form>
    </div>
</body>

</html>
