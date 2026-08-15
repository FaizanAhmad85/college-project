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
    <title>all products</title>
    <link rel="stylesheet" href="css/product_list.css">
</head>
<body>

    
    <?php
$ud= mysqli_query($con ,"select * from add_product order by uid desc");
?>
<div>
<h1 style="margin-top: 10px; display: flex; justify-content: center;">Product Data -- > <a href= " add_product.php">Add Product</a></h1>
<table class="pd_list" border="1">
    <tr><th>id</th>
    <th>Created at</th>
    <th>Image</th>
    <th>Name</th>
    <th>Price</th>
    <th>category</th>
    <th>Description</th>
    <th>Quantity</th>
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
    <td style="height: 50px; width: 50px; text-align: center;">
        <img src="product_img/<?php echo $d->image_path; ?>" alt="Image" style="max-width: 100px; max-height: 100px; object-fit: contain;">
    </td>
    <td><?php echo $d -> name;?></td>
    <td><?php echo $d -> price;?></td>
    <td><?php echo $d -> category;?></td>
    <td class="des"><?php echo $d -> description;?></td>
    <td><?php echo $d -> quantity;?></td>
    <td><a href="update_product.php?id=<?php echo $d->uid; ?>"><button style="background-color: rgb(56, 236, 86);">Edit</button></a></td>
    <td><button style="background-color: rgb(231, 96, 76);" onclick="alert('Product is deleted')">Delete</button></td>
</tr>



<?php
    }
?>
</div>
    
</table>
</body>
</html>