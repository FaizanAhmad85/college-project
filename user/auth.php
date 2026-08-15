<?php session_start();
    include ("connection.php");
    $user_name = $_POST['usename'];
    $pass = $_POST['password'];
    $rs=mysqli_query($con,"select *from create_account where email='$user_name' and password='$pass'");
    if(mysqli_num_rows($rs)>0)
    {
        $_SESSION["user"]=$user_name;
    echo "<script>top.window.location.href='accounts.php';</script>";
    }
    else{
    echo "<script>alert('invalid username or password');</script>";
    echo "<script>top.window.location.href='login.php';</script>";
    
    }    

?>