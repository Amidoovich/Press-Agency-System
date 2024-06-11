<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete users</title>
    <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles */
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
</head>

<body>
    <?php 
    include_once '../controller/include/DatabaseClass.php';
    $db = new database();
    $sql = "SELECT * FROM users";
    $result = $db->display($sql);
    $numrows = $db->check($sql);

    if (!$numrows) {
        echo '<p>No results found.</p>';
    } else {
    ?>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>User Role</th>
                    <th>Username</th>
                    <th>Password</th>
                    <!-- <th>Email</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['lname']; ?></td>
                        <td><?php echo $row['phoneNumber']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td>
                            <form method="POST" action="../controller/adminController.php">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button class="btn btn-danger" type="submit" name="deleteUser">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php 
    }
    ?>
</body>

</html>
