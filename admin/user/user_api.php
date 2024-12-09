<?php

require_once '../../db.php';

class UserAPI
{
    private $dbConnection;

    public function __construct($host, $user, $password, $dbName)
    {
        $db = new Database($host, $user, $password, $dbName);
        $this->dbConnection = $db->getConnection();
    }

    /**
     * Fetch all users from the database.
     */
    public function getAllUsers()
    {
        try {
        $stmt = $this->dbConnection->prepare("SELECT * FROM user");
        
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = new User(
                $row['username'],
                $row['email'],
                $row['phno'],
                $row['password'],
                $row['id']
            );    
        }

        $stmt->close();
        return $users;
    } catch (Exception $e) {
        echo "Error fetching products: " . $e->getMessage();
        return [];
    }
    }

    /**
     * Delete a user by ID.
     */
    public function deleteUser($id)
    {
        try {
            $query = "DELETE FROM `user` WHERE id = ?";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

            $stmt->close();
        } catch (Exception $e) {
            return false;
        }
    }
}

// Initialize API
$userAPI = new UserAPI('localhost', 'root', '', 'speakers');

// Route API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $userId = $_POST['userId'];
    $result = $userAPI->deleteUser($userId);

    if ($result) {
        echo "<script>alert('User deleted successfully'); window.location.href = 'user_form.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user'); window.location.href = 'user_form.php';</script>";
    }
}
?>