<?php
// Include the config file for DB connection
require_once '../../db.php';



class CartAPI
{

    // Constructor to initialize the database connection
    public function __construct() {
    }

    // Add product to the cart
    public function addToCart($productName, $productPrice, $quantity)
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            return ['error_code' => 1, 'message' => 'Please log in to add products to your cart'];
        }

        // Initialize cart if not set
        if (!isset($_SESSION['Cart'])) {
            $_SESSION['Cart'] = [];
        }

        // Check if the product is already in the cart
        $check_product = array_column($_SESSION['Cart'], 'productname');
        if (in_array($productName, $check_product)) {
            return ['error_code' => 2, 'message' => 'Product already added to cart'];
        }

        // Add product to cart
        $_SESSION['Cart'][] = [
            'productname' => $productName,
            'productprice' => $productPrice,
            'productquantity' => $quantity
        ];
        return ['error_code' => 0, 'message' => 'Product added to cart'];
    }

    // Remove product from the cart
    public function removeFromCart($productName)
    {
        // Check if user is logged in and cart is set
        if (!isset($_SESSION['user']) || !isset($_SESSION['Cart'])) {
            return ['error_code' => 3, 'message' => 'Cart is empty or you are not logged in'];
        }

        foreach ($_SESSION['Cart'] as $key => $value) {
            if ($value['productname'] === $productName) {
                unset($_SESSION['Cart'][$key]);
                $_SESSION['Cart'] = array_values($_SESSION['Cart']);
                return ['error_code' => 0, 'message' => 'Product removed from cart'];
            }
        }
        return ['error_code' => 4, 'message' => 'Product not found in cart'];
    }

    // Update the quantity of a product in the cart
    public function updateCart($productName, $newQuantity)
    {
        // Check if user is logged in and cart is set
        if (!isset($_SESSION['user']) || !isset($_SESSION['Cart'])) {
            return ['error_code' => 3, 'message' => 'Cart is empty or you are not logged in'];
        }

        foreach ($_SESSION['Cart'] as $key => $value) {
            if ($value['productname'] === $productName) {
                $_SESSION['Cart'][$key]['productquantity'] = $newQuantity;
                return ['error_code' => 0, 'message' => 'Product quantity updated'];
            }
        }
        return ['error_code' => 4, 'message' => 'Product not found in cart'];
    }
}

// Handle form submission for adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    if (isset($_SESSION['user'])) {
        $cartAPI = new CartAPI();  // Change database credentials accordingly

        $response = [];

        // Add to Cart
        if (isset($_POST['addCart'])) {
            $productName = htmlspecialchars($_POST['name']);
            $productPrice = htmlspecialchars($_POST['price']);
            $quantity = (int)$_POST['quantity']; // Ensure quantity is an integer

            $response = $cartAPI->addToCart($productName, $productPrice, $quantity);
        }

        // Remove product from Cart
        if (isset($_POST['remove'])) {
            $productName = htmlspecialchars($_POST['item']);
            $response = $cartAPI->removeFromCart($productName);
        }

        // Update Cart
        if (isset($_POST['update'])) {
            $productName = htmlspecialchars($_POST['item']);
            $newQuantity = (int)$_POST['quantity']; // Ensure quantity is an integer
            $response = $cartAPI->updateCart($productName, $newQuantity);
        }

        // Return response
        echo "<script>alert('{$response['message']}'); window.location.href = '../Viewcart.php';</script>";
    } else {
        header("Location: ../form/login.php"); // Redirect to login if not logged in
    }
}
?>
