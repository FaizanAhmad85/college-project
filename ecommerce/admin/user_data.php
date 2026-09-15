<?php
    session_start();
    include "connection.php";

    if (empty($_SESSION['admin_user'])) {
        header('Location: admin_login.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
        $acc_id = filter_input(INPUT_POST, 'acc_id', FILTER_VALIDATE_INT);

        if ($acc_id) {
            $delete = mysqli_prepare($con, "DELETE FROM create_account WHERE acc_id = ?");
            mysqli_stmt_bind_param($delete, 'i', $acc_id);
            mysqli_stmt_execute($delete);
            mysqli_stmt_close($delete);
        }

        header('Location: user_data.php');
        exit;
    }

    include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user data</title>
    <link rel="stylesheet" href="css/user_data.css">
</head>
<body>

    
    <?php
$ud= mysqli_query($con ,"select * from create_account order by acc_id desc");
?>
<div>
<h1 style="margin-top: 10px; display: flex; justify-content: center;">User Data</h1>
<table class="user" border="1">
    <tr><th>id</th>
    <th>Created at</th>
    <th>Name</th>
    <th>Email</th>
    <th>Gender</th>
    <th>D.O.B</th>
    <th>Phone.no</th>
    <th>Address</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
<?php
$data=0;

while($d = mysqli_fetch_object($ud))
    {
        $data++;
    
?>
<tr>
    <td><?php echo $data;?></td>
    <td class="cre"><?php echo $d -> created_at;?></td>
    <td><?php echo $d -> name;?></td>
    <td><?php echo $d -> email;?></td>
    <td><?php echo $d -> gender;?></td>
    <td><?php echo $d -> dob;?></td>
    <td><?php echo $d -> phone;?></td>
    <td class="des"><?php echo $d -> address;?></td>
    <td><a href="update.php?id=<?php echo $d->acc_id; ?>"><button style="background-color: rgb(56, 236, 86);">Edit</button></a></td>

    <td>
        <form method="post" action="user_data.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
            <input type="hidden" name="acc_id" value="<?php echo (int) $d->acc_id; ?>">
            <button type="submit" name="delete_user" style="background-color: rgb(231, 96, 76);">Delete</button>
        </form>
    </td>
</tr>



<?php
    }
?>
</div>
    
</table>
</body>
</html>