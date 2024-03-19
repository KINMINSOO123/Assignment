<!DOCTYPE html>
<html>
  <head>
    <title>Tay badminton_club Shopping</title>
<?php 
include("product.php");
session_start(); // Add this line to start the session
if(!isset($_SESSION['valid'])){
  header("Location: login.php");
}
?>
    <!-- This code is needed for responsive design to work.
      (Responsive design = make the website look good on
      smaller screen sizes like a phone or a tablet). -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Load a font called Roboto from Google Fonts. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Here are the CSS files for this page. -->
    <link rel="stylesheet" href="style/shared/general.css">
    <link rel="stylesheet" href="style/shared/amazon-header.css">
    <link rel="stylesheet" href="style/pages/amazon.css">
  </head>
  <body>
    <div class="amazon-header">
      <div class="amazon-header-left-section">
        <a href="home.php" class="header-link">
          <img class="shopping-logo"
            src="image/icons/badminton_club_logo.png" width="120" height="90">
        </a>
        
      </div>

      <div class="amazon-header-middle-section">
        <input class="search-bar" type="text" placeholder="Search">

        <button class="search-button">
          <img class="search-icon" src="image/icons/search-icon.png">
        </button>
      </div>

      <div class="amazon-header-right-section">
        <a class="orders-link header-link" href="orders.html">
          <span class="returns-text">Returns</span>
          <span class="orders-text">& Orders</span>
        </a>

        <a class="cart-link header-link" href="checkout.html">
          <img class="cart-icon" src="image/icons/cart-icon.png">
          <div class="cart-quantity js-cart-quantity">0</div>
          <div class="cart-text">Cart</div>
        </a>
      </div>
    </div> 
    
    <div class="main">
      <div class="products-grid js-products-grid">
        <?php foreach($products as $product) { ?>
                <div class="product-container">
                  <div class="product-image-container">
                    <img class="product-image"
                      src="<?php echo $product['image'];?>">
                  </div>

                  <div class="product-name limit-text-to-2-lines">
                    <?php echo $product['name']; ?>
                  </div>

                  <div class="product-rating-container">
                    <img class="product-rating-stars"
                        src="image/ratings/rating-<?php echo $product['rating']['stars'] * 10;?>.png">
                    <div class="product-rating-count link-primary">
                      <?php echo $product['rating']['count'];?> 
                    </div>
                  </div>

                  <div class="product-price">
                    $<?php echo $product['priceCents'] / 100;?>
                  </div>

                  <div class="product-quantity-container">
                    <select>
                      <option selected value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                  </div>

                  <div class="product-spacer"></div>

                  <div class="added-to-cart">
                    <img src="image/icons/checkmark.png">
                    Added
                  </div>

                  <button class="add-to-cart-button button-primary">
                    Add to Cart
                  </button>
                </div>
                <?php } ?>
      </div>
    </div>
  </body>
</html>