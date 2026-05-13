<?php
session_start();
$username = $_SESSION["username"] ?? "";
$isLoggedIn = $_SESSION["loggedIn"];
 
$filepath = $_SESSION["filepath"] ??"";
 
if(!$isLoggedIn){
    Header("Location: Login.php");
    exit();
}
?>

<html>
    <body>
         <?php echo "Hello Mr. $username , welcome to dashboard.";?>
         <a href="../Controller/Logout.php" >Logout</a>
         <img src="<?php echo $filepath;?>" height="200px" width="200px"/>
    </body>
</html>