<?php
include_once '../controller/include/DatabaseClass.php';
$db = new Database ();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {

        $pid = $_POST['pid'];

        $getPostQuery = "SELECT * FROM pendingposts WHERE pid = $pid";
        $postResult = $db->conn->query($getPostQuery);

        if ($postResult && $postResult->num_rows > 0) {
            $row = $postResult->fetch_assoc();

            $insertQuery = "INSERT INTO shownposts (username, atitle, abody, pdate, atype, aimage) VALUES ('{$row['username']}', '{$row['atitle']}', '{$row['abody']}', '{$row['pdate']}', '{$row['atype']}', '{$row['aimage']}')";
            $insertResult = $db->insert($insertQuery);

            if ($insertResult) {
                $deleteQuery = "DELETE FROM pendingposts WHERE pid = $pid";
                $deleteResult = $db->delete($deleteQuery);

                if ($deleteResult) {
                    header("Location: ../viewer/requestedPosts.php"); 
                    exit();
                }
            }
        }
    } 
    elseif (isset($_POST['refuse'])) {

            $pid = $_POST['pid'];
    
            $deleteQuery = "DELETE FROM pendingposts WHERE pid = $pid";
            $deleteResult = $db->delete($deleteQuery);
    
            if ($deleteResult) {
                header("Location: ../viewer/requestedPosts.php");
                exit();
            }
        }
    }
?>
