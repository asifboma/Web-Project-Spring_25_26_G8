<?php
include "../Model/db.php";

$username = $_POST["username"] ?? "";
if(!$username)
    {
        echo "UserName Required";
    }
    else{
        $database= new db();
        $connection= $database->connection();
        $result= $database->CheckUsername($connection, "users", $username);
        if($result->num_rows>0)
            {
                echo "UserName Already Taken!";
            }
            else{
                echo "UserName Avaialble";
            }
    }





?> 