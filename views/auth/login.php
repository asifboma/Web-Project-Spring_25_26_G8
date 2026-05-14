<?php
include "../../controllers/loginController.php";
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
                <td><label for="email">Email:</label></td>
                <td>
                    <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                </td>
            </tr>

            <tr>
                <td><label for="password">Password:</label></td>
                <td>
                    <input type="password" id="password" name="password">
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>

    <p>Do not have an account? <a href="registration.php">Register here</a></p>

</body>
</html>