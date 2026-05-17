<?php
include __DIR__ . "/../config/db.php";
include __DIR__ . "/../models/UserModel.php";
session_start();

$name = "";
$email = "";
$password = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } else {
        $database = new Database();
        $connection = $database->connection();

        $userModel = new UserModel($connection);

        if ($userModel->checkEmail($email)) {
            $error = "Email already exists.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($userModel->registerUser($name, $email, $password_hash)) {
                $success = "Registration successful. You can login now.";
                $name = "";
                $email = "";
            } else {
                $error = "Registration failed.";
            }
        }
    }
}
?>