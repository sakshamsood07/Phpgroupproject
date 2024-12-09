<?php

class ProductManager {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function createProduct(Product $product) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, img, price) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("ssd", $product->getName(), $product->getImg(), $product->getPrice());
        $stmt->execute();
        $stmt->close();
    }

    // READ - Single Product
    public function getProductById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $product = null;
        if ($row = $result->fetch_assoc()) {
            $product = new Product($row['name'], $row['img'], $row['price'], $row['id']);
        }

        $stmt->close();
        return $product;
    }

    // READ - All Products
    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = new Product($row['name'], $row['img'], $row['price'], $row['id']);
        }

        $stmt->close();
        return $products;
    }

    // UPDATE
    public function updateProduct(Product $product) {
        $stmt = $this->conn->prepare("UPDATE products SET name = ?, img = ?, price = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("ssdi", $product->getName(), $product->getImg(), $product->getPrice(), $product->getId());
        $stmt->execute();
        $stmt->close();
    }

    // DELETE
    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

?>
