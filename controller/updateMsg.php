<?php
include_once '../controller/include/DatabaseClass.php';
$db = new database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $articleTitle = $_POST['article_title'];
    $articleBody = $_POST['article_body'];
    $articleType = $_POST['article_type'];
    $aimage = $_FILES['article_image']['name'] ?? '';


    $sql = "UPDATE shownposts SET atitle = '$articleTitle', abody = '$articleBody', atype = '$articleType' , aimage='$aimage'  WHERE pid = '$id'";
    $db->update($sql);

    // Redirect to a success page or perform any other necessary actions
    header("Location: ../viewer/wall_page.php");
    exit();
}