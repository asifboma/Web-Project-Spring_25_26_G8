<?php
session_start();

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} elseif (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
} else {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>

<h1>Welcome <?php echo $username; ?></h1>

</body>
</html>
