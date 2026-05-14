<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "web_project_spring_25_26_g8";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
