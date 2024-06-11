<?php
include_once 'include/DatabaseClass.php';		
$db = new database();
$result = [];
$result2 = [];
if(isset($_GET['pid'])){
    $id = $_GET['pid'];

  // var_dump($id);
    $sql = "SELECT * FROM shownposts WHERE pid = '$id'";
    $result = $db->display($sql);
    $sql2="SELECT * FROM comments WHERE post_id ='$id'";
    $result2=$db->display($sql2);
    if(isset($_POST['submit'])){
    session_start();
    $comment   =   $_POST['comment'];
    $username= $_SESSION['username'];
   // var_dump($username);
   $sql1 = "INSERT INTO comments (username, post_id, comment, created_at) VALUES ('$username', $id, '$comment', NOW())";
   $db->insert($sql1);
   
   $sql2="SELECT * FROM comments WHERE post_id ='$id'";
   $result2=$db->display($sql2);
  //  $comm_id=$_POST['comm_id'];
  header('location: comment.php?pid=' . $id);
}
if(isset($_POST['submit_replay'])){
  $replay=$_POST['replay'];
  $comm_id=$_POST['comm-id'];
  $sql3="UPDATE comments SET replay='$replay' WHERE id=$comm_id";
  $db->update($sql3);    
  header('location: comment.php?pid=' . $id);
  }
   

       foreach ($result as $res){ ?> 
       <form method="POST">
          <p><strong>Editor Name:</strong> <?php echo $res['username']; ?></p>
          <input type="hidden" name="username" value="<?= $res['username']; ?>">
          <p><strong>Title:</strong> <?= $res['atitle']; ?></p>
          <p><strong>Body:</strong> <?php echo $res['abody']; ?></p>
          <p><strong>Creation Date:</strong> <?php echo $res['pdate']; ?></p>
          <p><strong>Type:</strong> <?php echo $res['atype']; ?></p>
          <p><strong>No. Viewers:</strong> <?php echo $res['viewno']; ?></p>
          <p><strong>IMG:</strong> <img src="assets/<?php echo $res['aimage']; ?>" width="90" height="90" </p>
          <br>
          <label>write a comment</label>
          <input type="text" name="comment" required>
          <button name="submit" id="submit"  type="submit">creat comment</button>
          
       </form>        
     <?php }
            foreach ($result2 as $res2){ ?> 
              <form method="POST">
                 <p><strong>  username:</strong> <?php echo $res2['username']; ?></p>
                 <p><strong>  comment:</strong> <?php echo $res2['cmoment']; ?></p>
                 <input type="hidden" name="comm-id" value="<?php echo $res2['id'];?>">
                 <br>
                 <label>replay a comment</label>
                 <input type="text" name="replay" type="text" required>
                 <button name="submit_replay" id="submit"  type="submit">replay comment</button>
              </form>        
                
         
         
            <?php }

   // header("location: ../viewer/insert_comment.php?id=$id");
}
?>