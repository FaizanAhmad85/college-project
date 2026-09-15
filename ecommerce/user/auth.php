<?php session_start();
    include ("connection.php");
    $user_name = trim($_POST['usename'] ?? '');
    $pass = $_POST['password'] ?? '';
    $stmt = mysqli_prepare($con, "SELECT password FROM create_account WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $user_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $storedPassword);
    $authenticated = mysqli_stmt_fetch($stmt) && (
        password_verify($pass, $storedPassword) || hash_equals($storedPassword, $pass)
    );
    mysqli_stmt_close($stmt);

    if($authenticated)
    {
        $_SESSION["user"]=$user_name;
    echo "<script>top.window.location.href='accounts.php';</script>";
    }
    else{
    echo "<script>alert('invalid username or password');</script>";
    echo "<script>top.window.location.href='login.php';</script>";
    
    }    

?>