<?php
session_start();

$name = "";
$email ="";
$website = "";
$comment = "";
$gender = "";

// FORCE correct path
$datafile = __DIR__ . "/data.json";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $website = isset($_POST["website"]) ? $_POST["website"] : "";
    $comment = isset($_POST["comment"]) ? $_POST["comment"] : "";
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
        
    if(!empty($name) && strlen($name)>=5)
    {
        $_SESSION["name"]=$name;
        setcookie('name',$name, time()+3600, "/");
        echo "Submit Successful!<br>";

        $formdata = array(
            "name"=>$name,
            "email"=>$email,
            "website"=>$website,
            "comment"=>$comment,
            "gender"=>$gender
        );

        if(file_exists($datafile)){
            $existdata = file_get_contents($datafile);
            $tempdata = json_decode($existdata, true);

            if(!is_array($tempdata)){
                $tempdata = array();
            }
        }
        else{
            $tempdata = array();
        }

        $tempdata[] = $formdata;

        $jsondata = json_encode($tempdata, JSON_PRETTY_PRINT);

        // DEBUG HERE
        if(file_put_contents($datafile, $jsondata) !== false)
        {
            echo "Data Saved<br>";
        }
        else{
            echo "ERROR: Cannot write file<br>";
        }
    }
    else{
        echo "Name must be at least 5 characters<br>";
    }
        
    }    

?>