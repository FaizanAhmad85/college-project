<?php
include "navbar.php";
session_start();
$login = $_SESSION['user'];
if ($login == true)
    {

    }
else
{
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts & List</title>
    <link rel="stylesheet" href="css/accounts.css">
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

</body>
</html>