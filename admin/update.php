<?php
include "navbar.php";
include "connection.php";

$acc_id = '';
$name = '';
$email = '';
$gender = '';
$dob = '';
$phone = '';
$address = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acc_id = $_POST['acc_id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $query = "UPDATE create_account SET name='$name', password='$password', email='$email', gender='$gender', dob='$dob', phone='$phone', address='$address' WHERE acc_id=$acc_id";
    mysqli_query($con, $query);
    header("Location: user_data.php");
    exit;
}

if (isset($_GET['id'])) {
    $acc_id = intval($_GET['id']);
    $result = mysqli_query($con, "SELECT * FROM create_account WHERE acc_id = $acc_id");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $password = $row['password'];
        $email = $row['email'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $phone = $row['phone'];
        $address = $row['address'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link rel="stylesheet" href="../user/css/create_acc.css">
</head>
<body>
<form name="form" method="post" action="">
    <input type="hidden" name="acc_id" value="<?php echo ($acc_id); ?>">
    <table border="1" class="frm">
        <tr><td colspan="2" align="center" >Update Account</td></tr>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" placeholder="enter your name" id="name" name="name" required value="<?php echo ($name); ?>"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" placeholder="enter your password" id="password" name="password" required value="<?php echo ($password); ?>"></td>
        </tr>
        <tr>
            <td><label for="gender">Gender</label></td>
            <td><select name="gender" id="gender" required>
                <option disabled value="">Select Gender</option>
                <option value="Male" <?php if ($gender === 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($gender === 'Female') echo 'selected'; ?>>Female</option>
            </select></td>
        </tr>
        <tr>
            <td><label for="dob">D.O.B</label></td>
            <td><input type="date" name="dob" id="dob" required value="<?php echo ($dob); ?>"></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" placeholder="enter your email" id="email" name="email" required value="<?php echo ($email); ?>"></td>
        </tr>
        <tr>
            <td><label for="phone">Phone no</label></td>
            <td><input type="number" placeholder="enter your phone" id="phone" name="phone" required value="<?php echo ($phone); ?>"></td>
        </tr>
        <tr>
            <td><label for="address">Address</label></td>
            <td><textarea name="address" id="address" placeholder="enter your address" rows="3" cols="40" required><?php echo ($address); ?></textarea></td>
        </tr>
        <tr><td colspan="2" align="center "><input type="submit" value="Update" class="hov"
        style="background-color: orange; cursor: pointer; font-size: 20px;"></td></tr>
    </table>
</form>
    
</body>
</html>