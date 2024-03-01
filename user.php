<?php 
// echo "bonjour <br>";
$password = $_POST['password'];
// $password1 = $_POST['password1'];
$username = $_POST['username'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$location = $_POST['location'];
$datecreation= date("Y-m-d");
$bio= $_POST['bio'];


// echo ("password $password   <br>");
// echo ("username $username   <br>");
// echo ("fullname $fullname   <br>");
// echo ("email $email   <br>");
// echo ("birthdate $birthdate   <br>");
// echo ("location $location   <br>");
// echo ("date $datecreation   <br>");
// echo ("bio $bio   <br>");

$fa = new mysqli("localhost","root","","degha");
// echo "Connecting to database...";
if(!empty($bio)) {
  $ti = "INSERT INTO users (username, fullName, birthdate, 	location, bio ,createdAt	,password, email) 
  VALUES ('$username', '$fullname', '$birthdate',  '$location', '$bio', '$datecreation',  '$password', '$email')";
  $ma = $fa->prepare($ti);
}else{
  $ti = "INSERT INTO users (username, fullName, birthdate, 	location, bio ,createdAt	,password, email) 
  VALUES ('$username', '$fullname', '$birthdate',  '$location', '', '$datecreation',  '$password', '$email')";
   $ma = $fa->prepare($ti);
}
  //  $ma->bind_param("ssssssss", $username, $fullname, $birthdate, $location, $bio,$datecreation, $password, $email); echo "acces" ;
  
    $ma->execute();
    // echo " creation compte seccussful " ;

  // else{
  //   echo "this email already exists";
  // }
  
    // echo "all is right" ;
 

  $fa->close();

  


  
// echo ''.$email."<br>";
$faa = new mysqli("localhost","root","","degha");
if($fa->connect_error){
    die("connection failed : ".$faa->connect_error); }else{
        echo '<table><tr > <th">content</th> </tr>';
        $sql="SELECT comments.content FROM ((users INNER JOIN posts on users.userId=posts.userId) 
        INNER JOIN comments on posts.userId=comments.userId ) WHERE users.email='$email';";
        $result=$faa-> query($sql);
   $n=0;
    while($row=$result->fetch_assoc()){
    //  echo " <tr><td>".$row['postId']."</td>  <td>".$row['content']."</td> </tr>";
    $n=$n+1;
    $row=$result->fetch_assoc();
    echo " <tr>  <td  >    ".$row['content'] ."</td> </tr>";
    }  
     
    echo "</table> <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js'></script>";
     }
     if($n==0){echo "this users don't have comments";}
    $faa->close();     
    // echo ' <a href="dp1.php"> <input type="submit" value="see just your posts "></a>  ';

?>