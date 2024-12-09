<?php
session_start();
include 'header.php';
// Initialize variables
$errors = [];
$name = $email = $address = $phone = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate Name
    if (empty($_POST['name'])) {
        $errors['name'] = "Name is required.";
    } else {
        $name = htmlspecialchars(trim($_POST['name']));
    }

    // Validate Email
    if (empty($_POST['email'])) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));
    }

    // Validate Address
    if (empty($_POST['address'])) {
        $errors['address'] = "Address is required.";
    } else {
        $address = htmlspecialchars(trim($_POST['address']));
    }

    // Validate Phone
    if (empty($_POST['phone'])) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $_POST['phone'])) {
        $errors['phone'] = "Phone number must be 10 digits.";
    } else {
        $phone = htmlspecialchars(trim($_POST['phone']));
    }

    // If no errors, process checkout
    if (empty($errors)) {
        $_SESSION['checkout_data'] = ['name' => $name, 'email' => $email, 'address' => $address, 'phone' => $phone];
        header("Location: invoice.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/style.css" type="text/css">
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
                <small><?php echo $errors['name'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">
                <small><?php echo $errors['email'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" id="address"><?php echo htmlspecialchars($address); ?></textarea>
                <small><?php echo $errors['address'] ?? ''; ?></small>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>">
                <small><?php echo $errors['phone'] ?? ''; ?></small>
            </div>
            <button type="submit" class="btn-submit">Place Order</button>
        </form>
    </div>
</body>
</html>
