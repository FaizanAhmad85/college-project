<?php
    include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts & List</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<form action="auth.php" method="post" name="frm">   
    <div class="log">
        <h1>Login</h1>
        <hr>
        <input type="text" placeholder="Username & email" name="usename" required>
        <input type="password" placeholder="Password" name="password" required>

        <input type="submit" value="Login" class="ho" name="login" style="background-color: rgb(218, 151, 27); cursor: pointer;">


        <div class="ca">Create Account > <a href="create_acc.php" target="_parent">SignUp Here</a></div>
    </div>
</form>
</body>
</html>