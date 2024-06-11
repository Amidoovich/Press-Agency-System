<?php
include_once 'include/DatabaseClass.php';		
$db = new database();


if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    $db->delete($sql);
    header("location: ../viewer/delete_users.php");
}
?>