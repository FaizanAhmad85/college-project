<?php 
include "navbar.php";
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
    <title>Add Product</title>
    <link rel="stylesheet" href="css/add_product.css">
</head>
<body>
    <form name="form" method="post" action="save_product.php" enctype="multipart/form-data">
    <table border="1" class="frm">
        <tr><td colspan="2" align="center" >Add product</td></tr>
        <tr>
            <td><label for="image">Image</label></td>
            <td><input type="file" id="image" name="image" required></td>
        </tr>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" placeholder="enter product name" id="password" name="name" required></td>
        </tr>
        <tr>
            <td><label for="price">price</label></td>
            <td><input type="number" name="price" id="price" required></td>
        </tr>
        <tr>
            <td><label for="category">category</label></td>
            <td><select name="category" id="category">
                <option selected disabled>select category</option>
                <option value="ELECTRONIC">ELECTRONIC</option>
                <option value="FASHION">FASHION</option>
                <option value="GROCERY">GROCERY</option>
                <option value="BEAUTY & PERSONAL CARE">BEAUTY & PERSONAL CARE</option>
                <option value="HOME AND KITCHEN">HOME AND KITCHEN</option>
                <option value="BOOKS">BOOKS</option>
                <option value="SPORTS">SPORTS</option>
                <option value="TOYS">TOYS</option>
            </select></td>
        </tr>
        <tr>
            <td><label for="description">Discription</label></td>
            <td><input type="text" placeholder="enter product discription" id="discription" name="discription" required></td>
        </tr>
        <tr>
            <td><label for="quantity">Quantity</label></td>
            <td><input type="number" placeholder="enter product quantity" id="quantity" name="quantity" required></td>
        </tr>
        <tr><td colspan="2" align="center "><input type="submit" value="Upload Product" class="hov"
        style="background-color: orange; cursor: pointer; font-size: 20px;"></td></tr>
    </table>
</form>
</body>
</html>