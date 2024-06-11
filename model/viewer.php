<?php
include_once 'UsersClass.php';
include_once '../controller/include/DatabaseClass.php';

class viewer extends users {
    
    private static $db;


    public function __construct() {
        self::$db = new Database(); 
    }
   
    public function savePost ($id) {
        $getPostQuery = "SELECT * FROM shownposts WHERE pid = $id";
        $postResult = self::$db->conn->query($getPostQuery);
        $sql="SELECT * FROM savedposts WHERE pid=$id";
        $flag=self::$db->query($sql);
        if(!$flag){
        if ($postResult && $postResult->num_rows > 0) {
            session_start();
            $row = $postResult->fetch_assoc();
            $insertQuery = "INSERT INTO savedposts (pid, username, atitle, abody, pdate, atype, aimage) VALUES ('{$row['pid']}', '{$_SESSION['username']}', '{$row['atitle']}', '{$row['abody']}', '{$row['pdate']}', '{$row['atype']}', '{$row['aimage']}')";
            $insertResult = self::$db->conn->query($insertQuery);
            return true;
            
        }
    }    
    }
}
?>