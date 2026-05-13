<?php 

session_start();

$name ="";
$password="";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST["name"];
        $password = $_POST["password"];

        if(!empty($name) && strlen($name)>=5 && strlen($password)>=4)
            {
                $_SESSION["name"] = $name;
                setcookie('name', $name, time()+3600, "/");
                echo "Login Successful";
            }
            else{
                echo "Please try again!";
            }
    }
if(isset($_SESSION["name"]) || isset($_COOKIE["name"]))
    {
        echo "Welcome Back";
    }
    else{
        echo "pLease log in agian!"; 
    }

?>