<?php
session_start();
include "connection.php";

if (empty($_SESSION['admin_user'])) {
    header('Location: admin_login.php');
    exit;
}

$loginEmail = mysqli_real_escape_string($con, $_SESSION['admin_user']);
$result = mysqli_query($con, "SELECT name, email, phone, address FROM admin_account WHERE email = '$loginEmail' LIMIT 1");
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    session_destroy();
    header('Location: admin_login.php');
    exit;
}

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>security</title>
    <link rel="stylesheet" href="css/security.css">
</head>
<body>
    <table border="1">
        <tr>
            <td>Name</td>
            <td><?= e($admin['name']) ?></td>
            <td><a href="admin_detail_edit.php?field=name" class="btn">Edit</a></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= e($admin['email']) ?></td>
            <td><a href="admin_detail_edit.php?field=email" class="btn">Edit</a></td>
        </tr>

        <tr>
            <td>Phone</td>
            <td><?= e($admin['phone']) ?></td>
            <td><a href="admin_detail_edit.php?field=phone" class="btn">Edit</a></td>
        </tr>

        <tr>
            <td>Address</td>
            <td class="addr"><?= e($admin['address']) ?></td>
            <td><a href="admin_detail_edit.php?field=address" class="btn">Edit</a></td>
        </tr>

        <tr>
            <td>Password</td>
            <td>********</td>
            <td><a href="admin_detail_edit.php?field=password" class="btn">Edit</a></td>
        </tr>

        
    </table>
    <a href="logout.php" class="logout-button">Logout</a>
</body>
</html>