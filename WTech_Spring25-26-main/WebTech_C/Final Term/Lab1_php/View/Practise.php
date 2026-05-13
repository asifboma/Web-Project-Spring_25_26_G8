<!DOCTYPE html>
<html>
    <body>
        <form>
       
            <?php
            echo "<h1> Login Form </h1>";
            ?>

            <table>
                <tr>
                    <td> <p> User Name: </p> </td>
                    <td>
                        <input type ="text"/>
                    </td>
                </tr>
                <tr>
                    <td> Password: </td>
                    <td> <input type= "password"/> </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <input type ="submit"/>
                    </td>
                </tr>
            </table>
        </form>

        <?php
        $text1= "Hello World";
        $text2= "PHP is great";
        echo "<p style = 'color: red'>$text1</p>";
        echo "<p style = 'color: blue'>$text2</p>";
        echo "<h2> Web Technology Syllabus on $text2 </h2>";
        $car = array("Volvo", "BMW", "Toyota");
        var_dump($car);
        $cars = array("brand" => "Ford", "model"=> "2026", "color" => "red");
        echo $cars['model'];
        foreach ($cars as $x => $y) {
            echo "$x : $y <br>";
        }
        
        
        ?>
  
    </body>
</html>