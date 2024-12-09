<?php
include('header.php');  // Including header.php

// Start session to display any messages
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check if there's a message in session and display it
if (isset($_SESSION['cart_message'])) {
    echo "<div class='alert alert-info' role='alert'>{$_SESSION['cart_message']}</div>";
    unset($_SESSION['cart_message']); // Clear the message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop</title>
  <link rel="stylesheet" href="../assets/style.css" type="text/css">
  <!-- Add Bootstrap CSS link (if not already included in header.php) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <h1 class="my-3 text-center" id="pro">Products</h1>
    </div>

    <div class="row">
      <!-- Sidebar for Filters -->
      <aside class="col-md-3 mb-4">
        <form action="shop.php" method="GET" class="mb-6">
          <div class="row justify-content-center">
            <!-- Min Price Input -->
            <div class="col-md-12 mb-3">
              <label for="min_price" class="form-label">Min Price</label>
              <input type="number" name="min_price" id="min_price" class="form-control" placeholder="Min Price" value="<?php echo isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : ''; ?>">
            </div>

            <!-- Max Price Input -->
            <div class="col-md-12 mb-3">
              <label for="max_price" class="form-label">Max Price</label>
              <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Max Price" value="<?php echo isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : ''; ?>">
            </div>

            <!-- Filter Button -->
            <div class="col-md-12 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
          </div>
        </form>
      </aside>

      <!-- Product Grid -->
      <div class="col-md-9">
        <div class="row">
          <?php
          // Include the shop API file to fetch products
          include('api/shop.php');
          
          // Get filter parameters from the form
          $filters = [
              'min_price' => isset($_GET['min_price']) ? $_GET['min_price'] : '',
              'max_price' => isset($_GET['max_price']) ? $_GET['max_price'] : ''
          ];
          
          // Fetch filtered products
          $products = $shop->getFilteredProducts($filters);

          // Loop through the fetched products
          foreach ($products as $product) {
            echo " 
            <div class='col-md-4 col-lg-3 mb-3'>
              <form action='api/cart.php' method='POST'>
              
                  <img src='../admin/product/". htmlspecialchars($product->getImg(), ENT_QUOTES) ."' class='product-img'>
                  <div class='card-body'>
                    <h5 class='card-title fw-bold'>".htmlspecialchars($product->getName(), ENT_QUOTES)."</h5>
                    <p class='card-text fs-3 fw-bold'>$".number_format($product->getPrice(), 2)."</p>
                    <input type='hidden' name='name' value='".htmlspecialchars($product->getName(), ENT_QUOTES)."' />
                    <input type='hidden' name='price' value='".number_format($product->getPrice(), 2)."' />
                    <input type='number' name='quantity' value='1' min='1' max='20' placeholder='Quantity' class='form-control mb-2' />
                    <input type='submit' name='addCart' class='btn-cart  w-100' value='Add to Cart' />
                  </div>
                
              </form>
            </div>
            ";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
 include('footer.php'); 
 ?>

   <!-- Bootstrap JS & Popper.js -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-qAiK5MxQz+sbMwPBA8hliofReiGr5XW+2YrJm2n4Gx+hxJsiMl5M6TEWKHbL9j7j"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-wAq8m2+QbCq+MkKlCVHqYTBHCDlJzppEMBgcgnqwRnIte+znp91NOnhMh6oX+gkN"
        crossorigin="anonymous"></script>  



</body>

</html>
