<?php

class db
{
    function connection()
    {
        // Database name = users
        $conn = new mysqli("localhost", "root", "", "users");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function signup($conn, $table, $username, $password)
    {
        // Table columns = username, password
        $sql = "INSERT INTO $table (username, password) 
                VALUES ('$username', '$password')";

        return $conn->query($sql);
    }

    function login($conn, $table, $username, $password)
    {
        // Table columns = username, password
        $sql = "SELECT * FROM $table 
                WHERE username='$username' AND password='$password'";

        return $conn->query($sql);
    }
}

?>