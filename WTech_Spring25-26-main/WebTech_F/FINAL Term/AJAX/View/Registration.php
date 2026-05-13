<?php
include "../Controller/RegistrationController.php";
echo "<h1>Registation Page </h1> <br>"
?>
<!DOCTYPE html>
<html>
    <head> <Script src ="../Controller/JS/CheckUsername.js"> </Script></head>
    <body>
        <form method = "post" action="../Controller/RegistrationController.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td> <label for ="Username">User Name: </label></td>
                    <td> <input type ="text" id="name" name="name" onkeyup=CheckUser()> <?php echo $name ?> </td>
                    <td> <p id ="usernameresponse"> </p></td>
                </tr>
                <tr>
                    <td> <label for ="password">Password:  </label></td>
                    <td> <input type ="password" id ="pass" name ="password"> <?php echo $password ?></td>
                </tr>
                <tr>
                    <td>File Upload </td>
                    <td> <input type = "file" name= "file"></td>
                </tr>
                <tr>
                    <td> <input type ="submit" id="submitbutton" name = "submit"> </td>
                </tr>
            </table>
        </form>
    </body>
</html>