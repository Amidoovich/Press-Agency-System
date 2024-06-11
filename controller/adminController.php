<?php
// Include necessary classes and configurations
include_once '../model/UsersClass.php'; // Include User class
include_once '../model/admin.php'; // Include Admin class
$admin = new Admin ();
$user= new users();

// Check if the form for accepting/refusing a post is submitted
if (isset($_POST['acceptPost'])) {
    
    $pid = $_POST['pid'];
    $admin->acceptPost($pid);
    header("Location: ../viewer/requestedPosts.php"); 
    exit();
}
if (isset($_POST['refusePost'])) {
    $pid = $_POST['pid'];
    $admin->refusePost($pid);
    header("Location: ../viewer/requestedPosts.php"); 
    exit();
}
if(isset($_POST['deleteUser'])){
    $id = $_POST['id'];
    $admin->deleteUser($id);
    header("location: ../viewer/delete_users.php");
}
if(isset($_POST['setCredentials'])){
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin->addUser($userId, $username, $password);
    header("Location:../viewer/registeredUsers.php");
    exit();
}
if (isset($_POST['rejectUser'])) {
    $userId = $_POST['id'];
    $admin->rejectUser($userId);
    header("Location:../viewer/registeredUsers.php");
    exit();
}

if (isset($_POST['deletePost'])) {
    $pid = $_POST['pid'];
    $user->deletePost($pid);
    header("Location: ../viewer/adminposts.php"); // Redirect to the home page with a success message
    exit();
}
if (isset($_POST['editPosts'])) {
    $pid = $_POST['id'];
    $articleTitle = $_POST['article_title'];
    $articleBody = $_POST['article_body'];
    $articleType = $_POST['article_type'];
    $aimage = $_FILES['article_image']['name'] ?? '';

    $user->editPost($pid, $articleTitle, $articleBody , $articleType, $aimage);
    header("Location: ../viewer/adminposts.php"); // Redirect to the home page with a success message
    exit();
}