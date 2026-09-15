<?php
session_start();
include "connection.php";
include "navbar.php";

if (empty($_SESSION['admin_user'])) {
    header('Location: admin_login.php');
    exit;
}

$currentEmail = $_SESSION['admin_user'];
$allowedFields = ['name', 'email', 'phone', 'address', 'password'];
$field = $_GET['field'] ?? $_POST['field'] ?? 'name';
$field = in_array($field, $allowedFields, true) ? $field : 'name';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = trim($_POST['value'] ?? '');

    if ($value === '' || ($field === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL))) {
        $error = 'Please enter a valid value.';
    } elseif ($field === 'email') {
        $emailCheck = mysqli_prepare($con, "SELECT acc_id FROM admin_account WHERE email = ? AND email <> ? LIMIT 1");
        mysqli_stmt_bind_param($emailCheck, 'ss', $value, $currentEmail);
        mysqli_stmt_execute($emailCheck);
        mysqli_stmt_store_result($emailCheck);
        if (mysqli_stmt_num_rows($emailCheck) > 0) {
            $error = 'This email is already registered.';
        }
        mysqli_stmt_close($emailCheck);
    }

    if ($error === '') {
        if ($field === 'password') {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }
        $update = mysqli_prepare($con, "UPDATE admin_account SET $field = ? WHERE email = ?");
        mysqli_stmt_bind_param($update, 'ss', $value, $currentEmail);
        if (mysqli_stmt_execute($update)) {
            if ($field === 'email') {
                $_SESSION['admin_user'] = $value;
            }
            mysqli_stmt_close($update);
            header('Location: security.php');
            exit;
        }
        $error = 'Unable to update details.';
        mysqli_stmt_close($update);
    }
}

$adminQuery = mysqli_prepare($con, "SELECT name, email, phone, address FROM admin_account WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($adminQuery, 's', $currentEmail);
mysqli_stmt_execute($adminQuery);
mysqli_stmt_bind_result($adminQuery, $name, $email, $phone, $address);
$adminExists = mysqli_stmt_fetch($adminQuery);
mysqli_stmt_close($adminQuery);

if (!$adminExists) {
    session_destroy();
    header('Location: admin_login.php');
    exit;
}

$admin = ['name' => $name, 'email' => $email, 'phone' => $phone, 'address' => $address];

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Details</title>
    <link rel="stylesheet" href="../user/css/create_acc.css">
</head>
<body>
<form method="post" action="admin_detail_edit.php?field=<?php echo e($field); ?>">
    <table border="1" class="frm">
        <tr><td colspan="2" align="center">Edit <?php echo e(ucfirst($field)); ?></td></tr>
        <?php if ($error !== ''): ?><tr><td colspan="2"><?php echo e($error); ?></td></tr><?php endif; ?>
        <input type="hidden" name="field" value="<?php echo e($field); ?>">
        <?php if ($field === 'address'): ?>
            <tr><td><label for="value">Address</label></td><td><textarea id="value" name="value" rows="3" cols="40" required><?php echo e($admin['address']); ?></textarea></td></tr>
        <?php else: ?>
            <tr><td><label for="value"><?php echo e(ucfirst($field)); ?></label></td><td><input type="<?php echo $field === 'email' ? 'email' : ($field === 'password' ? 'password' : 'text'); ?>" id="value" name="value" required value="<?php echo $field === 'password' ? '' : e($admin[$field]); ?>"></td></tr>
        <?php endif; ?>
        <tr><td colspan="2" align="center"><input type="submit" value="Save changes" class="hov" style="background-color: orange; cursor: pointer; font-size: 20px;"></td></tr>
    </table>
</form>
</body>
</html>
