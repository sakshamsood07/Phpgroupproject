<?php

class Product {
    // Private properties
    private $id = '';
    private $name = '';
    private $img = '';
    private $price = 0.0;

    // Constructor to initialize all properties
    public function __construct($name, $img, $price, $id = null) {
        if ($id) {
            $this->id = $id; // Internal usage for ID
        }
        $this->setName($name);
        $this->setImg($img);
        $this->setPrice($price);
    }

    // Getter for ID (read-only)
    public function getId() {
        return $this->id;
    }

    // Setter for name
    public function setName($name) {
        if (!empty($name) && is_string($name)) {
            $this->name = $name;
        } else {
            throw new Exception("Invalid product name");
        }
    }

    // Getter for name
    public function getName() {
        return $this->name;
    }

    // Setter for image
    public function setImg($img) {
        $this->img = $img;
    }

    // Getter for image
    public function getImg() {
        return $this->img;
    }

    // Setter for price
    public function setPrice($price) {
        if (is_numeric($price) && $price >= 0) {
            $this->price = $price;
        } else {
            throw new Exception("Invalid price");
        }
    }

    // Getter for price
    public function getPrice() {
        return $this->price;
    }
}

?>
