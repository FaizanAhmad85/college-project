<?php
include "navbar.php";
include "connection.php";

$uid = '';
$image_path = '';
$name = '';
$price = '';
$category = '';
$description = '';
$quantity = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    $query = "UPDATE add_product SET name='$name', price='$price', category='$category', description='$description', quantity='$quantity' WHERE uid=$uid";
    mysqli_query($con, $query);
    header("Location: product_list.php");
    exit;
}

if (isset($_GET['id'])) {
    $uid = intval($_GET['id']);
    $result = mysqli_query($con, "SELECT * FROM add_product WHERE uid = $uid");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $price = $row['price'];
        $category = $row['category'];
        $description = $row['description'];
        $quantity = $row['quantity'];
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/add_product.css">
</head>
<body>
    <form name="form" method="post" action="">
    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
    <table border="1" class="frm">
        <tr><td colspan="2" align="center">Update Product</td></tr>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" placeholder="enter product name" id="name" name="name" value="<?php echo $name; ?>" required></td>
        </tr>
        <tr>
            <td><label for="price">Price</label></td>
            <td><input type="number" name="price" id="price" value="<?php echo $price; ?>" required></td>
        </tr>
        <tr>
            <td><label for="category">Category</label></td>
            <td><select name="category" id="category">
                <option disabled>select category</option>
                <option value="ELECTRONIC" <?php if ($category === 'ELECTRONIC') echo 'selected'; ?>>ELECTRONIC</option>
                <option value="FASHION" <?php if ($category === 'FASHION') echo 'selected'; ?>>FASHION</option>
                <option value="GROCERY" <?php if ($category === 'GROCERY') echo 'selected'; ?>>GROCERY</option>
                <option value="BEAUTY & PERSONAL CARE" <?php if ($category === 'BEAUTY & PERSONAL CARE') echo 'selected'; ?>>BEAUTY & PERSONAL CARE</option>
                <option value="HOME AND KITCHEN" <?php if ($category === 'HOME AND KITCHEN') echo 'selected'; ?>>HOME AND KITCHEN</option>
                <option value="BOOKS" <?php if ($category === 'BOOKS') echo 'selected'; ?>>BOOKS</option>
                <option value="SPORTS" <?php if ($category === 'SPORTS') echo 'selected'; ?>>SPORTS</option>
                <option value="TOYS" <?php if ($category === 'TOYS') echo 'selected'; ?>>TOYS</option>
            </select></td>
        </tr>
        <tr>
            <td><label for="description">Description</label></td>
            <td><input type="text" placeholder="enter product description" id="description" name="description" value="<?php echo $description; ?>" required></td>
        </tr>
        <tr>
            <td><label for="quantity">Quantity</label></td>
            <td><input type="number" placeholder="enter product quantity" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required></td>
        </tr>
        <tr><td colspan="2" align="center"><input type="submit" value="Update" class="hov"
        style="background-color: orange; cursor: pointer; font-size: 20px;"></td></tr>
    </table>
</form>
</body>
</html>