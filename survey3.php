<?php

$a1 = $_POST['Polyuria'];
$a8 = $_POST['Irritability'];
$a9 = $_POST['delayed_healing'];
$a11 = $_POST['muscle_stiffness'];
$a12 = $_POST['Alopecia'];
$a13 = $_POST['Obesity'];


if (!empty($a1) || !empty($a8) || !empty($a9) || !empty($a11) ||!empty($a12) || !empty($a13))
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
  $last_id= mysqli_insert_id($conn);
  $SELECT = "SELECT Polyuria From symptoms2 Where Polyuria = ? Limit 50";
  $INSERT = "INSERT Into symptoms2 (Polyuria , Irritability , delayed_healing , muscle_stiffness, Alopecia, Obesity)values(?,?,?,?,?,?)";
  
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
      $stmt->bind_param("ssssss", $a1,$a8,$a9,$a11,$a12,$a13);
      $stmt->execute();
      
      echo "New record inserted sucessfully";
      echo "<script type='text/javascript'> document.location ='survey4.html'; </script>";
     } else {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssssss", $a1,$a8,$a9,$a11,$a12,$a13);
        $stmt->execute();
       
        echo "New record inserted sucessfully";
        echo "<script type='text/javascript'> document.location ='survey4.html'; </script>";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>