<?php
class User{
    private $id = '';
// Public property
public $username = '';

// Private properties
private $email = '';
private $phno = '';
private $password = '';

// Constructor to initialize all properties
public function __construct($username, $email, $phno, $password, $id = null) {
    if ($id) {
        $this->id = $id; // Internal usage for ID
    }
    $this->username = $username;
    $this->setEmail($email);
    $this->setPhno($phno);
    if ($id) {
        $this->password = $password;
    } else {
        $this->setPassword($password);
    }
}

// Getter for username
public function getUsername() {
    return $this->username;
}

// Setter for email
public function setEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->email = $email;
    } else {
        throw new Exception("Invalid email format");
    }
}

// Getter for email
public function getEmail() {
    return $this->email;
}

// Setter for phone number
public function setPhno($phno) {
    if (preg_match('/^\+?[0-9]{10,15}$/', $phno)) {
        $this->phno = $phno;
    } else {
        throw new Exception("Invalid phone number format");
    }
}

// Getter for phone number
public function getPhno() {
    return $this->phno;
}

public function getPassword() {
    return $this->password; // Add getter method for password
}


// Setter for password
public function setPassword($password) {
    if (strlen($password) >= 8) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        throw new Exception("Password must be at least 8 characters long");
    }
}

// Method to verify password
public function verifyPassword($password) {
    return password_verify($password, $this->password);
}

// Getter for ID (read-only)
public function getId() {
    return $this->id;
}

// Method to retrieve user by username or email
public static function getByUsernameOrEmail($usernameOrEmail, $dbConnection) {
    $stmt = $dbConnection->prepare("SELECT * FROM `user` WHERE username = ?");
    $stmt->bind_param("s", $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $user = new User($userData['username'], $userData['email'], $userData['phno'], $userData['password'], $userData['id']);
        return $user;
    }

    return null;
}

}
?>