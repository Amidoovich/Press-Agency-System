<?php
session_start();
include_once '../controller/include/DatabaseClass.php';
$db = new database();

$searchPageUrl = 'search.php';
$sql = "SELECT * FROM shownposts ORDER BY pid DESC"; // Fetch posts in descending order
$result = $db->display($sql);

// Initialize session variables for likes and dislikes
if (!isset($_SESSION['likes'])) {
    $_SESSION['likes'] = array();
}
if (!isset($_SESSION['dislikes'])) {
    $_SESSION['dislikes'] = array();
}

// Check if $result is not null and is an array
if (!is_null($result) && is_array($result)) {

    // Handle like and dislike actions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['like'])) {
            $username = $_SESSION['username'];
            $postId = $_POST['postId'];
            // Check if the user has already liked or disliked the post
            if (!hasUserAction($postId, 'like')) {
                handleAction($postId, 'like', $db);
            }
        }
        if (isset($_POST['dislike'])) {
            $username = $_SESSION['username'];
            $postId = $_POST['postId'];
            // Check if the user has already liked or disliked the post
            if (!hasUserAction($postId, 'dislike')) {
                handleAction($postId, 'dislike', $db);
            }
        }
    }

    // Loop through the posts
    foreach ($result as $res) {
        $postId = $res['pid'];

        $sqlUpdate = "UPDATE shownposts SET viewno = viewno + 1 WHERE pid = $postId";
        $db->update($sqlUpdate);

        if (!isset($_SESSION['post_views'][$postId])) {
            $_SESSION['post_views'][$postId] = 0;
        }

        // Update session data with the current view count
        $_SESSION['post_views'][$postId] = $res['viewno'];

        // Initialize likes and dislikes counts in session
        if (!isset($_SESSION['likes'][$postId])) {
            $_SESSION['likes'][$postId] = 0;
        }
        if (!isset($_SESSION['dislikes'][$postId])) {
            $_SESSION['dislikes'][$postId] = 0;
        }
    }
}

