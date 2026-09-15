<?php
session_start();
include "connection.php";
include "navbar.php";

if (empty($_SESSION['user'])) {
	header('Location: login.php');
	exit;
}

$currentEmail = $_SESSION['user'];
$allowedFields = ['name', 'email', 'phone', 'address', 'password'];
$field = $_GET['field'] ?? $_POST['field'] ?? 'name';
$field = in_array($field, $allowedFields, true) ? $field : 'name';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$value = trim($_POST['value'] ?? '');
	if ($value === '' || ($field === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) || ($field === 'phone' && !preg_match('/^[0-9]{7,15}$/', $value))) {
		$error = 'Please enter a valid value.';
	} elseif ($field === 'email') {
		$emailCheck = mysqli_prepare($con, "SELECT acc_id FROM create_account WHERE email = ? AND email <> ? LIMIT 1");
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
		$update = mysqli_prepare($con, "UPDATE create_account SET $field = ? WHERE email = ?");
		mysqli_stmt_bind_param($update, 'ss', $value, $currentEmail);
		if (mysqli_stmt_execute($update)) {
			if ($field === 'email') {
				$_SESSION['user'] = $value;
				$currentEmail = $value;
			}
			header('Location: security.php');
			exit;
		} else {
			$error = 'Unable to update details.';
		}
		mysqli_stmt_close($update);
	}
}

$userQuery = mysqli_prepare($con, "SELECT name, email, phone, address FROM create_account WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($userQuery, 's', $currentEmail);
mysqli_stmt_execute($userQuery);
$userResult = mysqli_stmt_get_result($userQuery);
$user = mysqli_fetch_assoc($userResult);
mysqli_stmt_close($userQuery);

if (!$user) {
	session_destroy();
	header('Location: login.php');
	exit;
}

function e($value) {
	return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Account Details</title>
	<link rel="stylesheet" href="css/create_acc.css">
</head>
<body>
<form method="post" action="user_detail_edit.php?field=<?php echo e($field); ?>">
	<table border="1" class="frm">
		<tr><td colspan="2" align="center">Edit <?php echo e(ucfirst($field)); ?></td></tr>
		<?php if ($error !== ''): ?><tr><td colspan="2"><?php echo e($error); ?></td></tr><?php endif; ?>
		<input type="hidden" name="field" value="<?php echo e($field); ?>">
		<?php if ($field === 'address'): ?>
			<tr><td><label for="value">Address</label></td><td><textarea id="value" name="value" rows="3" cols="40" required><?php echo e($user['address']); ?></textarea></td></tr>
		<?php else: ?>
			<tr><td><label for="value"><?php echo e(ucfirst($field)); ?></label></td><td><input type="<?php echo $field === 'email' ? 'email' : ($field === 'password' ? 'password' : ($field === 'phone' ? 'tel' : 'text')); ?>" id="value" name="value" inputmode="numeric" maxlength="15" required value="<?php echo $field === 'password' ? '' : e($user[$field]); ?>"></td></tr>
		<?php endif; ?>
		<tr><td colspan="2" align="center"><input type="submit" value="Save changes" class="hov" style="background-color: orange; cursor: pointer; font-size: 20px;"></td></tr>
	</table>
</form>
</body>
</html>
