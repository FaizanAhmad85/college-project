<?php
include "navbar.php";
include "connection.php";
$selectedCategory = trim($_GET['category'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="cate">
  <a class="categ" href="index.php">ALL</a>
  <a class="categ" href="index.php?category=ELECTRONIC">ELECTRONIC</a>
  <a class="categ" href="index.php?category=FASHION">FASHION</a>
  <a class="categ" href="index.php?category=GROCERY">GROCERY</a>
  <a class="categ" href="index.php?category=BEAUTY%20%26%20PERSONAL%20CARE">BEAUTY &amp; PERSONAL CARE</a>
  <a class="categ" href="index.php?category=HOME%20AND%20KITCHEN">HOME AND KITCHEN</a>
  <a class="categ" href="index.php?category=BOOKS">BOOKS</a>
  <a class="categ" href="index.php?category=SPORTS">SPORTS</a>
  <a class="categ" href="index.php?category=TOYS">TOYS</a>
</div>

        <!-- navbar end  -->
<section class="hero-slider<?php echo $selectedCategory !== '' ? ' category-view' : ''; ?>">
  <div class="slides">

    <div class="slide active">
      <a href="index.php?category=GROCERY">
      <img src="images/home_1.png" alt="Banner 1">
      </a>
    </div>

    <div class="slide">
      <a href="index.php?category=ELECTRONIC">
      <img src="images/home_2.png" alt="Banner 2">
      </a>
    </div>

    <div class="slide">
      <a href="index.php?category=FASHION">
      <img src="images/home_3.png" alt="Banner 3">
      </a>
    </div>
    
    <div class="slide">
      <a href="index.php?category=HOME%20AND%20KITCHEN">
      <img src="images/home_4.png" alt="Banner 3">
      </a>
    </div>

    <div class="slide">
      <img src="images/home_5.png" alt="Banner 3">
    </div>

  </div>

  <button class="prev">❮</button>
  <button class="next">❯</button>
</section>

        <!-- banner end -->

<div class="products">
<?php
$categoryFilter = $selectedCategory !== ''
  ? " WHERE LOWER(TRIM(category)) = LOWER('" . mysqli_real_escape_string($con, $selectedCategory) . "')"
  : '';
$ud = mysqli_query($con, "SELECT * FROM add_product$categoryFilter ORDER BY uid DESC");
$hasProducts = false;

while ($row = mysqli_fetch_assoc($ud)) {
  $hasProducts = true;
  $imgFile = '';
  if (!empty($row['image_path'])) {
    $imgFile = $row['image_path'];
  } elseif (!empty($row['image'])) {
    $imgFile = $row['image'];
  }
  $serverPath = __DIR__ . '/../admin/product_img/' . $imgFile;
  $imgUrl = '../admin/product_img/' . rawurlencode($imgFile);
  if (empty($imgFile) || !file_exists($serverPath)) {
    $imgUrl = 'images/placeholder.png';
  }
?>
<a class="product-card" href="view_products.php?id=<?php echo intval($row['uid']); ?>">
  <div class="product-img">
    <img src="<?php echo $imgUrl; ?>" alt="<?php echo htmlspecialchars($row['name'] ?? 'Product'); ?>">
  </div>

  <div class="product-details">
    <h3><?php echo htmlspecialchars($row['name'] ?? ''); ?></h3>

    <p class="price">₹<?php echo htmlspecialchars($row['price'] ?? '0'); ?></p>

    <p class="offer">20% Off</p>
  </div>
</a>
<?php } ?>
<?php if (!$hasProducts): ?>
  <p class="no-products">No products found in this category.</p>
<?php endif; ?>
</div>

<?php include "footer.php"; ?>

<script src="index.js"></script>
</body>
</html>