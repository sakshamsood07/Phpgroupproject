<?php

class Admin {
    // Private properties
    private $id = '';
    private $username = '';
    private $password = '';

    // Constructor to initialize all properties
    public function __construct($username, $password, $id = null) {
        if ($id) {
            $this->id = $id; // Internal usage for ID
        }
        $this->setUsername($username);
        $this->setPassword($password);
    }

    // Getter for ID (read-only)
    public function getId() {
        return $this->id;
    }

    // Setter for username
    public function setUsername($username) {
        if (!empty($username) && is_string($username)) {
            $this->username = $username;
        } else {
            throw new Exception("Invalid username");
        }
    }

    // Getter for username
    public function getUsername() {
        return $this->username;
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

    
}

?>
