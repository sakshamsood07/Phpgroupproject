<?php
session_start();

require_once '../../db.php';

class LoginAPI {
    private $dbConnection;

    // Constructor to initialize database connection and user input
    public function __construct($host, $user, $password, $dbName) {
        $db = new Database($host, $user, $password, $dbName);
        $this->dbConnection = $db->getConnection();
    }

    // Method to validate user login
    public function validateUser($username, $password) {
        $user = User::getByUsernameOrEmail($username, $this->dbConnection);

        if ($user) {
            // Check if the password is correct
            if ($user->verifyPassword($password)) {
                // Login successful, set session
                $_SESSION['user'] = $user->username;
                header("Location: ../index.php");
                exit();
            } else {
                // Password is incorrect
                header("Location: ../form/login.php?error=incorrect_password");
                exit();
            }
        } else {
            // No user found
            header("Location: ../form/login.php?error=no_user_found");
            exit();
        }
    }

    // Close the database connection
    public function closeConnection() {
        $this->dbConnection->close();
    }
}

// Initialize API
$api = new LoginAPI('localhost', 'root', '', 'speakers');

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Validate user
        $api->validateUser($_POST['username'], $_POST['password']);
        
        // Close the connection
        $login->closeConnection();
    } else {
        header("Location: login.php?error=missing_fields");
        exit();
    }
}
?>
