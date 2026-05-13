<?php
include "../Model/db.php";
$username= $_POST["username"] ?? " ";
if(!$username)
    {
        echo "Username Required!";
    }
    else{
        $database = new db();
        $connection= $database->connection();
        $result = $database->CheckUserName($connection, "users", $username);
        if($result->num_rows>0)
            {
                echo "Username Already Taken!";
            }
            else{
                echo "Username Available";
            }
    }

?>