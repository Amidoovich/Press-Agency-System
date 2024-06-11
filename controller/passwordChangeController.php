<?php
include_once 'include/DatabaseClass.php';


$db = new Database();

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../viewer/login_form.php');
    exit();
}
if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])){
if (isset($_POST['submit'])) {
    
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    include_once '../model/UsersClass.php';
    $user= new users();
    $flag= $user->changepassword($currentPassword,$newPassword,$confirmPassword);
    if($flag==1 || $flag==0 || $flag==-1){
                header("location: ../viewer/passwordChange.php?id=$flag");
    }
}
}
?>