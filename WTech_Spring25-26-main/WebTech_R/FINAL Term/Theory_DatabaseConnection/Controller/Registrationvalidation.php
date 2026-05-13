<?php 
include "../Model/db.php";
session_start();

$name ="";
$password="";
$datafile ="../data.json";


if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST["name"];
        $password = $_POST["password"];

        if(!empty($name) && strlen($name)>=5 && strlen($password)>=4)
            {
                $_SESSION["name"] = $name;
                setcookie('name', $name, time()+3600, "/");
                echo "Login Successful";

                $formdata = array("Name"=>$name, "Password"=>$password);

                if(file_exists($datafile))
                    {
                        $existdata = file_get_contents($datafile);
                        $tempdata = json_decode($existdata, true);
                    }
                    else{
                        $tempdata = array();
                    }

                    if(!is_array($tempdata))
                        {
                            $tempdata = array(); 
                        }
                    $tempdata [] = $formdata;
                    $jsondata = json_encode($tempdata, JSON_PRETTY_PRINT);
                if(file_put_contents($datafile,$jsondata)!== false)
                    {
                        echo "Data Saved";
                    }
                    else{
                        echo "Please Try Again";
                    }
                $data = file_get_contents($datafile);
                $mydata = json_decode($data);
            }

            $database = new db();
            $connection = $database->connection();
            $result = $database->signup($connection,"users",$name,$password);
            if($result)
                {
                    Header("Location: ../View/Login.php");
                }




            else{
                echo "Please try again!";
            }

        if(isset($_SESSION["name"]) || isset($_COOKIE["name"]))
            {
                echo "Welcome Back";
            }
        else{
        echo "pLease log in agian!"; 
            }
    }


?>