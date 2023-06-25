<?php

$a1=$_POST['weakness'];
$a2=$_POST['Polydipsia'];
$a3=$_POST['sudden_weight_loss'];
$a4=$_POST['visual_blurring'];
$a5=$_POST['Polyphagia'];
$a6=$_POST['Genital_thrush'];





if (!empty($a1) || !empty($a2) || !empty($a3) || !empty($a4) ||!empty($a5) || !empty($a6))
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
  
  $SELECT = "SELECT weakness From symptoms1 Where weakness = ? Limit 50";
  $INSERT = "INSERT Into symptoms1 (weakness, Polydipsia, sudden_weight_loss, visual_blurring, Polyphagia, Genital_thrush )values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $a1);
     $stmt->execute();
     $stmt->bind_result($a1);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssss", $a1,$a2,$a3,$a4,$a5,$a6);
      $stmt->execute();
      
      echo "New record inserted sucessfully";
      echo "<script type='text/javascript'> document.location ='survey3.html'; </script>";
     } else {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssssss", $a1,$a2,$a3,$a4,$a5,$a6);
        $stmt->execute();
        echo "New record inserted sucessfully";
        echo "<script type='text/javascript'> document.location ='survey3.html'; </script>";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>