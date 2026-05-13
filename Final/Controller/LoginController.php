<?php
include "../Model/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $password = $_POST["password"];

    if (!empty($name) && !empty($password)) {

        $database = new db();
        $connection = $database->connection();

        // users = table name
        $result = $database->login($connection, "users", $username, $password);

        if ($result && $result->num_rows > 0) {

            $_SESSION["name"] = $name;
            setcookie("name", $name, time() + 3600, "/");

            header("Location: ../View/Dashboard.php");
            exit();

        } else {
            echo "Invalid username or password.";
        }

    } else {
        echo "Please enter username and password.";
    }
}
?>