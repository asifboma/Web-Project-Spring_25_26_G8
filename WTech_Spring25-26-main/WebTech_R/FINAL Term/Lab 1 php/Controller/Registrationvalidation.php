<?php 

$name="";
$password ="";
$validpassword = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST["name"];
        $password= $_POST["password"];

        $name = $_REQUEST["name"];
        $password= $_REQUEST["password"];

        if(!empty($name) && strlen($name)>=5)
            {
                echo "User Name: ".$name;
            }
            else{
                echo "UserName must be greater than 5 char";
            }


            if(strlen($password)>4)
                {
                   $validpassword = $password;
                   echo "Password: ".$validpassword;
                }
                else{
                    
                    $validpassword = "Password Must be 4 Digit minimum";
                    
                }


    }






?>