<?php

$uname1 = $_POST['Relation'];
$email  = $_POST['Race'];
$a=$_POST['class'];




if (!empty($uname1) || !empty($email)  )
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
  $SELECT = "SELECT Relation From family_background Where Relation = ? Limit 50";
  $INSERT = "INSERT Into family_background(Relation, Race, class)values(?,?,?)";
  

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
      $stmt->bind_param("sss", $uname1,$email,$a);
      $stmt->execute();
      
      echo "New record inserted sucessfully";
      echo "<script type='text/javascript'> document.location ='final.html'; </script>";
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