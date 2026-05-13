<!DOCTYPE html>
<html>
<head>
<style>
    .required {
        color: red;
    }
</style>
</head>
<body>

<form method="post" action="controller.php">
<table>
    <tr>
        <td><label>Name: <span class="required">*</span></label></td>
        <td><input type="text" name="name" required></td>
    </tr>
    <tr>
        <td><label>Email: <span class="required">*</span></label></td>
        <td><input type="email" name="email" required></td>
    </tr>
    <tr>
        <td><label>Website:</label></td>
        <td><input type="text" name="website"></td>
    </tr>
    <tr>
        <td><label>Comment:</label></td>
        <td><input type="text" name="comment"></td>
    </tr>
    <tr>
        <td><label>Gender: <span class="required">*</span></label></td>
        <td>
            <input type="radio" name="gender" value="female" required> Female
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="other"> Other
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" value="Submit">
        </td>
    </tr>
</table>
</form>

</body>
</html>