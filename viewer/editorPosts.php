<?php
include_once "../controller/header.php";
session_start();

if ($_SESSION['username'] && ($_SESSION['role'] == "editor") ) {
    // Include necessary classes and configurations
    include_once '../model/UsersClass.php'; // Include User class
    include_once '../controller/include/DatabaseClass.php'; // Include DB connection class or logic

    // Assuming you have a method in your DB class to fetch posts by username
    $username = $_SESSION['username'];
    $db = new Database(); // Initialize your database connection
    $postsQuery = "SELECT * FROM shownposts WHERE username = '$username'"; // Adjust SQL query according to your table structure
    $postsResult = $db->conn->query($postsQuery);

    // Display fetched posts
    if ($postsResult && $postsResult->num_rows > 0) {
        echo '<div class="container mt-5">';
        while ($row = $postsResult->fetch_assoc()) {
            // Display post details (customize this based on your database schema)
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo "<p class='card-text'><strong>Published on:</strong> " . date_format(date_create($row['pdate']), 'F j, Y \a\t H:i:s') . "</p>";
            echo "<h3 class='card-title'><strong>Title:</strong> {$row['atitle']}</h3>";
            echo "<hr>";
            echo "<p class='card-text'><strong>Body:</strong> {$row['abody']}</p>";
            echo "<hr>";
            echo "<p class='card-text'><strong>Type:</strong> {$row['atype']}</p>";
            echo "<p class='card-text'><strong>Username:</strong> {$row['username']}</p>";
            echo "<img class='card-img-top' src='{$row['aimage']}' alt='Post Image'>";
            echo "<form action='../controller/editorController.php' method='POST'>";
            echo "<input type='hidden' name='pid' value='{$row['pid']}'>";
            echo "<input type='submit' class='btn btn-danger' name='deletePost' value='Delete'>";
            echo "</form>";
            echo "<form action='update_post.php' method='POST'>";
            echo "<input type='hidden' name='pid' value='{$row['pid']}'>";
            echo "<input type='submit' class='btn btn-primary' name='editPost' value='Edit'>";
            echo "</form>";
            echo "</div></div>";
        }
        echo '</div>';
    } else {
        echo "No posts found."; // Display if no posts are found for this editor
    }
} else {
    header("location: ../login_form.php");
}
include_once "../controller/footer.php";
?>

