<?php
// Include the config file for DB connection
require_once '../db.php';

class ShopAPI
{
    private $dbConnection;

    public function __construct($host, $user, $password, $dbName)
    {
        $db = new Database($host, $user, $password, $dbName);
        $this->dbConnection = $db->getConnection();
    }

    // Fetch all products with optional filters
    // ShopAPI class method to get products based on price range
public function getFilteredProducts($filters)
{
    try {
        $sql = "SELECT * FROM `products` WHERE 1=1";
        
        // Apply price range filter if set
        if (!empty($filters['min_price'])) {
            $sql .= " AND price >= " . (int)$filters['min_price'];
        }
        if (!empty($filters['max_price'])) {
            $sql .= " AND price <= " . (int)$filters['max_price'];
        }

        // Execute the query
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = new Product($row['name'], $row['img'], $row['price'], $row['id']);
        }

        $stmt->close();
        return $products;
    } catch (Exception $e) {
        echo "Error fetching products: " . $e->getMessage();
        return [];
    }
}
}

$shop = new ShopAPI('localhost', 'root', '', 'speakers');
?>
