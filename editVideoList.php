<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <body>
        <table border="black">
                <th>id</th>
                <th>name</th>
                <th>category</th>
                <th>length</th>
                <th>rented</th> 
            <?php
            require_once("dataBase.php");

            $result = videoDB::getInstance()->get_videos();
            while ($row = mysqli_fetch_array($result)):
                echo "<tr><td>" . htmlentities($row['id']) . "</td>";
                echo "<td>" . htmlentities($row['name']) . "</td>";
                echo "<td>" . htmlentities($row['category']) . "</td>";
                echo "<td>" . htmlentities($row['length']) . "</td>";
                echo "<td>" . htmlentities($row['rented']) . "</td>";
                // set variable $id to the retrieved database id for use in the editVideo and deleteVideo buttons
                $id = $row[id];
                ?>
                <td>
                    <form name="checkOutOrInVideo" action="checkOutOrInVideo.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" name="checkOutOrInVideo" value="Check Out/Check In"/>
                    </form>
                </td>
                <td>
                    <form name="deleteVideo" action="deleteVideo.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" name="deleteVideo" value="Delete"/>
                    </form>
                </td>
                <?php
                echo "</tr>\n";
            endwhile;
            mysqli_free_result($result);
            ?>
        </table>
        <form name="addNewVideo" action="addVideo.php" method="POST">
            name: <input type="text" name="name" /><br/>
            category: <input type="text" name="category" /><br/>
            length: <input type="text" name="length" /><br/>
            rented: <input type="text" name="rented" /><br/>
            <input type="submit" value="Add Video"/>
        </form>
        <form name="backToMainPage" action="startVideo.php">
            <input type="submit" value="Back To Main Page"/>
        </form>
    </body>
</html>