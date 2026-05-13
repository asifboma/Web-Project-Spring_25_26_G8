<?php
include "../Model/db.php";
session_start();

$name = "";
$password="";
$datafile ="../data.json";


if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST["name"];
        $password= $_POST["password"];

        if(!empty($name) && strlen($name)>=5 && strlen($password)>=4)
            {
                echo "Log In Successfull";
                setcookie("UserName",$name,time()+3600, "/");

                $formdata=array("name"=>$name, "password"=>$password);

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

                if(file_put_contents($datafile,$jsondata)!==false)
                    {
                        echo "Data Saved Successfully <br>";
                    }
                    else{
                        echo "No Data Saved";
                    }
            $database = new db();
            $connection = $database->connection();
            $result = $database->signin($connection,"users", $name, $password);
            
            if($result->num_rows==1)
                {
                    while($row=$result->fetch_assoc())
                        {
                            $id=$row["id"];
                            $username=$row["username"];
                            $filepath=$row["filepath"];
                            $_SESSION["username"]=$username;
                            $_SESSION["filepath"]=$filepath;
                            $_SESSION["id"]=$id;
                            $_SESSION["loggedIn"]=true;
                            Header("Location:../View/Dashboard.php ");
                        }
                    
                }
            }
            else{
                echo "Please Use the appropiate validation";
            }

    if(!isset($_SESSION["UserName"]) || isset($_COOKIE["UserName"]))
        {
            echo "Welcome Back";
        }
        else{
            echo "Please log In";
        }
    }
?>