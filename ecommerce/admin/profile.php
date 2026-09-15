<?php 
session_start();
include "navbar.php";
$log = $_SESSION['admin_user'];
if ($log == true)
    {

    }
else
{
    header('location:admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile and Create Admin</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

<a href="security.php">
    <div class="b">
        <div class="icon">🔒</div>
        <div class="content">
             <h2>Login & Security</h2>
             <p>Edit login, name, and mobile number</p>
        </div>
    </div></a>

<a href="create_admin.php">
    <div class="b">
    <div class="icon">👤</div>
    <div class="content">
        <h2>Create Admin Account</h2>
        <p>Create a new administrator account and manage access</p>
    </div>
</div></a>

<a href="admin_data.php">
<div class="b">
    <div class="icon">👨‍💼</div>
    <div class="content">
        <h3>View All Admin Accounts</h3>
        <p>View, edit, and manage all administrator accounts</p>
    </div>
</div></a>
    
</body>
</html>
