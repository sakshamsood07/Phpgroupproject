<?php
include 'header.php'; // Including header.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-lg-12 text-center">
                <h1>My Cart</h1>
            </div>
        </div>

        <div class="row justify-content-around">
            <div class="col-sm-12 col-md-8 col-lg-9">
                <table class="cart-table table table-bordered">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    
    $totalAmount = 0; // Variable to store the total amount
   
    if (isset($_SESSION['Cart']) && is_array($_SESSION['Cart'])) {
        $serialNo = 1; // Initialize serial number
        foreach ($_SESSION['Cart'] as $key => $value) {
            if (is_array($value)) {
                $total = (float)$value['productprice'] * (int)$value ['productquantity'];
                $totalAmount += $total;   

                echo "
                <form action='api/cart.php' method='POST'>
                <tr>
                    <td>$serialNo</td>
                    <td><input type='hidden' name='name' value='{$value['productname']}'>{$value['productname']}</td>
                    <td><input type='hidden' name='price' value='{$value['productprice']}'>{$value['productprice']}</td>
                    <td>
                        <input type='number' name='quantity' value='{$value['productquantity']}' min='1' max='20' class='form-control'>
                    </td>
                    <td>" . number_format($total, 2) . "</td> <!-- Display total price per product -->
                    <td><button type='submit' name='update' class='btn btn-warning'>Update</button></td>
                    <td><button type='submit' name='remove' class='btn btn-danger'>Delete</button></td>
                    <td><input type='hidden' name='item' value='{$value['productname']}'></td>
                </tr>
                </form>";
                $serialNo++;
            }
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>Your cart is empty.</td></tr>";
    }
    ?>
</tbody>


                </table>

                <!-- Display total amount -->
                <div class="row">
                    <div class="col text-end">
                        <h3>Total: $<?php echo number_format($totalAmount, 2); ?></h3>
                    </div>
                </div>

                <!-- Checkout Button -->
                <div class="cart-buttons">
                    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                    <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Bootstrap JS for Modal/Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>