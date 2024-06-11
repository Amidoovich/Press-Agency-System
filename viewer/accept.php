<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../controller/include/DatabaseClass.php';
    $db = new database();
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phoneNum = $_POST["phoneNumber"];
    $userRole = $_POST["userRole"];
    $image_path = $_FILES['profileImg']['name'] ?? ''; // Initialize the variable

    if ($_FILES["profileImg"]["name"]) {
        $target_dir = "assets/";
        $target_file = $target_dir . basename($_FILES["profileImg"]["name"]);
        
        if (move_uploaded_file($_FILES["profileImg"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            // Handle file upload error
            echo "File upload failed!";
        }
    }
    var_dump($image_path); // Check if $image_path has a value

    $sql = "INSERT INTO requested (fname, lname, image, phonenum, userrole) VALUES ('$fname', '$lname', '$image_path', '$phoneNum', '$userRole')";
    $flag = $db->conn->query($sql);
    if ($flag) {
        header("Location: registerForm.php?id=$flag");
        exit();
    } else {
        // Handle database insertion failure
        echo "Database insertion failed!";
    }
}
?>
