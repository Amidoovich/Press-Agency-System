<?php
include_once 'UsersClass.php';
include_once '../controller/include/DatabaseClass.php';

class Admin extends users {
    
    private static $db;

// Constructor to initialize the database connection
    public function __construct() {
        self::$db = new Database(); 
    }

// Function to accept a pending post
    public function acceptPost($pid) {

        $getPostQuery = "SELECT * FROM pendingposts WHERE pid = $pid";
        $postResult = self::$db->conn->query($getPostQuery);

        if ($postResult && $postResult->num_rows > 0) {
            $row = $postResult->fetch_assoc();

            $insertQuery = "INSERT INTO shownposts (username, atitle, abody, pdate, atype, aimage) VALUES ('{$row['username']}', '{$row['atitle']}', '{$row['abody']}', '{$row['pdate']}', '{$row['atype']}', '{$row['aimage']}')";
            $insertResult = self::$db->insert($insertQuery);

            if ($insertResult) {
                $deleteQuery = "DELETE FROM pendingposts WHERE pid = $pid";
                self::$db->delete($deleteQuery);
            }
        }
    }
    
// Function to refuse a pending post
    public function refusePost($pid) {

        $deleteQuery = "DELETE FROM pendingposts WHERE pid = $pid";
        self::$db->delete($deleteQuery); 
    }

// Function to delete existing users
    public function deleteUser($id) {

        $sql = "DELETE FROM users WHERE id = '$id'";
        self::$db->delete($sql); 
   }

// Function to accept users and set their usernames and password
   public function addUser($id, $username, $password) {
        $getUserQuery = "SELECT * FROM requested WHERE id = $id";
        $userResult = self::$db->conn->query($getUserQuery);

        if ($userResult && $userResult->num_rows > 0) {
            $row = $userResult->fetch_assoc();

            $insertQuery = "INSERT INTO users (fname, lname, profileImg, phoneNumber, role, username, password) VALUES ('{$row['fname']}', '{$row['lname']}', '{$row['image']}', '{$row['phonenum']}', '{$row['userrole']}', '$username', '$password')";
            $insertResult = self::$db->insert($insertQuery);

            if ($insertResult) {
                $deleteQuery = "DELETE FROM requested WHERE id = '$id'";
                self::$db->delete($deleteQuery);
            }
        }
    }

// Function to reject requested users    
    public function rejectUser ($id) {
        $sql = "DELETE FROM requested WHERE id = '$id'";
        self::$db->delete($sql);
    }

}
?>
