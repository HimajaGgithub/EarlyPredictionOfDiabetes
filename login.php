<?php
session_start();
error_reporting(0);


if(isset($_POST['login']))
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "diabetes";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

$email=$_POST['email'];
$password=$_POST['password'];
$query=mysqli_query($conn,"SELECT email,password FROM login WHERE email='$email' and password='$password'");

$num=mysqli_fetch_array($query);

if($num>0)
{
//echo "<script>alert('You are successfully logged in');</script>";
echo "<script type='text/javascript'> document.location ='survey.html'; </script>";
}

else 
{
echo "<script>alert('Not able to login');</script>";
}
}
?>