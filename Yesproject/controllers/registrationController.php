<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/UserModel.php";

$name = "";
$email = "";
$password = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } else {
        $database = new Database();
        $conn = $database->connection();

        $userModel = new UserModel($conn);

        if ($userModel->emailExists($email)) {
            $error = "Email already exists.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($userModel->register($name, $email, $password_hash)) {
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