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
        $file=$_FILES["file"];
        

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
            $data = file_get_contents($datafile);
            $mydata = json_decode($data,true);
            
            
            if($file)
                {
                    $targetdirectory= "../File/";
                    $path = $targetdirectory.basename($file["name"]);
                    $result = move_uploaded_file($file["tmp_name"],$path);
                }
                else{
                    $path = "";
                }
            

            $database = new db();
            $connection = $database->connection();
            $result = $database->signup($connection,"users", $name, $password, $path);
            if($result)
                {
                    Header("Location:../View/Login.php ");
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