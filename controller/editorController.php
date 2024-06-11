<?php

include_once '../model/UsersClass.php'; // Include User class
include_once '../model/editor.php'; // Include Editor class

$editor = new Editor ();
$user= new users();

if (isset($_POST['submitPost'])) {
    $username = $_POST['username'];
    $articleTitle = $_POST['article_title'];
    $articleBody = $_POST['article_body'];
    $articleType = $_POST['article_type'];
    $aimage = $_FILES['article_image']['name'] ?? '';

    $editor->submitPost($username, $articleTitle, $articleBody, $articleType, $aimage);
    header("Location: ../viewer/home.php?id=success"); // Redirect to the home page with a success message
    exit();
}
if (isset($_POST['deletePost'])) {
    $pid = $_POST['pid'];
    $user->deletePost($pid);
    header("Location: ../viewer/editorPosts.php"); // Redirect to the home page with a success message
    exit();
}
if (isset($_POST['editPosts'])) {
    $pid = $_POST['id'];
    var_dump($pid);
    $articleTitle = $_POST['article_title'];
    $articleBody = $_POST['article_body'];
    $articleType = $_POST['article_type'];
    $aimage = $_FILES['article_image']['name'] ?? '';

    $user->editPost($pid, $articleTitle, $articleBody , $articleType, $aimage);
    header("Location: ../viewer/editorPosts.php"); // Redirect to the home page with a success message
    exit();
}
