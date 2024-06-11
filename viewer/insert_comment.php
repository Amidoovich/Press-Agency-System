<?php
include_once '../controller/header.php';
include_once '../controller/include/DatabaseClass.php';
$db = new Database();
$result = [];
$result2 = [];

if (isset($_GET['pid'])) {
    $id = $_GET['pid'];

    $sql = "SELECT * FROM shownposts WHERE pid = '$id'";
    $result = $db->display($sql);
    $sql2 = "SELECT * FROM comments WHERE post_id ='$id'";
    $result2 = $db->display($sql2);

    if (isset($_POST['submit'])) {
        session_start();
        $comment = $_POST['comment'];
        $username = $_SESSION['username'];

        $sql1 = "INSERT INTO comments (username, post_id, comment, created_at) VALUES ('$username', $id, '$comment', NOW())";
        $db->insert($sql1);

        $sql2 = "SELECT * FROM comments WHERE post_id ='$id'";
        $result2 = $db->display($sql2);
        header('location: insert_comment.php?pid=' . $id);
    }

    if (isset($_POST['submit_replay'])) {
        $replay = $_POST['replay'];
        $comm_id = $_POST['comm-id'];
        $sql3 = "UPDATE comments SET replay='$replay' WHERE id=$comm_id";
        $db->update($sql3);
        header('location: insert_comment.php?pid=' . $id);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Post Details</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            .card-img-top {
                max-height: 400px;
                object-fit: cover;
            }
        </style>
    </head>
    <body>
    <div class="container mt-4">
        <?php
        if (!empty($result) && is_array($result)) {
            foreach ($result as $res) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $res['atitle']; ?></h3>
                        <p class="card-text"><?php echo $res['abody']; ?></p>
                        <p class="card-text"><small class="text-muted">Published on <?php echo date_format(date_create($res['pdate']), 'F j, Y \a\t H:i:s'); ?></small></p>
                        <?php if ($res['aimage']) { ?>
                            <img src="assets/<?php echo $res['aimage']; ?>" class="card-img-top" alt="Post image">
                        <?php } ?>
                        <p class="card-text"><strong>Type:</strong> <?php echo $res['atype']; ?></p>
                        <p class="card-text"><strong>Username:</strong> <?php echo $res['username']; ?></p>
                        <p class="card-text"><strong>Viewers:</strong> <?php echo $res['viewno']; ?></p>
                        <?php
                        session_start();
                        if ($_SESSION['role'] == "viewer") { ?>
                            <button class="btn btn-primary" id="showCommentForm" onclick="toggleCommentForm()">Write a comment</button>
                            <form method="POST" id="commentForm" style="display: none;" class="mt-3">
                                <div class="mb-3">
                                    <label class="form-label">Write a comment</label>
                                    <textarea class="form-control" name="comment" rows="3" required></textarea>
                                </div>
                                <button class="btn btn-primary" name="submit" type="submit">Create Comment</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        } else {
            echo "<p>No post found.</p>";
        }

        if (!empty($result2) && is_array($result2)) {
            foreach ($result2 as $res2) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text"><strong><?php echo $res2['username']; ?>:</strong> <?php echo $res2['comment']; ?></p>
                        <?php if ($res2['replay'] !== NULL) { ?>
                            <p class="card-text"><strong>Reply:</strong> <?php echo $res2['replay']; ?></p>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == "editor") { ?>
                            <form method="POST" class="mt-3">
                                <div class="mb-3">
                                    <label class="form-label">Reply to comment</label>
                                    <textarea class="form-control" name="replay" rows="2" required></textarea>
                                    <input type="hidden" name="comm-id" value="<?php echo $res2['id']; ?>">
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit_replay">Reply Comment</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        } else {
            echo "<p>No comments found.</p>";
        }
        ?>
    </div>
    <?php include_once '../controller/footer.php'; ?>
    <script>
        function toggleCommentForm() {
            var commentForm = document.getElementById("commentForm");
            if (commentForm.style.display === "none") {
                commentForm.style.display = "block";
            } else {
                commentForm.style.display = "none";
            }
        }
    </script>
    </body>
    </html>
    <?php
}
?>
