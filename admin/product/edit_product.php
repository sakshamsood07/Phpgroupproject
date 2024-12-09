<?php
// Include necessary files
require_once '../../db.php';
require_once './product_manager.php';

// Establish database connection
$db = new Database('localhost', 'root', '', 'speakers');
$conn = $db->getConnection();
$productManager = new ProductManager($conn);

// Fetch Product Data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $product = $productManager->getProductById($id);
    if (!$product) {
        die("Product not found");
    }
} else {
    die("No product ID provided");
}

// Update Product Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $productName = htmlspecialchars($_POST['Pname'], ENT_QUOTES);
    $productPrice = floatval($_POST['Pprice']);
    $uploadedImage = $_FILES['Pimg'];

    // Handle Image Upload
    if (!empty($uploadedImage['name'])) {
        $imagePath = 'uploads/' . basename($uploadedImage['name']);
        move_uploaded_file($uploadedImage['tmp_name'], $imagePath);
    } else {
        $imagePath = $product->getImg(); // Retain the current image if no new image is uploaded
    }

    // Update Product
    $updatedProduct = new Product($productName, $imagePath, $productPrice, $id);
    $productManager->updateProduct($updatedProduct);

    // Redirect after successful update
    header("Location: product.php?msg=Product updated successfully");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ecce431ce6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/style.css" type="text/css">
    <title>Edit Product</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto" id="contain">
                <form action="edit_product.php?id=<?= $product->getId() ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3" id="pd">
                        <p class="text-center fw-bold fs-3">Edit Product</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Name:</label>
                        <input type="text" class="form-control" name="Pname" value="<?= htmlspecialchars($product->getName(), ENT_QUOTES) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Price:</label>
                        <input type="text" class="form-control" name="Pprice" value="<?= $product->getPrice() ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Image:</label>
                        <input type="file" name="Pimg" class="form-control">
                        <br>
                        <img src="<?= htmlspecialchars($product->getImg(), ENT_QUOTES) ?>" alt="Product Image" style="height:100px; width:100px;">
                    </div>

                    <input type="hidden" name="id" value="<?= $product->getId() ?>">

                    
                    
                        <div class="d-flex justify-content-between">
                        <!-- <button type="submit" class="btn btn-primary my-3 form-control" name="edit">Update</button> -->
                        <button name="submit" class="upload" name="edit">Update</button>
                        <a href="../OurStore.php" class="cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
