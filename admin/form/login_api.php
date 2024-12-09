<?php
// Enable CORS (if required)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../../db.php';

class LoginHandler
{
    private $dbConnection;

    public function __construct($host, $user, $password, $dbName)
    {
        $db = new Database($host, $user, $password, $dbName);
        $this->dbConnection = $db->getConnection();
    }

    public function login($username, $password)
    {
        try {
            // Sanitize inputs
            $username = htmlspecialchars($username, ENT_QUOTES);
            $password = htmlspecialchars($password, ENT_QUOTES);

            // Query to check user credentials
            $query = "SELECT * FROM `admin` WHERE Uname = ? AND Upwd = ?";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Start session
                session_start();
                $_SESSION['admin'] = $username;

                echo json_encode([
                    'success' => true,
                    'message' => 'Login successful',
                    'username' => $adminName,
                    'redirect' => '../OurStore.php'
                ]);
                // Redirect on success
                header("Location: ../OurStore.php");
                exit;
            } else {
                // Invalid credentials
                http_response_code(401);
                echo json_encode(['error' => 'Invalid username or password']);
            }

            $stmt->close();
        } catch (Exception $e) {
            // Handle exceptions
            http_response_code(500);
            echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
        }
    }
}

// Main execution
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode input JSON or read POST data
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (isset($_POST['Uname']) && isset($_POST['Upwd'])) {
        $username = $_POST['Uname'];
        $password = $_POST['Upwd'];

        // Instantiate LoginHandler and process login
        $loginHandler = new LoginHandler('localhost', 'root', '', 'speakers');
        $loginHandler->login($username, $password);
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Missing required parameters: Uname and Upwd.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method. Use POST.']);
}
?>
