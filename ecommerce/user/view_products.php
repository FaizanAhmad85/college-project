<?php
session_start();
include "connection.php";

function e($value) {
	return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
	header("Location: index.php");
	exit;
}

$productQuery = mysqli_query($con, "SELECT * FROM add_product WHERE uid = $id LIMIT 1");
$product = mysqli_fetch_assoc($productQuery);

if (!$product) {
	header("Location: index.php");
	exit;
}

$cartMessage = $_SESSION['cart_message'] ?? '';
unset($_SESSION['cart_message']);

if ((isset($_POST['add_to_cart']) || isset($_POST['buy_now'])) && intval($product['quantity']) > 0) {
	$quantity = intval($_POST['quantity'] ?? 1);
	$quantity = max(1, min($quantity, intval($product['quantity'])));
	$_SESSION['cart'] = $_SESSION['cart'] ?? [];
	$_SESSION['cart'][$id] = $quantity;
	if (isset($_POST['buy_now'])) {
		header("Location: cart.php");
		exit;
	}
	$_SESSION['cart_message'] = 'Product has been added to your cart.';
	header("Location: view_products.php?id=" . $id);
	exit;
}

$category = mysqli_real_escape_string($con, $product['category'] ?? '');
$similarQuery = mysqli_query($con, "SELECT * FROM add_product WHERE category = '$category' AND uid != $id ORDER BY uid DESC LIMIT 8");

$imageName = basename($product['image_path'] ?? '');
$imageFile = __DIR__ . "/../admin/product_img/" . $imageName;
$imageUrl = "../admin/product_img/" . rawurlencode($imageName);
if ($imageName === '' || !file_exists($imageFile)) {
	$imageUrl = "images/placeholder.png";
}

include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo e($product['name']); ?> - Product Details</title>
	<link rel="stylesheet" href="css/view_products.css">
</head>
<body>
<main class="product-view">
	<section class="product-detail">
		<div class="detail-image">
			<img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($product['name']); ?>">
		</div>

		<div class="detail-info">
			<p class="detail-category"><?php echo e($product['category']); ?></p>
			<h1><?php echo e($product['name']); ?></h1>
			<p class="detail-price">Rs. <?php echo e($product['price']); ?></p>
			<p class="detail-description"><?php echo e($product['description']); ?></p>
			<?php if ($cartMessage !== ''): ?>
				<p class="cart-message"><?php echo e($cartMessage); ?></p>
			<?php endif; ?>

			<?php if (intval($product['quantity']) > 0): ?>
				<form method="post">
					<label class="quantity-label" for="quantity">Quantity</label>
					<input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo intval($product['quantity']); ?>">
					<div class="purchase-buttons">
						<button class="add-to-cart" type="submit" name="add_to_cart">Add to cart</button>
						<button class="buy-now" type="submit" name="buy_now">Buy now</button>
					</div>
				</form>
			<?php else: ?>
				<p class="detail-out-stock">Out of stock</p>
			<?php endif; ?>
		</div>
	</section>

	<h2 class="similar-title">Similar Products</h2>
	<div class="similar-products">
		<?php while ($similar = mysqli_fetch_assoc($similarQuery)): ?>
			<?php
				$similarImageName = basename($similar['image_path'] ?? '');
				$similarImageFile = __DIR__ . "/../admin/product_img/" . $similarImageName;
				$similarImageUrl = "../admin/product_img/" . rawurlencode($similarImageName);
				if ($similarImageName === '' || !file_exists($similarImageFile)) {
					$similarImageUrl = "images/placeholder.png";
				}
			?>
			<a class="similar-product" href="view_products.php?id=<?php echo intval($similar['uid']); ?>">
				<img src="<?php echo e($similarImageUrl); ?>" alt="<?php echo e($similar['name']); ?>">
				<h3><?php echo e($similar['name']); ?></h3>
				<p>Rs. <?php echo e($similar['price']); ?></p>
			</a>
		<?php endwhile; ?>
	</div>
</main>
<?php include "footer.php"; ?>
</body>
</html>