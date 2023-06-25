<?php

$uname1 = $_POST['name'];
$email  = $_POST['role'];
$upswd1 = $_POST['age'];
$upswd2 = $_POST['gender'];




if (!empty($uname1) || !empty($email) || !empty($upswd1) || !empty($upswd2) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "diabetes";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT name From personal Where name = ? Limit 50";
  $INSERT = "INSERT Into personal (name , role ,age, gender )values(?,?,?,?)";
  

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $uname1,$email,$upswd1,$upswd2);
      $stmt->execute();
      
      echo "New record inserted sucessfully";
      echo "<script type='text/javascript'> document.location ='survey2.html'; </script>";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>