// Function to check if the user has already performed an action (like or dislike) on a post
function hasUserAction($postId, $action)
{
    if ($action === 'like') {
        return isset($_SESSION['likes'][$postId]) && $_SESSION['likes'][$postId] > 0;
    } elseif ($action === 'dislike') {
        return isset($_SESSION['dislikes'][$postId]) && $_SESSION['dislikes'][$postId] > 0;
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Press Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body img {
            max-width: 100%;
            height: auto;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
        }

        .card-text {
            font-size: 16px;
        }

        .card-footer {
            font-size: 14px;
            color: #555;
            background-color: #f0f2f5;
            border-top: none;
        }

        .btn-like,
        .btn-dislike {
            color: #365899;
        }

        .btn-like:hover,
        .btn-dislike:hover {
            color: #2952a3;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <header class="p-3 mb-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <a href="/" class="d-flex align-items-center mb-lg-0 text-white text-decoration-none">
                    <i class="bi bi-journal-check h2 me-2"></i>
                    <span class="fs-4">Press Agency</span>
                </a>
                <a href="<?php echo $searchPageUrl; ?>" class="btn btn-primary">Go to Search Page</a>
            </div>
        </div>
    </header>

    <div class="container">
        <?php if (!is_null($result) && is_array($result)) :
            foreach ($result as $res) : ?>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <?php
                            $username = $res['username'];
                            $sql2 = "SELECT profileImg FROM users WHERE username = '" . $username . "'";
                            $result2 = $db->display($sql2);
                            $profileImg = !empty($result2) ? $result2[0]['profileImg'] : 'default.png';
                            ?>
                            <img src="assets/<?php echo $res['aimage']; ?>" class="card-img-top" alt="Post Image">
                            <div class="card-body">
                                <!-- Display post content -->
                                <h5 class="card-title"><?php echo $res['atitle']; ?></h5>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?php echo htmlspecialchars($profileImg); ?>" class="profile-img me-2" alt="Editor Image">
                                    <div>
                                        <p class="card-text mb-0"><strong>Editor Name:</strong> <?php echo $res['username']; ?></p>
                                        <p class="card-text mb-0"><strong>Creation Date:</strong> <?php echo $res['pdate']; ?></p>
                                        <p class="card-text mb-0"><strong>Type:</strong> <?php echo $res['atype']; ?></p>
                                        <!-- Display the updated view count for the user -->
                                        <p class="card-text mb-0"><strong>No. Viewers:</strong> <?php echo $_SESSION['post_views'][$res['pid']]; ?></p>
                                        <?php if (isset($post['viewer'])) : ?>
                                            <p class="card-text mb-0"><strong>Shared By:</strong> <?php echo $post['viewer']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <p class="card-text"><strong>Body:</strong> <?php echo $res['abody']; ?></p>
                                <!-- Add like and dislike buttons with a form -->
                                <form action="" method="post" class="d-inline">
                                    <input type="hidden" name="postId" value="<?php echo $res['pid']; ?>">
                                    <button type="submit" name="like" class="btn btn-like me-2" <?php echo (hasUserAction($res['pid'], 'like')) ? 'disabled' : ''; ?>><i class="bi bi-hand-thumbs-up"></i> Like</button>
                                </form>
                                <form action="" method="post" class="d-inline">
                                    <input type="hidden" name="postId" value="<?php echo $res['pid']; ?>">
                                    <button type="submit" name="dislike" class="btn btn-dislike" <?php echo (hasUserAction($res['pid'], 'dislike')) ? 'disabled' : ''; ?>><i class="bi bi-hand-thumbs-down"></i> Dislike</button>
                                </form>

                                <!-- Display the like and dislike counts -->
                                <p class="card-text"><strong>Likes:</strong> <?php echo max(0, getActionCount($res['pid'], 'like', $db)); ?></p>
                                <p class="card-text"><strong>Dislikes:</strong> <?php echo max(0, getActionCount($res['pid'], 'dislike', $db)); ?></p>

                                <a href="insert_comment.php?pid=<?php echo $res['pid']; ?>" class="btn btn-success"><i class="bi bi-chat-dots"></i> Comment</a>
                                <form action="../controller/viewerController.php" method="POST" class="d-inline">
                                    <input type="hidden" name="pid" value="<?php echo $res['pid']; ?>">
                                    <button type="submit" name="savePost" class="btn btn-info"><i class="bi bi-bookmark-plus"></i> Save</button>
                                </form>
                            </div>
                            <div class="card-footer">
                                <!-- Add any additional footer information here -->
                                </div>
                            <div class="card-footer">
                                <!-- Add any additional footer information here -->
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach;
        endif; ?>
    </div>

    <footer class="p-3 mb-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <span class="text-white">&#169; 2024 Press Agency.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Function to handle user actions
function handleAction($postId, $action, $db)
{
    // Increment or decrement like/dislike count based on the action
    if ($action === 'like') {
        if (!isset($_SESSION['likes'][$postId])) {
            $_SESSION['likes'][$postId] = 0;
        }
        $_SESSION['likes'][$postId]++;
        $sql = "UPDATE shownposts SET likes = likes + 1 WHERE pid = $postId";
        // Also, clear dislike if previously set
        if (isset($_SESSION['dislikes'][$postId]) && $_SESSION['dislikes'][$postId] > 0) {
            $_SESSION['dislikes'][$postId]--;
            $sqlClearDislike = "UPDATE shownposts SET dislikes = dislikes - 1 WHERE pid = $postId";
            $db->update($sqlClearDislike);
        }
    } elseif ($action === 'dislike') {
        if (!isset($_SESSION['dislikes'][$postId])) {
            $_SESSION['dislikes'][$postId] = 0;
        }
        $_SESSION['dislikes'][$postId]++;
        $sql = "UPDATE shownposts SET dislikes = dislikes + 1 WHERE pid = $postId";
        // Also, clear like if previously set
        if (isset($_SESSION['likes'][$postId]) && $_SESSION['likes'][$postId] > 0) {
            $_SESSION['likes'][$postId]--;
            $sqlClearLike = "UPDATE shownposts SET likes = likes - 1 WHERE pid = $postId";
            $db->update($sqlClearLike);
        }
    }

    // Execute the SQL query
    $db->update($sql);
}

// Function to get like and dislike counts
function getActionCount($postId, $action, $db)
{
    // Select either like or dislike count based on the action
    if ($action === 'like') {
        $sql = "SELECT likes FROM shownposts WHERE pid = $postId";
    } elseif ($action === 'dislike') {
        $sql = "SELECT dislikes FROM shownposts WHERE pid = $postId";
    }

    // Execute the SQL query and fetch the count
    $count = $db->display($sql);

    // Return the count
    return $count[0][$action . 's'];
}
?>
