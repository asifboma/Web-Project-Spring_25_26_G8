<?php
session_start();

if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
} elseif (isset($_COOKIE["name"])) {
    $name = $_COOKIE["name"];
} else {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>

    <h1>Welcome <?php echo $name; ?></h1>

</body>
</html>