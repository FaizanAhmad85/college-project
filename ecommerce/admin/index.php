<?php
session_start();
include "connection.php";

if (empty($_SESSION['admin_user'])) {
    header('Location: admin_login.php');
    exit;
}

function dashboardCount($con, $table) {
    $result = mysqli_query($con, "SELECT COUNT(*) AS total FROM $table");
    $row = $result ? mysqli_fetch_assoc($result) : null;
    return (int) ($row['total'] ?? 0);
}

$productCount = dashboardCount($con, 'add_product');
$userCount = dashboardCount($con, 'create_account');
$adminCount = dashboardCount($con, 'admin_account');
$lowStockResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM add_product WHERE quantity <= 5");
$lowStockRow = $lowStockResult ? mysqli_fetch_assoc($lowStockResult) : null;
$lowStockCount = (int) ($lowStockRow['total'] ?? 0);
$recentProducts = mysqli_query($con, "SELECT name, category, price, quantity FROM add_product ORDER BY uid DESC LIMIT 5");

include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<main class="dashboard">
    <section class="welcome">
        <div>
            <p class="eyebrow">CONTROL CENTER</p>
            <h1>Welcome back, Admin</h1>
            <p class="subtitle">Keep your store organized and moving.</p>
        </div>
        <a class="primary-action" href="add_product.php"><i class="fa-solid fa-plus"></i> Add product</a>
    </section>

    <section class="stats" aria-label="Store overview">
        <a class="stat-card orange" href="product_list.php">
            <span class="stat-icon"><i class="fa-solid fa-box-open"></i></span>
            <span class="stat-label">Total products</span>
            <strong><?php echo $productCount; ?></strong>
            <span class="stat-link">View product list <i class="fa-solid fa-arrow-right"></i></span>
        </a>
        <a class="stat-card green" href="user_data.php">
            <span class="stat-icon"><i class="fa-solid fa-users"></i></span>
            <span class="stat-label">Registered users</span>
            <strong><?php echo $userCount; ?></strong>
            <span class="stat-link">View users <i class="fa-solid fa-arrow-right"></i></span>
        </a>
        <a class="stat-card blue" href="admin_data.php">
            <span class="stat-icon"><i class="fa-solid fa-user-shield"></i></span>
            <span class="stat-label">Admin accounts</span>
            <strong><?php echo $adminCount; ?></strong>
            <span class="stat-link">Manage admins <i class="fa-solid fa-arrow-right"></i></span>
        </a>
        <a class="stat-card red" href="product_list.php">
            <span class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
            <span class="stat-label">Low stock items</span>
            <strong><?php echo $lowStockCount; ?></strong>
            <span class="stat-link">Check inventory <i class="fa-solid fa-arrow-right"></i></span>
        </a>
    </section>

    <section class="content-grid">
        <div class="panel">
            <div class="panel-heading">
                <div>
                    <p class="eyebrow">INVENTORY</p>
                    <h2>Recently added products</h2>
                </div>
                <a href="product_list.php">See all</a>
            </div>
            <?php if ($recentProducts && mysqli_num_rows($recentProducts) > 0): ?>
                <div class="product-list">
                    <?php while ($product = mysqli_fetch_assoc($recentProducts)): ?>
                        <div class="product-row">
                            <span class="product-mark"><i class="fa-solid fa-cube"></i></span>
                            <span class="product-info">
                                <strong><?php echo htmlspecialchars($product['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>
                                <small><?php echo htmlspecialchars($product['category'] ?? 'Uncategorized', ENT_QUOTES, 'UTF-8'); ?></small>
                            </span>
                            <span class="product-price">Rs. <?php echo htmlspecialchars($product['price'] ?? '0', ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="stock <?php echo ((int) $product['quantity'] <= 5) ? 'warning' : ''; ?>"><?php echo (int) $product['quantity']; ?> left</span>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="empty-state">No products have been added yet.</p>
            <?php endif; ?>
        </div>

        <aside class="panel actions-panel">
            <p class="eyebrow">SHORTCUTS</p>
            <h2>Quick actions</h2>
            <a class="quick-action" href="add_product.php"><i class="fa-solid fa-circle-plus"></i><span>Add a new product</span><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            <a class="quick-action" href="user_data.php"><i class="fa-solid fa-user-group"></i><span>Review users</span><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            <a class="quick-action" href="admin_data.php"><i class="fa-solid fa-user-gear"></i><span>Manage admins</span><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        </aside>
    </section>
</main>
<?php include "footer.php"; ?>
</body>
</html>