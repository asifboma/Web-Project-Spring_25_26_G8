<?php

class Database {
    function connection()
    {
        $db_host = "127.0.0.1";
        $db_user = "root";
        $db_password = "";
        $db_name = "project8_db";

        $connection = new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_name,
            3307
        );

        if ($connection->connect_error)
        {
            die("Please connect the database: " . $connection->connect_error);
        }

        return $connection;
    }
}
?>