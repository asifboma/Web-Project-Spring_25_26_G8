<?php

class db{
function connection()
{
$db_host = "localhost";
$db_user= "root";
$db_password="";
$db_name="section_f"; 

$connection=  new mysqli($db_host, $db_user,$db_password,$db_name);
if($connection->connect_error)
    {
        die ("Could not Connect Database".$connection->connect_error);
    }
return $connection;
}

function signup($connection, $tablename, $username, $password, $filepath)
{
    $sql= "INSERT INTO " .$tablename. "(username, password, filepath) VALUES ('".$username."', '".$password."','".$filepath."')";
    $result = $connection->query($sql);
    return $result;
}
function signin($connection, $tablename, $username, $password)
{
    $sql = "SELECT * FROM ".$tablename." WHERE username='".$username."' AND password='".$password."'";
    $result = $connection->query($sql);
    return $result;
}
	




}


?>