<!DOCTYPE html>  // Declares HTML5 document type standard
<html>  // Opens root HTML element
    <body>  // Opens body container for page content
        <?php  // Opens PHP processing block
        echo "<h1> This is a log in Form </h1>";  // Displays form title heading
        ?>  // Closes PHP block
        <form>  // Starts form to collect user input
            <table>  // Creates table layout structure for form alignment
                <tr>  // Starts first table row for username field
                    <td> <p> User Name: </p> </td>  // Label cell for username
                    <td> <input type= "text"/> </td>  // Input field to accept username text
                </tr>  // Ends first row
                <tr>  // Starts second table row for password field
                    <td> <p> Password: </p></td>  // Label cell for password
                    <td> <input type ="password"/> </td>  // Input field to hide password characters
                </tr>  // Ends second row
                <tr>  // Starts third table row for submission
                    <td> <input type = "submit"/> </td>  // Button to submit form data
                </tr>  // Ends third row
            </table>  // Closes table
        </form>  // Closes form
    <?php  // Opens PHP block for server-side processing
    echo "<h1 style = 'color: red'>Hello World</h1>";  // Displays red-colored heading
    $text1 = "Hello php";  // Stores first string in variable for reuse
    $text2 = "Web Tech";  // Stores second string in variable (currently unused)
    echo "<h1> php Initiated $text1 </h1>";  // Outputs heading with variable interpolated
    ?>  // Closes PHP block
    <?php  // Opens another PHP block for array operations
    // $variable1= 10.5;  // Commented: would store float number
    // $variable2= 20;  // Commented: would store integer number
    // echo $variable1 + $variable2;  // Commented: would output sum of both numbers
    // $cars = array("WebTech", "C#", "OOP1");  // Commented: would create indexed array
    // var_dump($cars);  // Commented: would debug-print array structure and content
    $car = array("Course"=>"WebTech", "Section"=> "C", "ClassTime"=> "10.20-12.20");  // Creates associative array with key-value pairs
    echo $car["Section"];  // Accesses and displays the value of Section key (outputs "C")
    ?>  // Closes PHP block


    </body>  // Closes body element
</html>  // Closes HTML root element