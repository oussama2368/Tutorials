<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Document</title>
</head>
<body class="d-flex vw-100 vh-100 align-items-center justify-content-center">
 <div style="display: inline;">
 <form action="b4.php"  method="POST">
<div class="input-group flex-nowrap" style="width: 900px;">
  <!-- <span class="input-group-text" id="addon-wrapping"><a href="">Ajoute</a></span> -->
  <a href="b4.php"><input  class="btn btn-primary mb-3" style="height: 100%;" type="submit" name="ajoute" value="Ajoute" ></a>

  <div class="form-outline" style="width: 150px">
    <input min="1"  type="number" id="typeNumber" placeholder="Posted Id" style="height: 100%;" name="postid" class="form-control" required/>
    
</div> 
<div class="form-outline" style="width: 150px">
    <input min="1"  type="number" id="typeNumber" placeholder="CommentId" style="height: 100%;" name="commentid" class="form-control" required />
    
</div> 

  <input type="text" class="form-control" name="comment" placeholder="Novelle Commentaire" aria-label="Username" aria-describedby="addon-wrapping" name="com" required>
    
</div>

</form >
<div style="margin-top: 30px;margin-left: 350px;"><a href="b3.php"> <input style="width: 120px;" class="btn btn-secondary mb-3"  type="submit" Value="Return" required ></a> </div>
  </div>
<?php   
     $fa = new mysqli("localhost","root","","degha");
     session_start();  $email= $_SESSION['email']; 

     $sqluser="SELECT userId FROM users WHERE email='$email'";
     $resultuser=$fa->query($sqluser);
     $useridR=$resultuser->fetch_assoc();
     $userid=$useridR['userId'];

     if(isset($_POST['ajoute'])){
    $comment=$_POST['comment'];
  
    $post=$_POST['postid'];
    $commentid=$_POST['commentid'];
    // echo "post is : $post    <br>   comment id :  $commentid   <br>  ";
    
    $sql="select * from comments where commentId='$commentid' and postId='$post' and userId='$userid'";
    $result=$fa->query($sql);
    if($result->num_rows>0){
      echo "Comment already exists";
    }else{
      // echo "n'existe pas";
      $sql= "INSERT INTO comments (commentId, postId, userId,content) VALUES ('$commentid', '$post', '$userid', '$comment')";
      // echo " $userid ----$commentid ---- $post ----  $comment";
      $ti=$fa-> prepare ($sql);
      $ti->execute();
      echo "Comment added successfully";

    }
     }
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>