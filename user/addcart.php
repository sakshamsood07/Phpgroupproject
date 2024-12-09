<?php
session_start();

if(isset($_SESSION['user'])){

if (!isset($_SESSION['Cart'])) {
    $_SESSION['Cart'] = []; // Initialize cart as an empty array
}

if (isset($_POST['addCart'])) {
    $product_name = $_POST['Pname'];
    $product_price = $_POST['Pprice'];
    $product_quantity = $_POST['Pquantity'];

    // Check if the product is already in the cart
    $check_product = array_column($_SESSION['Cart'], 'productname');
    if (in_array($product_name, $check_product)) {
        echo "
        <script>
            alert('Product already added to cart');
            window.location.href = 'shop.php';
        </script>";
    } else {
        // Add product to cart
        $_SESSION['Cart'][] = [
            'productname' => $product_name,
            'productprice' => $product_price,
            'productquantity' => $product_quantity
        ];
        header("Location: Viewcart.php");
    }
}

// Remove product
if (isset($_POST['remove'])) {
    if (isset($_SESSION['Cart']) && is_array($_SESSION['Cart'])) {
        foreach ($_SESSION['Cart'] as $key => $value) {
            if (is_array($value) && isset($value['productname']) && $value['productname'] === $_POST['item']) {
                unset($_SESSION['Cart'][$key]);
                // Reindex the array to maintain numeric keys
                $_SESSION['Cart'] = array_values($_SESSION['Cart']);
                header("Location: Viewcart.php");
                exit(); // Stop further execution
            }
        }
    }
}

// Update product
if (isset($_POST['update'])) {
    if (isset($_SESSION['Cart']) && is_array($_SESSION['Cart'])) {
        foreach ($_SESSION['Cart'] as $key => $value) {
            if (is_array($value) && isset($value['productname']) && $value['productname'] === $_POST['item']) {
                // Update the product details
                $_SESSION['Cart'][$key] = [
                    'productname' => $_POST['Pname'],
                    'productprice' => $_POST['Pprice'],
                    'productquantity' => $_POST['Pquantity']
                ];
                header("Location: Viewcart.php");
                exit(); // Stop further execution after updating
            }
        }
    }
}
}
else{
    header("Location: form/login.php");
}

?>
