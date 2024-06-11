<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
    // Include necessary classes and configurations
    include_once '../model/UsersClass.php'; // Include User class
    include_once '../controller/include/DatabaseClass.php'; // Include DB connection class or logic

    // Assuming you have a method in your DB class to fetch posts
    $username = $_SESSION['username'];
    $db = new Database(); // Initialize your database connection
    $postsQuery = "SELECT * FROM shownposts"; // Adjust SQL query according to your table structure
    $postsResult = $db->conn->query($postsQuery);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <div class="container mt-4">
        <?php
        // Display fetched posts
        if ($postsResult && $postsResult->num_rows > 0) {
            while ($row = $postsResult->fetch_assoc()) {
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text">Published on: <?php echo date_format(date_create($row['pdate']), 'F j, Y \a\t H:i:s'); ?></p>
                        <h3 class="card-title">Title: <?php echo $row['atitle']; ?></h3>
                        <p class="card-text">Body: <?php echo $row['abody']; ?></p>
                        <p class="card-text">Type: <?php echo $row['atype']; ?></p>
                        <p class="card-text">Username: <?php echo $row['username']; ?></p>
                        <?php if ($row['aimage']) { ?>
                            <img class="card-img-top" src="assets/<?php echo $row['aimage']; ?>" alt="Post image">
                        <?php } ?>
                        <form action='../controller/adminController.php' method='POST'>
                            <input type='hidden' name='pid' value='<?php echo $row['pid']; ?>'>
                            <button class="btn btn-danger" type='submit' name='deletePost'>Delete</button>
                        </form>
                        <form action='updatepostsadmin.php' method='POST'>
                            <input type='hidden' name='pid' value='<?php echo $row['pid']; ?>'>
                            <button class="btn btn-primary" type='submit' name='editPost'>Edit</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No posts found.</p>"; // Display if no posts are found
        }
        ?>
    </div>
    </body>
    </html>
    <?php
} else {
    header("location: login_form.php");
}
?>
