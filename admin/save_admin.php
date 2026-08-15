<?php
include "connection.php";

$created_at = $_POST["created_at"];
$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$dob = $_POST["dob"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$rs=mysqli_query($con,"select *from admin_account where email='$email'");
if(mysqli_num_rows($rs)>0){
    echo "<script>alert('You are already registered');</script>";
    echo "<script>top.window.location.href='login.php';</script>";
}
else{
$sql = "INSERT INTO admin_account
(created_at, name, password, email, gender, dob, phone, address)
VALUES
('$created_at','$name', '$password', '$email', '$gender', '$dob', '$phone', '$address')";


if (mysqli_query($con,$sql))
    {
    echo "<script>alert('Account create Susscessfully');</script>";
    echo "<script>window.location.href='profile.php';</script>";    
    }

else{

    echo "<script>alert('invalid input or error');</script>";
    echo "<script>window.location.href='create_admin.php';</script>";  
    }
}
?>

