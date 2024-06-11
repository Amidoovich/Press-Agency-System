<?php
include_once 'UsersClass.php';
include_once '../controller/include/DatabaseClass.php';

class Editor extends users {
    
    private static $db;

    // Constructor to initialize the database connection
    public function __construct() {
        self::$db = new Database(); // Assuming DatabaseClass.php contains the database connection logic
    }
    

    public function submitPost($username, $articleTitle, $articleBody, $articleType, $aimage) {
        $insertQuery = "INSERT INTO pendingposts (username, atitle, abody, pdate, atype, aimage) 
        VALUES ('$username', '$articleTitle', '$articleBody', NOW(), '$articleType', '$aimage')";

        if (self::$db->insert($insertQuery) === TRUE) {
        $flag="true";
        header("Location: ../viewer/createposts.php?id=$flag");
        exit();         
        }
    }
}
?>