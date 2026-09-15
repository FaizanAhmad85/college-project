<?php
session_start();
include "connection.php";

if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$loginEmail = mysqli_real_escape_string($con, $_SESSION['user']);
$result = mysqli_query($con, "SELECT name, email, phone, address FROM create_account WHERE email = '$loginEmail' LIMIT 1");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    session_destroy();
    header('Location: login.php');
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
            <td><?= e($user['name']) ?></td>
            <td><a href="user_detail_edit.php?field=name" class="btn">Edit</a></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= e($user['email']) ?></td>
            <td><a href="user_detail_edit.php?field=email" class="btn">Edit</a></td>
        </tr>

        <tr>
            <td>Phone</td>
            <td><?= e($user['phone']) ?></td>
            <td><a href="user_detail_edit.php?field=phone" class="btn">Edit</a></td>
        </tr>

        <tr>
            <td>Address</td>
            <td class="addr"><?= e($user['address']) ?></td>
            <td><a href="user_detail_edit.php?field=address" class="btn">Edit</a></td>
        </tr>

        <tr>
            <td>Password</td>
            <td>********</td>
            <td><a href="user_detail_edit.php?field=password" class="btn">Edit</a></td>
        </tr>

        
    </table>
    <a href="logout.php" class="logout-button">Logout</a>
</body>
</html>