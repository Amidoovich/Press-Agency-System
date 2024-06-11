<?php
include_once '../controller/include/DatabaseClass.php';
$sql = "SELECT * FROM requested";
$db = new Database();
$result = $db->conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Requests</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Image</th><th>Phone Number</th><th>User Role</th><th>Accept</th><th>Reject</th></tr></thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td><img src='" . $row['image'] . "' alt='User Image' style='max-width: 100px;'></td>";
                echo "<td>" . $row['phonenum'] . "</td>";
                echo "<td>" . $row['userrole'] . "</td>";

                echo "<td>";
                echo "<form action='setCredentials.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='accept' class='btn btn-success'>Accept</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form action='../controller/adminController.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='rejectUser' class='btn btn-danger'>Reject</button>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No data found in 'requested' table</p>";
        }

        $db->conn->close();
        ?>
    </div>

    <!-- Bootstrap JS and jQuery (optional but required for Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

