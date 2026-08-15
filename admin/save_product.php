<?php
include "connection.php";
$created_at = $_POST["created_at"];
$name = $_POST["name"];
$price = $_POST["price"];
$category = $_POST["category"];
$discription = $_POST["discription"];
$quantity = $_POST["quantity"];
$img_path=$_FILES['image']['tmp_name'];
$img_filename=$_FILES['image']['name'];

$data = "INSERT INTO add_product (created_at , name, price, category, description ,quantity,image_path )VALUES ('$created_at','$name', '$price', '$category', '$discription','$quantity','$img_filename')";
 move_uploaded_file($img_path,'product_img/'.$img_filename);
 
if (mysqli_query($con,$data))
    {
    echo "<script>alert('product list susscessfully');</script>";
    echo "<script>window.location.href='product_list.php';</script>";    
    }

else{

    echo "<script>alert('invalid input or error');</script>";
    echo "<script>window.location.href='product_list.php';</script>";  
    }
?>
