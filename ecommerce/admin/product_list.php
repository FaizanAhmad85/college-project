<?php
    session_start();
    include "connection.php";

    if (empty($_SESSION['admin_user'])) {
        header('Location: admin_login.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
        $uid = filter_input(INPUT_POST, 'uid', FILTER_VALIDATE_INT);

        if ($uid) {
            $product = mysqli_prepare($con, "SELECT image_path FROM add_product WHERE uid = ? LIMIT 1");
            mysqli_stmt_bind_param($product, 'i', $uid);
            mysqli_stmt_execute($product);
            mysqli_stmt_bind_result($product, $imagePath);
            $productFound = mysqli_stmt_fetch($product);
            mysqli_stmt_close($product);

            if ($productFound) {
                $delete = mysqli_prepare($con, "DELETE FROM add_product WHERE uid = ?");
                mysqli_stmt_bind_param($delete, 'i', $uid);
                mysqli_stmt_execute($delete);
                mysqli_stmt_close($delete);

                if ($imagePath !== '') {
                    $imageFile = __DIR__ . '/product_img/' . basename($imagePath);
                    if (is_file($imageFile)) {
                        unlink($imageFile);
                    }
                }
            }
        }

        header('Location: product_list.php');
        exit;
    }

    include "navbar.php";
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
    <td>
        <form method="post" action="product_list.php" onsubmit="return confirm('Are you sure you want to delete this product?');">
            <input type="hidden" name="uid" value="<?php echo (int) $d->uid; ?>">
            <button type="submit" name="delete_product" style="background-color: rgb(231, 96, 76);">Delete</button>
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