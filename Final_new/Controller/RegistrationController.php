<?php
include "../Model/db.php";
session_start();

$datafile = "../data.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    if (!empty($username) && strlen($username) >= 5 && strlen($password) >= 4) {

        $database = new db();
        $connection = $database->connection();

        // users = table name
        $result = $database->signup($connection, "users", $username, $password);

        if ($result) {

            // Save registration data into data.json
            $formdata = array(
                "type" => "registration",
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

            header("Location: ../View/Login.php");
            exit();

        } else {
            echo "Registration failed. Please try again.";
        }

    } else {
        echo "Username must be at least 5 characters and password must be at least 4 characters.";
    }
}
?>
