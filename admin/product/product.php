<?php
// Include required files
require_once '../../db.php';
require_once 'product_manager.php';

// Establish database connection
$db = new Database('localhost', 'root', '', 'speakers');
$conn = $db->getConnection();
$productManager = new ProductManager($conn);

// Initialize variables for error messages
$nameError = $priceError = $imageError = "";

// Handle Form Submissions (CRUD Operations)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Sanitize input
        $name = htmlspecialchars($_POST['Pname'], ENT_QUOTES);
        $price = floatval($_POST['Pprice']);
        $isValid = true;

        // Validate Product Name
        if (empty($name)) {
            $nameError = "Product name is required.";
            $isValid = false;
        } elseif (strlen($name) < 3) {
            $nameError = "Product name must be at least 3 characters long.";
            $isValid = false;
        }

        // Validate Price
        if (empty($_POST['Pprice'])) {
            $priceError = "Product price is required.";
            $isValid = false;
        } elseif (!is_numeric($_POST['Pprice']) || $price <= 0) {
            $priceError = "Enter a valid positive price.";
            $isValid = false;
        }

        // Validate Image Upload
        $imagePath = '';
        if (isset($_FILES['Pimg']['name']) && $_FILES['Pimg']['name'] !== '') {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES['Pimg']['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                $imageError = "Only JPG, JPEG, PNG, and GIF files are allowed.";
                $isValid = false;
            } else {
                $imagePath = 'Uploadimage/' . basename($_FILES['Pimg']['name']);
                move_uploaded_file($_FILES['Pimg']['tmp_name'], $imagePath);
            }
        }

        // Proceed if all inputs are valid
        if ($isValid) {
            $newProduct = new Product($name, $imagePath, $price);
            $productManager->createProduct($newProduct);
            header("Location: product.php"); // Redirect to avoid resubmission
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['delete'])) {
        // Handle Delete Operation
        $id = intval($_GET['delete']);
        $productManager->deleteProduct($id);
        header("Location: product.php");
    }
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
    <title>Product Page</title>
</head>

<body>
    <div class="container">
        <div class="row">
        <div class="col-md-6 m-auto">
    <form action="product.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <p id="pdetail" class="text-center fw-bold fs-3">Product Detail</p>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Name:</label>
            <input type="text" name="Pname" class="form-control" placeholder="Enter Product Name" 
                value="<?php echo isset($_POST['Pname']) ? htmlspecialchars($_POST['Pname'], ENT_QUOTES) : ''; ?>">
            <small class="text-danger"><?php echo $nameError; ?></small>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Price:</label>
            <input type="text" name="Pprice" class="form-control" placeholder="Enter Product Price" 
                value="<?php echo isset($_POST['Pprice']) ? htmlspecialchars($_POST['Pprice'], ENT_QUOTES) : ''; ?>">
            <small class="text-danger"><?php echo $priceError; ?></small>
        </div>
        <div class="mb-3">
            <label class="form-label">Add Product Image:</label>
            <input type="file" name="Pimg" class="form-control">
            <small class="text-danger"><?php echo $imageError; ?></small>
        </div>
        <div class="d-flex justify-content-between">
            <button name="submit" class="upload">Upload</button>
            <a href="../OurStore.php" class="cancel">Cancel</a>
        </div>
    </form>
</div>

        </div>
    </div>

    <!-- Fetch and Display Data -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $products = $productManager->getAllProducts();
                        foreach ($products as $product) {
                            echo "<tr>";
                            echo "<td>" . $product->getId() . "</td>";
                            echo "<td>" . htmlspecialchars($product->getName(), ENT_QUOTES) . "</td>";
                            echo "<td>$" . number_format($product->getPrice(), 2) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($product->getImg(), ENT_QUOTES) . "' alt='Product Image' style='width: 100px;'></td>";
                            echo "<td><a href='edit_product.php?id=" . $product->getId() . "'><i class='fas fa-edit'></i></a></td>";
                            echo "<td><a href='product.php?delete=" . $product->getId() . "' onclick=\"return confirm('Are you sure you want to delete this product?');\"><i class='fas fa-trash'></i></a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
