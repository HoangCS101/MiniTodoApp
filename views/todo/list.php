<!DOCTYPE html>
<html>
<head>
    <title>Index Page</title>
</head>
<body>
    <div style="text-align: center;">
        <h1>TODO List</h1>
        <table border="1">
            <?php
            // Generating a 3x3 table
            $sql = "SELECT id, todo_name, content FROM todo_list";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["todo_name"]. " " . $row["content"]. "<br>";
            }
            } else {
            echo "0 results";
            }
            ?>
        </table>
        <br>
        <!-- <a href="./views/todo/new.php"><button>Add New Todo</button></a> -->
    </div>
</body>
</html>
