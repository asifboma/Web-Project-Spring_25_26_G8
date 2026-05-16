<?php

class UserModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

   public function registerUser($name,$email,$password){
        $sql = "INSERT INTO users(name,email,password_hash) VALUES('$name','$email','$password')";
        return $this->connection->query($sql);
    }

    // Check email exists
    public function checkEmail($email){
        $sql = "SELECT id FROM users WHERE email='$email'";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0;
    }

    // Login
    public function login($email){
        $sql = "SELECT * FROM users WHERE email='$email'";
        return $this->connection->query($sql);
    }

    // Get user by ID
    public function getUser($id){
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }
}
?>