<?php session_start();
    include ("connection.php");
    $user_name = trim($_POST['usename'] ?? '');
    $pass = $_POST['password'] ?? '';
    $stmt = mysqli_prepare($con, "SELECT password FROM admin_account WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $user_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $storedPassword);
    $authenticated = mysqli_stmt_fetch($stmt) && (
        password_verify($pass, $storedPassword) || hash_equals($storedPassword, $pass)
    );
    mysqli_stmt_close($stmt);

    if($authenticated)
    {
        $_SESSION["admin_user"]=$user_name;
    echo "<script>top.window.location.href='index.php';</script>";
    }
    else{
    echo "<script>alert('You are invalid user');</script>";
    echo "<script>top.window.location.href='admin_login.php';</script>";
    
    }    

?>