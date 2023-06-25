<?php

$a1 = $_POST['Itching'];
$a8 = $_POST['partial_pareses'];


if (!empty($a1) || !empty($a8) )
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
  
  $SELECT = "SELECT Itching From symptom3 Where Itching = ? Limit 50";
  $INSERT = "INSERT Into symptom3(Itching, partial_pareses)values(?,?)";
  
//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $a1);
     $stmt->execute();
     $stmt->bind_result($a1);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum>0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ss", $a1,$a8);
      $stmt->execute();
      
      echo "New record inserted sucessfully";
      echo "<script type='text/javascript'> document.location ='race.html'; </script>";
     } else {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ss", $a1,$a8);
        $stmt->execute();
       
        echo "New record inserted sucessfully";
        echo "<script type='text/javascript'> document.location ='final.html'; </script>";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>