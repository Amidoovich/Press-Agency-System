<?php
include_once '../controller/include/DatabaseClass.php';
$db = new database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
    // Get form data
    $userName = $_POST['username'];
    $articleTitle = $_POST['article_title'];
    $articleBody = $_POST['article_body'];
    $articleType = $_POST['article_type'];
    $aimage = $_FILES['article_image']['name'] ?? '';
    // Process other form data like date, image, etc.

    // Insert into pendingPosts table
    $insertQuery = "INSERT INTO pendingposts (username, atitle, abody, pdate, atype, aimage) 
                    VALUES ('$userName', '$articleTitle', '$articleBody', NOW(), '$articleType', '$aimage')";
    
    if ($db->insert($insertQuery) === TRUE) {
        $flag="true";
        header("Location: ../viewer/createposts.php?id=$flag"); // Redirect to a success page
        exit();         // Redirect or show a success message
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
        // Handle error, display message, or redirect
    }
}
}
?>
