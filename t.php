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
        <div>
<table class="table" style="margin-right: 100px;margin-left: 80px;width: 700px ;" ><tr class="table-primary">  <th>postId</th> <th>content</th> </tr>
    <?php 
// if(!$_SESSION['etopd2']=""){  $email= $_SESSION['etopd2'];$password= $_SESSION['ptopd2']; }


 
    $email = $_POST['email'];
    $password = $_POST['password'];
    

   
    

$fa = new mysqli("localhost","root","","degha");
// echo "$email";
    //  echo "         new this is text    ".$username."      ".$password;
if($fa->connect_error){
    die("connection failed : ".$fa->connect_error); }else{
     $ti=$fa->prepare("select * from users where email='$email' and password='$password';");
     $ti->execute();
     $ma=$ti->get_result();
     if($ma->num_rows>0){
    //    echo '<table><tr>  <th>postId</th> <th>content</th> </tr>'; 
        $sql="SELECT posts.postId,posts.content FROM posts INNER JOIN users on posts.userId=users.userId WHERE email='$email';";
        $result=$fa-> query($sql);

    while($row=$result->fetch_assoc()){

    //  echo " <tr><td>".$row['postId']."</td>  <td>".$row['content']."</td> </tr>";
    echo " <tr><td> <a href=''>".$row['postId']."</a> '</td>  <td>    ".$row['content'] ."</td> </tr>";
    }

    // echo "</table>";
//  echo ' <a href="dp.php"> <input type="submit" value="see posts of your friend"></a>  ';
echo '</div> <br> <div style="margin : 50px;margin-left: 80px;"><a href="dp3.php" style="margin-top:350px"> <input type="submit" value="see your comment"></a> </div>';
}else{
         echo ' <html>
        <body>
            <script>
            window.location.href = "login.html";
            </script>
        </body>
    </html>';
}
    $fa->close();}
    
    if(!$_SESSION['email']=""){session_start();$_SESSION['email']=$email;$_SESSION['password']=$password; }
?>

</table>
<div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>