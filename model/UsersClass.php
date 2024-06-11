<?php 


class users {
    private $id;
	private $fname;
	private $lname;
	private $email;
	private $profileImg;
	private $phoneNumber;
    private $username;
    private $password;
	private $role;
	private static $db;
	
	function __construct() {
		include_once '../controller/include/DatabaseClass.php';		
		$this->db = new database();
	}
	
	function login($username , $password) {
        $this->username = $username;
		$this->password = $password;
		
		$sql = "SELECT * FROM users WHERE username='$this->username'";
		$row = $this->db->select($sql);
		
		if ($row['password'] === $this->password) {
			session_start();
			$_SESSION['id'] = $row['id'];
            $_SESSION['fname'] = $row['fname'];
			$_SESSION['username']=$row['username'];
			$_SESSION['role'] = $row['role'];
			$_SESSION['lname'] = $row['lname'];
			$_SESSION['profileImg'] = $row['profileImg'];
			$_SESSION['phoneNumber'] = $row['phoneNumber'];
			
			return true;
		}
		return false;
    }
	
	function logout() {
		session_start();
		unset($_SESSION['id']);
        unset($_SESSION['fname']);
        unset($_SESSION['username']);
		unset($_SESSION['role']);
		unset($_SESSION['lname']);
		unset($_SESSION['profileImg']);
		unset($_SESSION['phoneNumber']);
		session_destroy();
    }
	
	public function usersinfo($info) {       
		$this->username = $info['username'];
		$this->password = $info['password'];
		$this->fname = $info['fname'];
		$this->role = $info['role'];
		$this->lname = $info['lname'];
		$this->email = $info['email'];
		$this->phoneNumber = $info['phoneNumber'];
		$this->profileImg = $info['profileImg'];
    }
	
	
	function getID(){
		return $this->id;
	}
		
	function getname(){
		return $this->fname;
	}

	function getUsername(){
		return $this->username;
	}
	
	function getPassword(){
		return $this->password;
	}
	
	
	function setID($id){
		$this->id = $id;
	}

	function setname($name){
		$this->fname = $name;
	}
	
	function setUsername($username){
		$this->username = $username;
	}
	
	function setPassword($password){
		$this->password = $password;
	}

	public function changepassword($currentPassword,$newPassword,$confirmPassword){

self::$db = new Database();
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$userData = self::$db->select($sql);
$currentPassword = $_POST['current_password'];
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];    
    if ($userData['password'] == $currentPassword) {
        if ($newPassword == $confirmPassword) {
            $updateSql = "UPDATE users SET `password`=$newPassword WHERE username='$username'";
            try {
                self::$db->update($updateSql);
				return $flag=1;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
                return $flag=0;
        }
    } else {
        return       $flag=-1;
    }
	
}
public function deletePost($id)
{
	$sql = "DELETE FROM shownposts WHERE pid = '$id'";
	$this->db->delete($sql);
	$sql = "DELETE FROM savedposts WHERE pid = '$id'";
	$this->db->delete($sql);
	return 1;
}
public  function editPost($id, $articleTitle, $articleBody, $articleType, $aimage)
{
	// Construct the UPDATE query
	$sql = "UPDATE shownposts SET atitle = '$articleTitle', abody = '$articleBody', atype = '$articleType', aimage = '$aimage' WHERE pid = '$id'";
	
	// Call the update method from the database class$result = $this->connection->query($sql);
	$result = $this->db->update($sql);
	if (!$result) {
		throw new Exception("Query failed: " . $this->db->conn->error);
	}
	$this->db->update($sql);
}
}




















?>