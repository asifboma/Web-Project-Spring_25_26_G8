<?php
include __DIR__ . "/../../controllers/loginController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h1>Login Page</h1>

    <?php
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="post" action="">
        <table>
            <tr>
                <td> Email: </td>
                <td> <input type="text" name="email" /></td>
            </tr>

            <tr>
                <td>Password: </td>
                <td><input type="password" name="password"></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>

    <p>Do not have an account? <a href="registration.php">Register here</a></p>

</body>
</html>