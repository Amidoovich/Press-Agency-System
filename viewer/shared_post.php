<?php
session_start();
include_once '../controller/include/DatabaseClass.php';
$db = new database();

if (isset($_GET['shared_post_id'])) {
    $postId = $_GET['shared_post_id'];

    // Fetch the details of the shared post based on its ID
    $sql = "SELECT * FROM shownposts WHERE pid = $postId";
    $sharedPost = $db->display($sql);

    if ($sharedPost) {
        $sharedPost = $sharedPost[0]; // Assuming it fetches only one post

        // Get the username from the form submission
        $username = $_GET['user_name']; // Assuming the username comes from the form input

        // Insert shared post data into shared_posts table
       $insertQuery = "INSERT INTO shared_posts (post_id, viewer, username, atitle, abody, pdate, atype, aimage) 
                    VALUES ('$postId', '$username', '{$sharedPost['username']}', '{$sharedPost['atitle']}', '{$sharedPost['abody']}', '{$sharedPost['pdate']}', '{$sharedPost['atype']}', '{$sharedPost['aimage']}')";
        $db->insert($insertQuery);

        // Print the shared post and the username
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Shared Post</title>
        </head>
        <body>
            <div style="border: 1px solid #ddd; margin: 10px; padding: 10px;">
                <p><strong>Editor Name:</strong> <?php echo $sharedPost['username']; ?></p>
                <p><strong>Title:</strong> <?php echo $sharedPost['atitle']; ?></p>
                <p><strong>Body:</strong> <?php echo $sharedPost['abody']; ?></p>
                <p><strong>Creation Date:</strong> <?php echo $sharedPost['pdate']; ?></p>
                <p><strong>Type:</strong> <?php echo $sharedPost['atype']; ?></p>
                <p><strong>IMG:</strong> <img src="assets/<?php echo $sharedPost['aimage']; ?>" width="90" height="90"></p>
                <!-- Additional details of the shared post can be displayed here -->
                <p><strong>Shared By:</strong> <?php echo $username; ?></p>

                <!-- Button to add to display page -->
                <form action="displayPosts.php" method="get">
                    <input type="hidden" name="add_to_display" value="<?php echo $postId; ?>">
                    <input type="submit" value="SHARE">
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        // Post not found, handle error or redirect to another page
        // Example: header("Location: error_page.php");
        exit(); // Stop further execution
    }
} else {
    // If post ID is not set, handle error or redirect to another page
    // Example: header("Location: error_page.php");
    exit(); // Stop further execution
}
?>