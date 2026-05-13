<?php
include "../Model/db.php";
session_start();

$datafile = "../data.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty($username) && !empty($password)) {

        $database = new db();
        $connection = $database->connection();

        // users = table name
        $result = $database->signup($connection, "users", $username, $password);

        if ($result && $result->num_rows > 0) {

            $_SESSION["username"] = $username;
            setcookie("username", $username, time() + 3600, "/");

            // Save login data into data.json
            $formdata = array(
                "username" => $username,
                "password" => $password
            );

            if (file_exists($datafile)) {
                $existdata = file_get_contents($datafile);
                $tempdata = json_decode($existdata, true);
            } else {
                $tempdata = array();
            }

            if (!is_array($tempdata)) {
                $tempdata = array();
            }

            $tempdata[] = $formdata;

            $jsondata = json_encode($tempdata, JSON_PRETTY_PRINT);

            file_put_contents($datafile, $jsondata);

            header("Location: ../View/Home.php");
            exit();

        } else {
            echo "Invalid username or password.";
        }

    } else {
        echo "Please enter username and password.";
    }
}
?>