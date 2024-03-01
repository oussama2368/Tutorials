<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Change Comment</title>
</head>
<body class="d-flex vw-100 vh-100 align-items-center justify-content-center">
 <div style="display: inline;">
 <form action="b7.php"  method="POST">
<div class="input-group flex-nowrap" style="width: 900px;">
  <!-- <span class="input-group-text" id="addon-wrapping"><a href="">Ajoute</a></span> -->
  <a href="b7.php"><input  class="btn btn-success mb-3" style="height: 100%;" type="submit" name="change" value="Change" ></a>

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
     
     if(isset($_POST['change'])){

    $comment=$_POST['comment'];
    $post=$_POST['postid'];
    $commentid=$_POST['commentid'];
    // echo "$email                               $post              $commentid                  $comment   ";
    

     $sqlf="SELECT comments.userId ,comments.postId,comments.commentId,comments.content FROM ((users INNER JOIN posts on users.userId=posts.userId) 
     INNER JOIN comments on posts.userId=comments.userId ) WHERE users.email='$email' and users.userId=posts.postId;"; 
     $resultf=$fa-> query($sqlf);
     $n=0;
     $right=0;
          while($row=$resultf->fetch_assoc()){
            if($row['postId']==$post ){$right=1; }
            $userid=$row['userId'];
            // echo $row['userId'];
            // echo $row['postId']."       ".$row['commentId']." <br>   ";
          if($row['postId']==$post && $row['commentId']==$commentid ){ 
            // echo "here  <br>";
            $n=1;}}

     if($n==1){
    //  $sql = "INSERT INTO comments (commentId, postId, content, userId) VALUES ('$commentid','$post','$comment','$email')";
    //  $fa->query($sql);
// echo " post      : $post       <br>";
// echo " userId    : $userid       <br>";
// echo " commentId : $commentid       <br>";
// echo " comment   : $comment       <br>";


$sql=
// $sql = "UPDATE comments SET content = $comment WHERE commentId = '$commentid' AND userId = '$userid' AND postId = '$post'";
   // $sql = "INSERT INTO comments (commentId, postId, content, userId) VALUES ('$commentid','$post','$comment','$userid')";
   $sql = "UPDATE comments SET content = ? WHERE commentId = ? AND userId = ? AND postId = ?";
   $ti= $fa->prepare($sql);
   $ti->bind_param("siii", $comment, $commentid, $userid, $post);
   $ti->execute();

        // $ti= $fa->prepare($sql);
        // $ti->execute();
 echo "<br>Comment updated successfully";


    //  header('location:b4.php');
    }
     if($n==0){
        
       
        if($right==1){
          echo "<br> comment n'exist pas<br>";
        // $sql = "INSERT INTO comments (commentId, postId, content, userId) VALUES ('$commentid','$post','$comment','$userid')";
        // $ti= $fa->prepare($sql);
        // $ti->execute();
        // echo "بالباركة عليك ";

        }
        if($right==0){echo "<br>cette post n'exist pas<br>"; }
    }                
    }
    
      
    
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>