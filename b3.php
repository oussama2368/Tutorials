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
    <div >
        <div style="margin-left: 250px;margin-bottom:  50px ; color: #99a;"><h1>Commentaire</h1></div>
        <div>
<table class="table" style="margin-right: 100px;margin-left: 80px;width: 720px ;" ><tr class="table-primary">  <th>postId</th> <th>CommentId</th> <th>content</th> </tr>
    <?php 
      session_start();  $email= $_SESSION['email'];$password= $_SESSION['password']; 
       $_SESSION['email']=$email;   $_SESSION['password']=$password;

      // echo ''.$email."<br>";
      $fa = new mysqli("localhost","root","","degha");
      if($fa->connect_error){
          die("connection failed : ".$fa->connect_error); }else{
            //   echo '<table><tr ><th">Post Id </th> <th">content</th> </tr>';
              // $sql="SELECT posts.postId,comments.content FROM ((users INNER JOIN posts on users.userId=posts.userId) 
              // INNER JOIN comments on posts.userId=comments.userId ) WHERE users.email='$email';";
              $sql="SELECT comments.postId,comments.commentId,comments.content FROM ((users INNER JOIN posts on users.userId=posts.userId) 
              INNER JOIN comments on posts.userId=comments.userId ) WHERE users.email='$email' and users.userId=posts.postId order by postId ";
              $result=$fa-> query($sql);
         $n=0;
          while($row=$result->fetch_assoc()){
          //  echo " <tr><td>".$row['postId']."</td>  <td>".$row['content']."</td> </tr>";
          $n=$n+1;
          
          echo " <tr> <td  >    ".$row['postId'] ."</td>   <td  >    ".$row['commentId'] ."</td> <td  >    ".$row['content'] ."</td> </tr>";
          }  
           
        //   echo "</table> b3";
           }
           if($n==0){echo "this users don't have comments";}
          $fa->close();     
          // echo ' <a href="dp1.php"> <input type="submit" value="see just your posts "></a>  ';
?>

</table> <div class="input-group flex-nowrap">
<div style=" margin-top: 40px;margin-left: 50px; "><a href="b2.php"><input style="margin-right: 20px;margin-left: 30px; ;" class="btn btn-secondary mb-3" type="submit" value="Retun"></a></div>

<div style="margin-top: 40px;margin-left: 35px;"><a href="b7.php"><input class="btn btn-success mb-3" type="submit" value="Modification"></a></div>
<div style="margin-left: 50px;margin-top: 40px;margin-right: 50px;"><a href="b4.php"><input class="btn btn-primary mb-3" type="submit" value="Nouvelle Commentaire"></a></div>
<div></div>
<div style="margin-top: 40px;"><a href="b6.php"><input class="btn btn-danger mb-3" type="submit" value="Supprition Commentaire"></a></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>