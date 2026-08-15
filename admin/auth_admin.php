<?php session_start();
    include ("connection.php");
    $user_name = $_POST['usename'];
    $pass = $_POST['password'];
    $rs=mysqli_query($con,"select *from admin_account where email='$user_name' and password='$pass'");
    if(mysqli_num_rows($rs)>0)
    {
        $_SESSION["admin_user"]=$user_name;
    echo "<script>top.window.location.href='index.php';</script>";
    }
    else{
    echo "<script>alert('You are invalid user');</script>";
    echo "<script>top.window.location.href='admin_login.php';</script>";
    
    }    

?>