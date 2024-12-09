<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../../db.php';

class SignupAPI
{
    private $dbConnection;

    public function __construct($host, $user, $password, $dbName)
    {
        $db = new Database($host, $user, $password, $dbName);
        $this->dbConnection = $db->getConnection();
    }

    /**
     * Sign up the user after validation.
     */
    public function signUp($user)
    {
        try {
            // Check for existing email
            $stmt = $this->dbConnection->prepare("SELECT * FROM `user` WHERE email = ?");
            $email = $user->getEmail();  // Assign to a variable
            $stmt->bind_param("s",  $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Redirect with error code for existing email
                header("Location: ../form/signup.php?errorcode=1");
                exit;
            }

            // Check for existing username
            $stmt = $this->dbConnection->prepare("SELECT * FROM `user` WHERE username = ?");
            $stmt->bind_param("s", $user->username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Redirect with error code for existing username
                header("Location: ../form/signup.php?errorcode=2");
                exit;
            }

            // Insert new user into the database
            $stmt = $this->dbConnection->prepare("INSERT INTO `user` (username, email, phno, password) VALUES (?, ?, ?, ?)");
            $password = $user->getPassword();  // Assign to a variable
            $phno = $user->getPhno();  // Assign to a variable
            $stmt->bind_param("ssss", $user->username, $email, $phno, $password);
            $stmt->execute();

            // Redirect to login page after successful signup
            header("Location: ../form/login.php");
            exit;

        } catch (Exception $e) {
            // Redirect with error code for unknown error
            header("Location: ../form/signup.php?errorcode=5");
            exit;
        }
    }
}

// Initialize API
$api = new SignupAPI('localhost', 'root', '', 'speakers');

// Check for POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user data from POST request
    $data = (object)$_POST;

    // Validate input data
    if (isset($data->username, $data->email, $data->phno, $data->password)) {
        try {
            // Create a User object
            $user = new User($data->username, $data->email, $data->phno, $data->password);
            // Call the signUp method
            $api->signUp($user);
        } catch (Exception $e) {
            // Redirect with error code for caught exceptions
            header("Location: ../form/signup.php?errorcode=4");
            exit;
        }
    } else {
        // Redirect with error code for missing fields
        header("Location: ../form/signup.php?errorcode=3");
        exit;
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}
