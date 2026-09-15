<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="navbar">

        <a href="index.php" target="_parent"><div class="box h">
            <img src="images/logo.png" alt="logo" class="logo">
        </div></a>

        <!-- logo -->

        <div class="search">
            <input type="text" placeholder="Search by ApnaMart">
            <button class="button"><i class="fa-solid fa-magnifying-glass"></i></button>

        </div>

        <!-- search box -->
 
        <a href="accounts.php" target="_parent">
        <div class="box login h">
            <div><p>Account</p>
            <p>&List</p></div>
        </div></a>

        <!-- login -->

        <a href="orders.php"><div class="box h return">
            <div><p>Returns</p>
            <p>&Orders</p></div>
        </div></a>

        <!-- returns and orders -->

        <a href="cart.php"><div class="box cart h">
            <i class="fa-solid fa-cart-arrow-down"></i>
            <p>Cart</p>
        </div></a>

        <!-- cart -->

    </div>

<!-- navbar end -->

</body>
</html>