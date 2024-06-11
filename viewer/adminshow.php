<?php
// Your database connection setup
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'swe_project';
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {
        
        $id = $_POST['id'];
        header("Location: insert_username_password.php?id=" . $_POST['id']);
       
        
        exit();
    } elseif (isset($_POST['reject'])) {
        $id_to_delete = $_POST['id'];
        $delete_sql = "DELETE FROM users WHERE id = $id_to_delete";
        if ($conn->query($delete_sql) === TRUE) {
            header("Refresh:0");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
 }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Image</th><th>Phone Number</th><th>User Role</th><th>Accept</th><th>Reject</th><th>user status</th></tr></thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['fname'] . "</td>";
        echo "<td>" . $row['lname'] . "</td>";
        echo "<td>" . $row['profileImg'] . "</td>";
        echo "<td>" . $row['phoneNumber'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        
        echo "<td>";
        echo "<form action='' method='post'>";
        echo "<form action='' method='post' >";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";    
        echo "<input type='submit' name='accept' value='Accept'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";    
        echo "<input type='submit' name='reject' value='Reject'>";
        echo "</form>";
        echo "</td>";
        echo "<td>" . $row['userstatus']."</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "No data found in 'requested' table";
}

$conn->close();
?>
