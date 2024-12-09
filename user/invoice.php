<?php
session_start();
include 'header.php';
// Check if checkout data is set
if (!isset($_SESSION['checkout_data'])) {
    header("Location: checkout.php");
    exit();
}

$checkoutData = $_SESSION['checkout_data'];
$cart = $_SESSION['Cart'] ?? [
    ['productname' => 'Sample Item 1', 'productprice' => 20, 'productquantity' => 2],
    ['productname' => 'Sample Item 2', 'productprice' => 15, 'productquantity' => 1],
];
$totalAmount = 0;
unset($_SESSION['Cart']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
   <link rel="stylesheet" href="../../assets/style.css" type="text/css">
</head>

<body>
    <div class="invoice-container">
        <h1>Invoice</h1>
        <div class="customer-details">
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($checkoutData['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($checkoutData['email']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($checkoutData['address']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($checkoutData['phone']); ?></p>
        </div>

        <div class="cart-details">
            <h3>Order Summary</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $index => $item):
                        // Ensure numeric values for calculations
                        $productTotal = (float) $item['productprice'] * (int) $item['productquantity'];
                        $totalAmount += $productTotal;
                        ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($item['productname']); ?></td>
                            <td>$<?php echo number_format((float) $item['productprice'], 2); ?></td>
                            <td><?php echo (int) $item['productquantity']; ?></td>
                            <td>$<?php echo number_format($productTotal, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Grand Total</strong></td>
                        <td><strong>$<?php echo number_format($totalAmount, 2); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="thank-you">
            <h3>Thank You for Your Order!</h3>
            <a href="fpdf.php" class="btn-invoice ">Download Invoice as PDF</a>
        </div>
        
      

    </div>
   

</body>

</html>