<?php

include_once '../model/UsersClass.php'; // Include User class
include_once '../model/viewer.php';
 // Include Viewer class
$viewer = new Viewer ();

if (isset($_POST['savePost'])) {
    $pid = $_POST['pid'];
    $saveCheck = $viewer->savePost($pid);
   // var_dump($flag['pid']==$pid);
    if ($saveCheck) {
        header("Location: ../viewer/saved_Posts.php"); 
        exit();        
    }

    else {
        echo "Post is already saved";
    }
}
