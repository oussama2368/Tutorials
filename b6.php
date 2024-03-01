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

 <form action="b6.php"  method="POST">
<div class="input-group flex-nowrap" style="width: 900px;">
  <!-- <span class="input-group-text" id="addon-wrapping"><a href="">Ajoute</a></span> -->
  <a href="b6.php"><input  class="btn btn-danger mb-3" style="height: 100%;" type="submit" name="supprim" value="Supprim" ></a>

  <div class="form-outline" style="width: 150px">
    <input min="1"  type="number" id="typeNumber" placeholder="Posted Id" style="height: 100%;" name="postid" class="form-control" required/>
    
</div> 
<div class="form-outline" style="width: 150px">
    <input min="1"  type="number" id="typeNumber" placeholder="CommentId" style="height: 100%;" name="commentid" class="form-control" required />
    
</div> 

</div>

</form >
<div style="margin-top: 30px;margin-left: 150px;"><a href="b3.php"> <input style="width: 120px;" class="btn btn-secondary mb-3"  type="submit" Value="Return" required ></a> </div>
  </div>
<?php   
     $fa = new mysqli("localhost","root","","degha");
     session_start();  $email= $_SESSION['email']; 
     
    //  echo "$email                               ";
     
     if(isset($_POST['supprim'])){
       
    $post=$_POST['postid']; 
    $commentid=$_POST['commentid'];
    
    // $commentid=$_POST['commentid'];
//    echo $commentid."     ".$post;
    

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
//   echo "$userId";
     if($n==1){
    // $sql="DELETE FROM `comments` WHERE `comments`.`commentId` = '$commentid' AND `comments`.`userId` = '$userid' AND `comments`.`postId` = '$post';";
    // echo " this comment exsits   $userid  <br>";
    // $sql= "DELETE FROM `comments` WHERE `comments`.`commentId` = '$commentid' AND `comments`.`userId` = '$userid'";
    $ti="DELETE FROM `comments` WHERE `comments`.`commentId` = '$commentid' AND `comments`.`userId` = '$userid' AND `comments`.`postId` = $post;";
    $ma=$fa->prepare($ti);
    $ma->execute();

    echo "this comment has been deleted";
    //  header('location:b4.php');
    }
     if($n==0){
        
        // echo "commentId n'exist pas<br>";
        if($right==1){
          echo "this comment does not exist <br>";
        // $sql = "INSERT INTO comments (commentId, postId, content, userId) VALUES ('$commentid','$post','$comment','$userid')";
        // $ti= $fa->prepare($sql);
        // $ti->execute();
        // echo "بالباركة عليك ";

        }
        if($right==0){echo "This Post does not exist <br>"; }
    }                
    }else{
        echo "";
        // echo s" <br> you can add new commemt";
    }
    
        // $sql = "INSERT INTO comments (content, postId) VALUES ('$com', '$post')";

    
        // session_start();$_SESSION['com']=$com; echo"$com"; }
    
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>