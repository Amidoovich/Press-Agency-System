<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>wall page</title>
</head>
<body>

    <?php
    include_once '../controller/include/DatabaseClass.php';
    $db = new Database ();

    $shownPostsQuery = "SELECT * FROM shownposts";
    $shownPostsResult = $db->conn->query($shownPostsQuery);

    if ($shownPostsResult && $shownPostsResult->num_rows > 0) {
        while ($row = $shownPostsResult->fetch_assoc()) {

            echo "<div>";
            echo "<h3>{$row['atitle']}</h3>";
            echo "<p>{$row['atype']}</p>";
            echo "<p>{$row['abody']}</p>";
            echo "<image>{$row['aimage']}</image>";
            echo "<p>Editor: {$row['username']}</p>";
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='pid' value='{$row['pid']}'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No pending posts.";
    }
    ?>
</body>
</html>
