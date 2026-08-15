<?php
include "navbar.php";
include "connection.php";
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
   <a href=""><div class="categ">ELECTRONIC</div></a>
   <a href=""><div class="categ">FASHION</div></a>
   <a href=""><div class="categ">GROCERY</div></a>
   <a href=""><div class="categ">BEAUTY & PERSONAL CARE</div></a>
   <a href=""><div class="categ">HOME AND KITCHEN</div></a>
   <a href=""><div class="categ">BOOKS</div></a>
   <a href=""><div class="categ">SPORTS</div></a>
   <a href=""><div class="categ">TOYS</div></a>
</div>

        <!-- navbar end  -->
<section class="hero-slider">
  <div class="slides">

    <a href=""><div class="slide active">
      <img src="images/home_1.png" alt="Banner 1">
    </div></a>

    <a href=""><div class="slide">
      <img src="images/home_2.png" alt="Banner 2">
    </div></a>

    <a href=""><div class="slide">
      <img src="images/home_3.png" alt="Banner 3">
    </div></a>
    
    <a href=""><div class="slide">
      <img src="images/home_4.png" alt="Banner 3">
    </div></a>

    <a href=""><div class="slide">
      <img src="images/home_5.png" alt="Banner 3">
    </div></a>

  </div>

  <button class="prev">❮</button>
  <button class="next">❯</button>
</section>

        <!-- banner end -->

<div class="products">
<?php
$ud = mysqli_query($con, "SELECT * FROM add_product ORDER BY uid DESC");

while ($row = mysqli_fetch_assoc($ud)) {
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
<div class="product-card">
  <div class="product-img">
    <img src="<?php echo $imgUrl; ?>" alt="<?php echo htmlspecialchars($row['name'] ?? 'Product'); ?>">
  </div>

  <div class="product-details">
    <h3><?php echo htmlspecialchars($row['name'] ?? ''); ?></h3>

    <p class="price">₹<?php echo htmlspecialchars($row['price'] ?? '0'); ?></p>

    <p class="offer">20% Off</p>
  </div>
</div>
<?php } ?>
</div>


<script src="index.js"></script>
</body>
</html>