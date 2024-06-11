<?php
include_once '../controller/include/DatabaseClass.php';		
session_start();

$db = new database();

$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$image = $_FILES['image']['name'] ?? '';
$phonenum = $_POST['phonenum'] ?? '';
$userrole = $_POST['userrole'] ?? 'viewer';

$sql = "INSERT INTO userregister (fname, lname, image, phonenum, userrole) VALUES ('$fname', '$lname', '$image', '$phonenum', '$userrole')";
$db->insert($sql);

// Set session variable to indicate successful registration
$_SESSION['registration_success'] = true;
// var_dump($_SESSION['registration_success']);

// Redirect to insert1.php
header('Location: ../viewer/register.php');
exit();
?>