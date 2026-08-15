<?php
    include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/admin_login.css">
</head>
<body>
<form action="auth_admin.php" method="post" name="frm">   
    <div class="log">
        <h1>Login</h1>
        <hr>
        <input type="text" placeholder="Username & email" name="usename" required>
        <input type="password" placeholder="Password" name="password" required>

        <input type="submit" value="Login" class="ho" name="login" style="background-color: rgb(218, 151, 27); cursor: pointer;">
    </div>
</form>
</body>
</html>