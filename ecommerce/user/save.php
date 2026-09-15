<?php
include "connection.php";

$created_at = date("Y-m-d H:i:s");
$name = mysqli_real_escape_string($con, $_POST["name"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$gender = mysqli_real_escape_string($con, $_POST["gender"]);
$dob = mysqli_real_escape_string($con, $_POST["dob"]);
$phone = mysqli_real_escape_string($con, $_POST["phone"]);
$address = mysqli_real_escape_string($con, $_POST["address"]);
$rs=mysqli_query($con,"select *from create_account where email='$email'");
if(mysqli_num_rows($rs)>0){
    echo "<script>alert('You are already registered');</script>";
    echo "<script>top.window.location.href='login.php';</script>";
}
else{
$sql = "INSERT INTO create_account
(name, password, email, gender, dob, phone, address, created_at)
VALUES
('$name', '$password', '$email', '$gender', '$dob', '$phone', '$address', '$created_at')";


if (mysqli_query($con,$sql))
    {
    echo "<script>alert('Account create Susscessfully');</script>";
    echo "<script>window.location.href='login.php';</script>";    
    }

else{

    echo "<script>alert('invalid input or error');</script>";
    echo "<script>window.location.href='create_acc.php';</script>";  
    }
}
?>

