<!DOCTYPE html>
<html>
<body>

<form method="post" action="../Controller/LoginController.php">
    <?php echo "<h1 style='color: blue'>Login here</h1>"; ?>

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
            <td><input type="submit" name="submitbutton" value="Login"></td>
        </tr>
    </table>
</form>

<p>Don't have an account? <a href="Registration.php">Register here</a></p>

</body>
</html>
