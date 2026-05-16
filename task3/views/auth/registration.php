<?php
include __DIR__ . "/../../controllers/registrationController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>

    <h1>Registration Page</h1>

    <?php
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }

    if (!empty($success)) {
        echo "<p style='color:green;'>$success</p>";
    }
    ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="<?php echo $name; ?>"></td>
            </tr>

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
                    <input type="submit" value="Register">
                </td>
            </tr>
        </table>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>