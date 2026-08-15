<?php
    include "navbar.php";
    include "connection.php";
    session_start();
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
    <title>admin data</title>
    <link rel="stylesheet" href="css/user_data.css">
</head>
<body>

    
    <?php
$ud= mysqli_query($con ,"select * from admin_account order by acc_id desc");
?>
<div>
<h1 style="margin-top: 10px; display: flex; justify-content: center;">Admin Data</h1>
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
    <td><a href="update_admin_data.php?id=<?php echo $d->acc_id; ?>"><button style="background-color: rgb(56, 236, 86);">Edit</button></a></td>
    <td><button style="background-color: rgb(231, 96, 76);" onclick="alert('User is deleted')">Delete</button></td>
</tr>



<?php
    }
?>
</div>
    
</table>
</body>
</html>