<?php
session_start();
require_once("dataBase.php");
?>

<!DOCTYPE HTML>
<html>       
    <body>
        <h1>Videos Application</h1>
        
        <p> Please press the start button to begin the application. </p>

        <form name="videoList" action="editVideoList.php" method="GET">
            <input type="submit" value="Start" />
        </form>
    </body>
</html>
