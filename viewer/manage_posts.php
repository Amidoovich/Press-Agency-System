<?php
include_once '../controller/include/DatabaseClass.php';
$db = new database();

// Check if the delete button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM shownposts WHERE pid = '$id'";
    $db->delete($sql);
}

$sql = "SELECT * FROM shownposts";
$result = $db->display($sql);
$numrows = $db->check($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    if (!$numrows) {
        echo '<p>No results found.</p>';
    } else {
    ?>
        <div class="container mt-5">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Article Title</th>
                    <th>Article Body</th>
                    <th>Article Type</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($result as $row) {  ?>
                    <tr>
                        <td><?php echo $row['pid']; ?></td>
                        <td><?php echo $row['atitle']; ?></td>
                        <td><?php echo $row['abody']; ?></td>
                        <td><?php echo $row['atype']; ?></td>
                        <td><img src="assets/<?php echo $row['aimage']; ?>" width="50" height="50"></td>
                        <td>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="id" value="<?php echo $row['pid']; ?>">
                                <button class="btn btn-outline-danger" type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php
    }
    ?>

    <style>
        button {
            margin-bottom: 5px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid black;
        }

        table {
            border: 1px solid black;
        }
    </style>
</body>

</html>