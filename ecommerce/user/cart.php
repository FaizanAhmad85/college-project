<?php
session_start();
include "connection.php";

if (isset($_POST['remove']) || isset($_POST['update_quantity'])) {
	$id = intval($_POST['id']);
	if (isset($_POST['remove'])) {
		unset($_SESSION['cart'][$id]);
	} else {
		$quantity = intval($_POST['quantity'] ?? 1);
		$productQuery = mysqli_query($con, "SELECT quantity FROM add_product WHERE uid = $id LIMIT 1");
		$product = mysqli_fetch_assoc($productQuery);
		if (!$product || intval($product['quantity']) <= 0 || $quantity <= 0) {
			unset($_SESSION['cart'][$id]);
		} else {
			$_SESSION['cart'][$id] = min($quantity, intval($product['quantity']));
		}
	}
	header("Location: cart.php");
	exit;
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;
$totalItems = 0;
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cart</title>
	<link rel="stylesheet" href="css/cart.css">
</head>
<body>
<main class="cart-page">
	<div class="cart-heading">
		<h1>Shopping Cart</h1>
	</div>

	<?php if (empty($cart)): ?>
		<div class="empty-cart">
			<h2>Your cart is empty</h2>
			<p>Add products from the store to see them here.</p>
			<a class="shop-button" href="index.php">Start shopping</a>
		</div>
	<?php else: ?>
		<div class="cart-layout">
			<section class="cart-items">
				<?php foreach ($cart as $id => $cartQuantity): ?>
					<?php
						$id = intval($id);
						$cartQuantity = max(1, intval($cartQuantity));
						$productQuery = mysqli_query($con, "SELECT * FROM add_product WHERE uid = $id LIMIT 1");
						$product = mysqli_fetch_assoc($productQuery);
						if (!$product) continue;
						$lineTotal = $product['price'] * $cartQuantity;
						$total += $lineTotal;
						$totalItems += $cartQuantity;
						$imageName = basename($product['image_path'] ?? '');
						$imageFile = __DIR__ . "/../admin/product_img/" . $imageName;
						$imageUrl = "../admin/product_img/" . rawurlencode($imageName);
						if ($imageName == '' || !file_exists($imageFile)) {
							$imageUrl = "images/placeholder.png";
						}
					?>
					<article class="cart-item">
						<img class="cart-image" src="<?php echo htmlspecialchars($imageUrl); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
						<div class="cart-item-info">
							<h2><?php echo htmlspecialchars($product['name']); ?></h2>
							<p><?php echo htmlspecialchars($product['category']); ?></p>
							<strong>Rs. <?php echo htmlspecialchars($product['price']); ?></strong>
						</div>
						<div class="cart-item-actions">
							<form method="post" class="quantity-form">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<label for="quantity-<?php echo $id; ?>">Qty</label>
								<input id="quantity-<?php echo $id; ?>" type="number" name="quantity" value="<?php echo $cartQuantity; ?>" min="1" max="<?php echo intval($product['quantity']); ?>">
								<button type="submit" name="update_quantity">Update</button>
							</form>
							<strong class="line-total">Rs. <?php echo htmlspecialchars($lineTotal); ?></strong>
							<form method="post"><input type="hidden" name="id" value="<?php echo $id; ?>"><button class="remove-item" type="submit" name="remove">Remove</button></form>
						</div>
					</article>
				<?php endforeach; ?>
			</section>

			<aside class="cart-summary">
				<h2>Order summary</h2>
				<p class="summary-note">Review your items before placing the order.</p>
				<div class="summary-row"><span>Products</span><strong><?php echo count($cart); ?></strong></div>
				<div class="summary-row"><span>Total quantity</span><strong><?php echo $totalItems; ?></strong></div>
				<div class="summary-row"><span>Subtotal</span><strong>Rs. <?php echo htmlspecialchars($total); ?></strong></div>
				<div class="summary-row"><span>Delivery</span><strong class="free-delivery">FREE</strong></div>
				<div class="summary-total"><span>Order total</span><strong>Rs. <?php echo htmlspecialchars($total); ?></strong></div>
				<button class="cart-buy-button" type="button">Buy now</button>
			</aside>
		</div>
	<?php endif; ?>
</main>
</body>
</html>