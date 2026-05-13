<!DOCTYPE html>
<html>
<body>

<form method="post" action="../Controller/RegistrationController.php">
    <h1 style="color: blue">Register here</h1>

    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username"></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td><input type="password" name="password"></td>
        </tr>

        <tr>
            <td><input type="submit" name="submitbutton" value="Register"></td>
        </tr>
    </table>
</form>

<p>Already have an account? <a href="Login.php">Login here</a></p>

</body>
</html>
