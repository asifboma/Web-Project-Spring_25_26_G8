<?php

$name = "";
$password = "";
$validpassword="";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST["name"];
        $password =$_POST["password"];

        $name = $_REQUEST["name"];
        $password =$_REQUEST["password"];

        if(!empty($name) && strlen($name)>=5)
            {
                echo "User Name: " . $name;
            }
            else{
                echo "User Name Must Be greater than 5 Char";
            }
        if(strlen($password)>=4)
            {
               $validpassword = $password;
                echo "Password: " .$validpassword;
            }
            else{
                     
                $validpassword ="Please enter the password must contain 4 char minimum";
              
            }


    }


?>